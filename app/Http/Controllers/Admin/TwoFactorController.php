<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'twofa' => 'required',
        ]);

        if ($request->twofa == Auth('admin')->user()->token_2fa) {

            $user = Auth('admin')->User();

            Admin::where('id', $user->id)
                ->update([
                    'token_2fa_expiry' => \Carbon\Carbon::now()->addMinutes(config('session.lifetime')),
                    'pass_2fa' => 'true',
                ]);

            $message = "This is a successful login notification on your admin account. If this was not you, kindly take action by changing your account password.";
            $subject = "Successful login";

            Mail::bcc($user->email)->send(new NewNotification($message, $subject, $user->email));
            $request->session()->forget('twofa');
            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->with('message', 'Incorrect code.');
        }
    }

    public function showTwoFactorForm()
    {
        return view('auth.two_factor', [
            'title' => 'Admin Two Factor Authentication',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }
}