<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\DepositStatus;
use App\Models\Deposit;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    //initialize flutterwave payment
    public function initialize(Request $request)
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();
        $settings = Settings::find(1);
        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => intval($request->amount),
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => $settings->s_currency,
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],

            "customizations" => [
                "title" => 'Deposit',
                "description" => "Funding my account balance"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return redirect()->route('payment')->with('message', 'Something went wrong, please try payment again');
        }

        return redirect($payment['data']['link']);
    }

    public function callback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            // dd($data);
            $amount = $data['data']['amount'];
        } elseif ($status ==  'cancelled') {
            return redirect()->route('payment')->with('message', 'Something went wrong, please try payment again');
        } else {
            return redirect()->route('payment')->with('message', 'Something went wrong, please try payment again');
        }

        $user = Auth::user();
        //get settings 
        $settings = Settings::where('id', '=', '1')->first();
        $earnings = $settings->referral_commission * $amount / 100;

        //save and confirm the deposit
        $dp = new Deposit();
        $dp->amount = $amount;
        $dp->txn_id = $data['data']['tx_ref'];
        $dp->payment_mode = "Flutterwave";
        $dp->status = 'Processed';
        $dp->proof = "Credit Card";
        $dp->plan = "0";
        $dp->user = $user->id;
        $dp->save();

        if ($settings->deposit_bonus != NULL and $settings->deposit_bonus > 0) {
            $bonus = $amount * $settings->deposit_bonus / 100;
            //create history
            Tp_Transaction::create([
                'user' => $user->id,
                'plan' => "Deposit Bonus for $settings->currency $amount deposited",
                'amount' => $bonus,
                'type' => "Bonus",
            ]);
        } else {
            $bonus = 0;
        }

        //add funds to user's account
        User::where('id', $user->id)
            ->update([
                'account_bal' => $user->account_bal + $amount + $bonus,
                'bonus' => $user->bonus + $bonus,
                'cstatus' => 'Customer',
            ]);


        if (!empty($user->ref_by)) {
            //get agent
            $agent = User::where('id', $user->ref_by)->first();
            User::where('id', $user->ref_by)
                ->update([
                    'account_bal' => $agent->account_bal + $earnings,
                    'ref_bonus' => $agent->ref_bonus + $earnings,
                ]);

            //credit commission to ancestors
            $deposit_amount = $amount;
            $array = User::all();
            $parent = $user->id;
            $this->getAncestors($array, $deposit_amount, $parent);

            Tp_Transaction::create([
                'user' => $user->ref_by,
                'plan' => "Credit",
                'amount' => $earnings,
                'type' => "Ref_bonus",
            ]);
        }

        //send email notification
        $subject = "Successful deposit!";
        Mail::to($user->email)->send(new DepositStatus($dp, $user, $subject));
        return redirect()->route('deposits')->with('success', 'Payment Successful');
    }


    //Get uplines
    function getAncestors($array, $deposit_amount, $parent = 0, $level = 0)
    {
        $referedMembers = '';
        $parent = User::where('id', $parent)->first();

        foreach ($array as $entry) {
            if ($entry->id == $parent->ref_by) {
                //get settings 
                $settings = Settings::where('id', '=', '1')->first();

                if ($level == 1) {
                    $earnings = $settings->referral_commission1 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 2) {
                    $earnings = $settings->referral_commission2 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 3) {
                    $earnings = $settings->referral_commission3 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 4) {
                    $earnings = $settings->referral_commission4 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 5) {
                    $earnings = $settings->referral_commission5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                }

                if ($level == 6) {
                    break;
                }

                //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
                $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level + 1);
            }
        }
        return $referedMembers;
    }
}