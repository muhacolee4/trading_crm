<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\User_plans;
use App\Models\Tp_Transaction;
use App\Mail\NewRoi;
use App\Mail\endplan;
use App\Mail\NewNotification;
use App\Models\Mt4Details;
use App\Traits\BinanceApi;
use App\Traits\Coinpayment;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AutoTaskController extends Controller
{
    use Coinpayment, BinanceApi;
    /*
        Automatic toup
        calculate top up earnings and
        auto increment earnings after the increment time
    */

    public function autotopup()
    {
        // automatic roi
        $this->automaticRoi();

        // check for subscription expiration
        $this->checkSubscription();

        //do auto confirm payments
        $this->queryOrder();
        echo "Automatic ROI is working properly \n CoinPayment:";
        return $this->cpaywithcp();
    }



    public function checkSubscription()
    {
        $subscriptions = Mt4Details::where('status', 'active')->get();
        $today = now();
        $settings = Settings::find(1);

        foreach ($subscriptions as $sub) {
            $endAt = Carbon::parse($sub->end_date);
            $remindAt = Carbon::parse($sub->reminded_at);
            $singleSub = Mt4Details::find($sub->id);
            $user = User::find($singleSub->client_id);

            if ($today->isSameDay($endAt) && $singleSub->status != 'Expired') {
                //mark sub as expired
                $singleSub->status = 'Expired';
                $singleSub->save();

                //send email to user
                $messageUser = "Your subscription with MT4-ID: $sub->mt4_id have expired. To enable us continue trading on this account, please renew your subcription. \r\n To renew your subcription, login to your $settings->site_name account, go to managed accounts page and click on the renew button on the affected account.";
                Mail::to($user->email)->send(new NewNotification($messageUser, 'Your subscription have expired', $user->firstname));

                // Send email to admin
                $messageAdmin = "Subscription with MT4-ID: $sub->mt4_id have expired and the user have been notified.";
                Mail::to($settings->contact_email)->send(new NewNotification($messageAdmin, 'Your subscription have expired', 'Admin'));
            }

            if ($today->isSameDay($remindAt)) {
                // number of days for subscription to expire
                $daysLeft = $endAt->diffInDays($remindAt);

                //send email to user
                $message = "Your subscription with MT4-ID: $sub->mt4_id will expire in $daysLeft days. To avoid disconnection of your trading account, please renew your subcription before $endAt. \r\n To renew your subcription, login to your $settings->site_name account, go to managed accounts page and click on the renew button on the affected account.";
                Mail::to($singleSub->tuser->email)->send(new NewNotification($message, 'Your subscription will expire soon', $singleSub->tuser->firstname));

                $singleSub->reminded_at = $remindAt->addDay();   //2022-12-21 19:50:58
                $singleSub->save();
            }
        }
    }




    public function automaticRoi()
    {
        $settings = Settings::find(1);

        if ($settings->trade_mode == 'on') {
            //get user plans
            $usersPlans = User_plans::where('active', 'yes')->get();

            //get current date and time to be used for calculations of ROI
            $now = now();
            //return $now;

            //logic to add auto roi
            foreach ($usersPlans as $plan) {
                //get plan
                $dplan = Plans::firstWhere('id', $plan->plan);

                //get user
                $user = User::firstWhere('id', $plan->user);

                //know the plan increment interval
                if ($dplan->increment_interval == "Monthly") {
                    $nextDrop = $plan->last_growth->addDays(27);
                } elseif ($dplan->increment_interval == "Weekly") {
                    $nextDrop = $plan->last_growth->addDays(6);
                } elseif ($dplan->increment_interval == "Daily") {
                    $nextDrop = $plan->last_growth->addHours(23);
                } elseif ($dplan->increment_interval == "Hourly") {
                    $nextDrop = $plan->last_growth->addMinutes(54);
                } elseif ($dplan->increment_interval == "Every 30 Minutes") {
                    $nextDrop = $plan->last_growth->addMinutes(24);
                } else {
                    $nextDrop = $plan->last_growth->addMinutes(7);
                }

                //conditions
                $condition = $now->lessThanOrEqualTo($plan->expire_date) && $user->trade_mode == 'on';

                $condition2 = $now->greaterThan($plan->expire_date);

                //calculate increment
                if ($dplan->increment_type == "Percentage") {
                    $increment = (intval($plan->amount)  * $dplan->increment_amount) / 100;
                } else {
                    $increment = $plan->increment_amount;
                }

                if ($condition) {

                    if ($now->isWeekday() or $settings->weekend_trade == 'on') {

                        if ($now->greaterThanOrEqualTo($plan->last_growth)) {

                            User::where('id', $plan->user)
                                ->update([
                                    'roi' => $user->roi + $increment,
                                    'account_bal' => $user->account_bal + $increment,
                                ]);

                            //save to transactions history
                            $th = new Tp_Transaction();
                            $th->plan = $dplan->name;
                            $th->user = $user->id;
                            $th->amount = $increment;
                            $th->user_plan_id = $plan->id;
                            $th->type = "ROI";
                            $th->save();

                            User_plans::where('id', $plan->id)
                                ->update([
                                    'last_growth' => $nextDrop,
                                    'profit_earned' => $plan->profit_earned + $increment,
                                ]);

                            if ($user->sendroiemail == 'Yes') {
                                //send email notification
                                $date = Carbon::now()->toDateTimeString();
                                Mail::to($user->email)->send(new NewRoi($user, $dplan->name, $increment, $date, 'New Return on Investment(ROI)'));
                            }
                        }
                    }
                    if ($now->isWeekend() and $settings->weekend_trade != 'on') {
                        if ($now->greaterThanOrEqualTo($plan->last_growth)) {
                            User_plans::where('id', $plan->id)
                                ->update([
                                    'last_growth' => $nextDrop,
                                ]);
                        }
                    }
                }

                if ($condition2) {
                    //release capital
                    if ($settings->return_capital) {

                        User::where('id', $plan->user)
                            ->update([
                                'account_bal' => $user->account_bal + $plan->amount,
                            ]);

                        //save to transactions history
                        $th = new Tp_transaction();
                        $th->plan = $dplan->name;
                        $th->user = $plan->user;
                        $th->amount = $plan->amount;
                        $th->type = "Investment capital";
                        $th->save();
                    }


                    //plan expiredP
                    User_plans::where('id', $plan->id)
                        ->update([
                            'active' => "expired",
                        ]);

                    if ($user->sendinvplanemail == "Yes") {
                        //send email notification
                        $objDemo = new \stdClass();
                        $objDemo->receiver_email = $user->email;
                        $objDemo->receiver_plan = $dplan->name;
                        $objDemo->received_amount = "$settings->currency$plan->amount";
                        $objDemo->sender = $settings->site_name;
                        $objDemo->receiver_name = $user->name;
                        $objDemo->date = \Carbon\Carbon::Now();
                        $objDemo->subject = "Investment plan closed";
                        Mail::to($user->email)->send(new endplan($objDemo));
                    }
                }
            }
        }
    }
}