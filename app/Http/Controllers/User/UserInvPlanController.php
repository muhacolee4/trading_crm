<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use App\Models\User_plans;
use Illuminate\Support\Facades\Mail;

class UserInvPlanController extends Controller
{
    public function cancelPlan($plan)
    {
        $plan = User_plans::find($plan);
        $plan->active = 'cancelled';
        $plan->save();

        // credit the user his capital
        User::where('id', $plan->user)
            ->update([
                'account_bal' => Auth::user()->account_bal + $plan->amount,
            ]);

        //save to transactions history
        $th = new Tp_transaction();
        $th->plan = $plan->dplan->name;
        $th->user = $plan->user;
        $th->amount = $plan->amount;
        $th->type = "Investment capital for cancelled plan";
        $th->save();

        // Send a mail to the user informing them of their plan cancellation
        $planName = $plan->dplan->name;
        $message = "You have succesfully cancelled your $planName plan and your investment capital have been credited to your account,  If this is a mistake, please contact us immediately to reactivate it for you.";
        Mail::to(Auth::user()->email)->send(new NewNotification($message, 'Invsetment Plan Cancelled', Auth::user()->name));

        return back()->with('success', 'Plan cancelled successfully');
    }
}