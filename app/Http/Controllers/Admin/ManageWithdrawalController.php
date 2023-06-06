<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Mail\NewNotification;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Mail;

class ManageWithdrawalController extends Controller
{
    use PingServer;

    //process withdrawals
    public function pwithdrawal(Request $request)
    {
        $withdrawal=Withdrawal::where('id',$request->id)->first();
        $user=User::where('id',$withdrawal->user)->first();

   
        if ($request->action == "Paid") {
            Withdrawal::where('id',$request->id)
            ->update([
                'status' => 'Processed',
            ]);

            $settings=Settings::where('id', '=', '1')->first();
            $message = "This is to inform you that your withdrawal request of $settings->currency$withdrawal->amount have approved and funds have been sent to your selected account";

            Mail::to($user->email)->send(new NewNotification($message, 'Successful Withdrawal', $user->name));
        }else {

            if($withdrawal->user==$user->id){
                User::where('id',$user->id)
                ->update([
                    'account_bal' => $user->account_bal+$withdrawal->to_deduct,
                ]); 
                Withdrawal::where('id',$request->id)->delete();

                if ($request->emailsend == "true") {
                    Mail::to($user->email)->send(new NewNotification($request->reason,$request->subject, $user->name));
                }
                
              }
            
        }

        return redirect()->route('mwithdrawals')->with('success', 'Action Sucessful!');
    }

    
    public function processwithdraw($id){
         $with = Withdrawal::where('id',$id)->first();
         $method = Wdmethod::where('name', $with->payment_mode)->first();
         $user = User::where('id', $with->user)->first();
        return view('admin.Withdrawals.pwithrdawal',[
            'withdrawal' => $with,
            'method' => $method,
            'user' => $user,
            'title'=>'Process withdrawal Request',
        ]);
    }
}