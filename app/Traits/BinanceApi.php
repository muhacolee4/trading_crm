<?php

namespace App\Traits;

use App\Mail\DepositStatus;
use App\Models\BncTransaction;
use App\Models\Deposit;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

trait BinanceApi
{
    private $apiKey = " ";
    private $secretKey = "";

    private function setKeys()
    {
        $settings = SettingsCont::find(1);
        $this->apiKey = $settings->bnc_api_key;
        $this->secretKey = $settings->bnc_secret_key;
    }

    // creating the signature for headers
    private function buildContent($body): array
    {
        $timestamp = round(microtime(true) * 1000);
        $nonce = $this->randomStringGenerator(32);
        $payload = $timestamp . "\n" . $nonce . "\n" . $body . "\n";
        $signature = strtoupper(hash_hmac('sha512', strval($payload), $this->secretKey));

        return [
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => $signature,
        ];
    }

    public function createOrder($amount, $trnxID, $successUrl, $errorUrl)
    {

        $body = [
            "env" => [
                "terminalType" => "WEB",
            ],
            "merchantTradeNo" => $trnxID,
            "orderAmount" => $amount,
            "currency" => "USDT",
            "goods" => [
                "goodsType" => "02",
                "goodsCategory" => "Z000",
                "referenceGoodsId" => rand(),
                "goodsName" => "Deposit to Wallet",
            ],
            "returnUrl" => $successUrl,
            "cancelUrl" => $errorUrl,
        ];

        return $this->apiCall("https://bpay.binanceapi.com/binancepay/openapi/v2/order", $body);
    }


    public function queryOrder()
    {
        $settings = Settings::find(1);

        if (DB::table('bnc_transactions')->where('status', 'Pending')->where('type', 'Deposit')->exists()) {
            $orders = BncTransaction::where('status', 'Pending')->where('type', 'Deposit')->get();

            foreach ($orders as $order) {
                $body = [
                    "prepayId" => $order->prepay_id,
                ];
                $response = $this->apiCall("https://bpay.binanceapi.com/binancepay/openapi/v2/order/query", $body);
                $result = json_decode($response);
                $data = $result->data;
                $user = User::find($order->user_id);

                if ($data->status == "PAID") {
                    $dp = new Deposit();
                    $dp->amount = $data->orderAmount;
                    $dp->txn_id = $data->prepayId;
                    $dp->payment_mode = $data->currency;
                    $dp->status = 'Processed';
                    $dp->proof = "Automatic Payment";
                    $dp->plan = 0;
                    $dp->user = $user->id;
                    $dp->save();

                    $brecord = BncTransaction::find($order->id);
                    $brecord->status = "PAID";
                    $brecord->save();

                    //Send Email to admin regarding this deposit
                    Mail::to($settings->contact_email)->send(new DepositStatus($dp, $user, 'Successful Deposit', true));

                    //Send confirmation email to user regarding his deposit and it's successful.
                    Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Successful Deposit', false));
                }
            }
        }
    }

    public function payout($amount, $trnxID, $email)
    {
        $url = "https://bpay.binanceapi.com/binancepay/openapi/payout/transfer";
        $body = [
            "requestId" => $trnxID,
            "batchName" => "Single Payout",
            "currency" => "USDT",
            "totalAmount" => floatval($amount),
            "totalNumber" => 1,
            "transferDetailList" => [
                [
                    "merchantSendId" => $trnxID,
                    "transferAmount" => floatval($amount),
                    "receiveType" => "EMAIL",
                    "transferMethod" => "SPOT_WALLET",
                    "receiver" => $email,
                    "remark" => "withdrawal request"
                ]

            ],
        ];

        return $this->apiCall($url, $body);
    }

    public function queryPayout()
    {

        if (DB::table('bnc_transactions')->where('status', 'Pending')->where('type', 'Withrdawal')->exists()) {
            $payouts = BncTransaction::where('status', 'Pending')->where('type', 'Withrdawal')->get();
            foreach ($payouts as $payout) {
                $body = [
                    "requestId" => $payout->prepay_id,
                ];
                $response = $this->apiCall("https://bpay.binanceapi.com/binancepay/openapi/payout/query", $body);
                $result = json_decode($response);
                $data = $result->data;
                $user = User::find($payout->user_id);
            }
        }
    }


    private function apiCall($url, $body)
    {
        $this->setKeys();
        $data = $this->buildContent(json_encode($body));
        $timestamp = $data['timestamp'];
        $nonce = $data['nonce'];
        $signature = $data['signature'];

        $ch = curl_init();
        $headers = [];
        $headers[] = "Content-Type: application/json";
        $headers[] = "BinancePay-Timestamp: $timestamp";
        $headers[] = "BinancePay-Nonce: $nonce";
        $headers[] = "BinancePay-Certificate-SN: $this->apiKey";
        $headers[] = "BinancePay-Signature: $signature";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    // used to generate binance nonce
    function randomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}