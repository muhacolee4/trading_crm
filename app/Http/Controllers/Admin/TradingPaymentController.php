<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TradingPaymentController extends Controller
{
    public function payment()
    {
        return view('admin.subscription.payment', [
            'title' => 'Fund your account balance'
        ]);
    }
}