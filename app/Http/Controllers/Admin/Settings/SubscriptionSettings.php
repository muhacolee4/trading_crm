<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SubscriptionSettings extends Controller
{
     // Return view
     public function index(Request $request){
        return view('admin.Settings.SubscriptionSettings.show',[
            'title'=>'Subscription settings',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }
    
    //Update Subscription Fees
    public function updatesubfee(Request $request){
        
        Settings::where('id', $request['id'])
        ->update([
            'monthlyfee'=>$request['monthlyfee'],
            'quarterlyfee'=>$request['quaterlyfee'],
            'yearlyfee'=>$request['yearlyfee'],
            'subscription_service'=>$request['subscription_service'],
        ]);
        return response()->json(['status' => 200, 'success' => 'Subscription Settings Saved successfully']);
    }
}
