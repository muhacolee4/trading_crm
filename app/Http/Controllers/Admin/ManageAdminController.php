<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class ManageAdminController extends Controller
{
    
   //block admin
    public function blockadmin($id){
        Admin::where('id',$id)
        ->update([
            'acnt_type_active' => 'blocked',
        ]);
        return redirect()->back()->with('success', 'Manager Blocked');
    }

    //unblock admin
    public function unblockadmin($id){
        Admin::where('id',$id)
        ->update([
            'acnt_type_active' => 'active',
        ]);
        return redirect()->back()->with('success', 'Manager Unblocked');
    }

    //Reset Password
    public function resetadpwd($id){
        Admin::where('id', $id)
        ->update([
            'password' => Hash::make('admin01236'),
        ]);
        return redirect()->back()   ->with('success', 'Password reset Successful.');
    } 

    public function deleteadminacnt($id){
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Manager has been deleted!');
    }  

    //update admin info
    public function editadmin(Request $request){
        Admin::where('id', $request['user_id'])
        ->update([
            'firstName' => $request['fname'],
            'lastName' => $request['l_name'],
            'email' =>$request['email'], 
            'phone' =>$request['phone'], 
            'type' =>$request['type'], 
        ]);
        return redirect()->back()->with('success', 'Account updated Successfully!');
    }

     //Send mail to one user
     public function sendmail(Request $request){

        $mailduser=Admin::where('id',$request->user_id)->first();
        Mail::to($mailduser->email)->send(new NewNotification($request->message, $request->subject, $mailduser->firstname));
        return redirect()->back()->with('success','Your message was sent successfully!');
    } 

    public function adminchangepassword(){
        return view('admin.Profile.changepassword')->with(array(
            'title'=>'Change Password',
            'settings' => Settings::where('id', '=', '1')->first()
        ));
    }


       //Update Password
    public function adminupdatepass(Request $request){
        if(!password_verify($request['old_password'],$request['current_password']))
        {
          return redirect()->back()
          ->with('message', 'Incorrect Old Password');
        }
        $this->validate($request, [
            'password_confirmation' => 'same:password',
            'password' => 'min:8',
        ]);

        Admin::where('id', $request['id'])
        ->update([
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->back()
          ->with('success', 'Password Changed Sucessfully');
    } 

    public function changestyle(Request $request)
    {
        if(isset($request['style']) and $request['style']=='true'){
            $dashboard_style="dark";
        }else{
            $dashboard_style="light";
        }
        //change dashboard style
        Admin::where('id', Auth('admin')->User()->id)
        ->update([
            'dashboard_style' => $dashboard_style,
        ]);
        return response()->json(['success'=>'Changed']);
    }

    public function saveadmin(Request $request){

        $this->validate($request, [
            'fname' => 'required|max:255',
            'l_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $thisid = DB::table('admins')->insertGetId([
            'firstName'=>$request['fname'],
            'lastName'=>$request['l_name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'type'=>$request['type'],
            'acnt_type_active'=>"active",
            'status'=>"active",
            'dashboard_style'=> "light",
            'password'=> Hash::make($request['password']),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);
        return redirect()->back()
          ->with('success', 'Manager added Sucessfull!y');
    }

    public function updateadminprofile(Request $request){
        Admin::where('id', Auth('admin')->User()->id)
        ->update([
          'firstName' => $request->name,
          'lastName' => $request->lname,
          'phone' => $request->phone,
          'enable_2fa' => $request->token,
        ]);
        return redirect()->back()
        ->with('success', "Action successful!.");
    }



}
