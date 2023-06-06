<?php

namespace App\Http\Livewire\User;

use App\Mail\NewNotification;
use App\Models\BncTransaction;
use App\Models\Settings;
use App\Models\User;
use App\Models\Wdmethod;
use App\Traits\BinanceApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CryptoWithdaw extends Component
{
    use BinanceApi;
    public $payment_mode;
    public $otpCode;
    public $amount;

    public function render()
    {
        return view('livewire.user.crypto-withdaw');
    }

    public function requestOtp()
    {
        sleep(2);
        $code = $this->RandomStringGenerator(5);
        $user = Auth::user();
        User::where('id', $user->id)->update([
            'withdrawotp' => $code,
        ]);

        $message = "You have initiated a withdrawal request, use the OTP: $code to complete your request.";
        $subject = "OTP Request";
        Mail::to($user->email)->send(new NewNotification($message, $subject, $user->name));
        session()->flash('status', 'Action Successful!, OTP have been sent to your email');
    }

    public function withdraw()
    {
        $settings = Settings::where('id', '1')->first();
        $method = Wdmethod::where('name', $this->payment_mode)->first();
        //get user
        $user = User::where('id', Auth::user()->id)->first();

        if ($method->charges_type == 'percentage') {
            $charges = $this->amount * $method->charges_amount / 100;
        } else {
            $charges = $method->charges_amount;
        }

        $to_withdraw = $this->amount + $charges;

        if (Auth::user()->sendotpemail == "Yes" and $this->otpCode != Auth::user()->withdrawotp) {
            session()->flash('error', 'OTP is incorrect, please recheck the code');
        } elseif ($settings->enable_kyc == "yes" and Auth::user()->account_verify != "Verified") {
            session()->flash('error', 'Your account must be verified before you can make withdrawal. please complete your KYC verification');
        } elseif (Auth::user()->account_bal < $to_withdraw) {
            session()->flash('error', 'Sorry, your account balance is insufficient for this request.');
        } elseif ($this->amount < $method->minimum) {
            session()->flash("error", "Sorry, The minimum amount you can withdraw is $settings->currency$method->minimum, please try another payment method.");
        } else {

            $http_response = $this->payout($this->amount, $this->RandomStringGenerator(10), $user->email);
            $data = json_decode($http_response);

            if ($data->status == "FAIL") {
                session()->flash('error', 'Something went wrong, please contact our support team if problem persist');

                // send mail to admin
                Mail::to($settings->contact_email)->send(new NewNotification("There was a failed USDT withdrawal from your Binance account by $user->name, possible reasons maybe insufficient fund. Please login your binance account or your website to view more details and take neccesary action", "Failed USDT Withdrawal from your Binance account.", 'Admin'));
            } else {
                // get values from api.
                $values = $data->data;

                $brecord = new BncTransaction();
                $brecord->user_id = Auth::user()->id;
                $brecord->prepay_id = $values->requestId;
                $brecord->type = 'Withrdawal';
                $brecord->status = 'Pending';
                $brecord->save();

                //debit user
                User::where('id', $user->id)->update([
                    'account_bal' => $user->account_bal - $to_withdraw,
                    'withdrawotp' => NULL,
                ]);

                Mail::to($settings->contact_email)->send(new NewNotification("There was a successful USDT withdrawal from your Binance account by $user->name", "Successful USDT Withdrawal from your Binance account.", 'Admin'));
            }
        }
    }


    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}