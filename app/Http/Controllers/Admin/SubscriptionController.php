<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mt4Details;
use App\Models\Settings;
use App\Traits\PingServer;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use PingServer;

    public function myTradingSettings()
    {
        $settings = Settings::find(1);
        $account = $this->fetctApi('/account-profile');

        $response = $this->fetctApi('/master-account');

        $acout = $this->fetctApi('/trading-accounts');

        $settings = $this->fetctApi('/settings');
        $amountPerSlot = $settings['data']['amount_per_slot'];

        return view('admin.subscription.trading-settings', [
            'title' => 'Trading Settings',
            'accounts' => $response['data'],
            'myaccount' => $account['data'],
            'data' => $acout['data'],
            'amountPerSlot' => $amountPerSlot
        ]);
    }

    public function createCopyMasterAccount(Request $request)
    {
        $response = $this->fetctApi('/create-copytrade-account', [
            'login' => $request->login,
            'password' => $request->password,
            'serverName' => $request->serverName,
            'name' => $request->name,
            'leverage' => $request->leverage,
            'account_type' => $request->acntype,
            'baseCurrency' => $request->currency ? $request->currency : 'USD',
        ], 'POST');

        if ($response->failed()) {
            return redirect()->back()->with('message', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
    }


    public function updateStrategy(Request $request)
    {
        if ($request->has('fixedRisk')) {
            $modeCompliment = $request->fixedRisk;
        } elseif ($request->has('fixedVolume')) {
            $modeCompliment = $request->fixedVolume;
        } elseif ($request->has('expression')) {
            $modeCompliment = $request->expression;
        } else {
            $modeCompliment = '';
        }

        $response = $this->fetctApi('/update-strategy', [
            'mode' => $request->trademode,
            'strategy_name' => $request->name,
            'description' => $request->desc,
            'modecompliment' => $modeCompliment,
        ], 'POST');

        if ($response->failed()) {
            return redirect()->back()->with('message', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
    }


    public function deleteMasterAccount($id)
    {
        $response = $this->fetctApi('/delete-master-account' . '/' . $id);
        if ($response->failed()) {
            return redirect()->back()->with('message', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
    }


    public function renewAccount(Request $request)
    {
        $response = $this->fetctApi('/renew-master-account', [
            'account' => $request->account_id,
        ], 'POST');
        if ($response->failed()) {
            return redirect()->back()->with('message', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
    }


    public function delsub($id)
    {
        Mt4Details::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subscription Sucessfully Deleted');
    }
}