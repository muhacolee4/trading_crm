<?php

namespace App\Http\Livewire\User;

use App\Models\BncTransaction;
use App\Models\Wdmethod;
use App\Traits\BinanceApi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CryptoPayment extends Component
{
    use BinanceApi;

    public function render()
    {
        $methodname =  Wdmethod::where('name', session('payment_mode'))->first();
        return view('livewire.user.crypto-payment', [
            'title' => 'Deposit via crypto',
            'amount' => session('amount'),
            'payment_mode' => $methodname,
        ]);
    }

    public function payViaBinance()
    {
        sleep(2);
        $amount = session('amount');
        $successUrl = env('APP_URL') . "/dashboard/binance/success";
        $errorUrl = env('APP_URL') . "/dashboard/binance/error";
        $transactionID = $this->createTransactionId(10);
        $response = json_decode($this->createOrder($amount, $transactionID, $successUrl, $errorUrl));
        $data = $response->data;

        // Save binance tracking number to database
        $brecord = new BncTransaction();
        $brecord->user_id = Auth::user()->id;
        $brecord->prepay_id = $data->prepayId;
        $brecord->type = 'Deposit';
        $brecord->status = 'Pending';
        $brecord->save();

        return redirect()->away($data->checkoutUrl);
    }

    public function createTransactionId($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}