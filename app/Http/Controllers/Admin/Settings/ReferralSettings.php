<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class ReferralSettings extends Controller
{
    // Return view
    public function referralview(Request $request){
        return view('admin.Settings.ReferralSettings.show',[
            'title'=>'Referral settings',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function updaterefbonus(Request $request){
        Settings::where('id', $request['id'])
        ->update([
            'referral_commission'=>$request['ref_commission'],
            'referral_commission1'=>$request['ref_commission1'],
            'referral_commission2'=>$request['ref_commission2'],
            'referral_commission3'=>$request['ref_commission3'],
            'referral_commission4'=>$request['ref_commission4'],
            'referral_commission5'=>$request['ref_commission5'],
            'signup_bonus'=>$request['signup_bonus'],
        ]);
        return response()->json(['status' => 200, 'success' => 'Referral Bonus Settings Saved successfully']);
    }

    public function otherBonus(Request $request){
        
        Settings::where('id', $request['id'])
        ->update([
            'deposit_bonus'=>$request['deposit_bonus'],
            'signup_bonus'=>$request['signup_bonus'],
        ]);
        return response()->json(['status' => 200, 'success' => 'System Extra Bonus Settings Saved successfully']);
    }






}
