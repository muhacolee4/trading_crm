<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        return view('auth.admin-forgot-password',[

        ]);
    }

    public function sendPasswordRequest(Request $request){
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $token = time();

        $admin = Admin::where('email', $request->email)->first();
        $admin->password_token = $token;
        $admin->save();

        $message = "This is a password reset request from your account. Use $token to reset your password. please ignore if you did not make this request.";
        $subject = "Reset Password Request";
        Mail::to($request->email)->send(new NewNotification($message, $subject, "$admin->firstName $admin->lastName"));
        return redirect()->route('resetview', $admin->email)
        ->with('success', 'We just sent you an email containing a token to reset your password');
    }

    public function resetPassword($email){
        $user = Admin::where('email', $email)->first();
        if(!$user){
            return redirect('/');
        }
        return view('auth.admin-reset-pass',[
            'email'=> $email,
        ]);
    }

    // Validate token
    public function validateResetPasswordToken(Request $request){

        $request->validate([
            'email' => 'required|email',
            'token' => 'required|exists:admins,password_token',
            'password' => 'required|confirmed',
        ]);

        $user = Admin::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()
            ->with('message', 'This Email does not exist');
        }

        if ($user->password_token != $request->token) {
            return redirect()->back()
            ->with('message', 'Incorrect token');
        }

        Admin::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'password_token' => NULL,
        ]);

        return redirect()->route('adminloginform')->with('success', 'Password Reset successful, login now');

    }
}
