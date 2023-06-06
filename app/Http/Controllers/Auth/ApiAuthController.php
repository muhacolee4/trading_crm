<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\CryptoAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiAuthController extends Controller
{
    use PasswordValidationRules;

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'username' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required',
            'country' => 'required',
            'password' => $this->passwordRules(),
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'username' => $request['username'],
            'country' => $request['country'],
            'status' => 'active',
            'password' => Hash::make($request['password']),
        ]);

        $cryptoaccnt = new CryptoAccount();
        $cryptoaccnt->user_id = $user->id;
        $cryptoaccnt->save();

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return response()->json([
            'message' => 'Registration is successful.',
            'status_code' => 200,
        ]);
    }
}