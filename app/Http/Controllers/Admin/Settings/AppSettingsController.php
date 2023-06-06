<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\SettingsCont;
use Illuminate\Support\Facades\Storage;

class AppSettingsController extends Controller
{

    // Return view
    public function appsettingshow()
    {
        $live_timezones = timezone_identifiers_list();
        include 'currencies.php';
        return view('admin.Settings.AppSettings.show', [
            'title' => 'Website information settings',
            'timezones' => $live_timezones,
            'currencies' => $currencies,
            'timezone' => config('app.timezone'),
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }


    // update wensite information
    public function updatewebinfo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'mimes:jpg,jpeg,png|max:500|image',
            'favicon' => 'mimes:jpg,jpeg,png,ico|max:500',
        ]);

        $settings = Settings::where('id', '=', '1')->first();

        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            Storage::disk('public')->delete($settings->logo);
            $path = $file->store('photos', 'public');
        } else {
            $path  = $settings->logo;
        }

        if ($request->hasfile('favicon')) {
            $favfile = $request->file('favicon');
            Storage::disk('public')->delete($settings->favicon);
            $pathfav = $favfile->store('photos', 'public');
        } else {
            $pathfav = $settings->favicon;
        }

        Settings::where('id', '1')
            ->update([
                'newupdate' => $request['update'],
                'site_name' => $request['site_name'],
                'description' => $request['description'],
                'keywords' => $request['keywords'],
                'timezone' => $request['timezone'],
                'site_title' => $request['site_title'],
                'install_type' => $request['install_type'],
                'logo' => $path,
                'merchant_key' => $request->merchant_key,
                'favicon' => $pathfav,
                'tawk_to' => strip_tags($request['tawk_to']),
                'site_address' => $request['site_address'],
                'welcome_message' => $request->welcome_message,
            ]);

        $moreset = SettingsCont::find(1);
        $moreset->purchase_code = $request->purchase_code;
        $moreset->save();

        return redirect()->back()->with('success', 'Settings Saved successfully');
    }



    public function updatepreference(Request $request)
    {

        if ($request->return_capital == 'true') {
            $return_capital = true;
        } else {
            $return_capital = false;
        }

        Settings::where('id', 1)->update([
            'contact_email' => $request['contact_email'],
            'currency' => $request['currency'],
            's_currency' => $request['s_currency'],
            'weekend_trade' => $request['weekend_trade'],
            'location' => $request['location'],
            'trade_mode' => $request['trade_mode'],
            'enable_verification' => $request['enail_verify'],
            'google_translate' => $request['googlet'],
            'enable_kyc' => $request['enable_kyc'],
            'enable_kyc_registration' => $request['enable_kyc_registration'],
            'captcha' => $request['captcha'],
            'enable_with' => $request['withdraw'],
            'return_capital' => $return_capital,
            'enable_social_login' => $request['social'],
            'enable_annoc' => $request['annouc'],
            'redirect_url' => $request->redirect_url,
            'should_cancel_plan' => $request->should_cancel_plan,
        ]);
        return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
    }

    // Update email preference
    public function updateemail(Request $request)
    {
        Settings::where('id', ' 1')
            ->update([
                'mail_server' => $request['server'],
                'emailfrom' => $request['emailfrom'],
                'emailfromname' => $request['emailfromname'],
                'smtp_host' => $request['smtp_host'],
                'smtp_port' => $request['smtp_port'],
                'smtp_encrypt' => $request['smtp_encrypt'],
                'smtp_user' => $request['smtp_user'],
                'smtp_password' => $request['smtp_password'],
                'google_id' => $request['google_id'],
                'google_secret' => $request['google_secret'],
                'google_redirect' => $request['google_redirect'],
                'capt_secret' => $request['capt_secret'],
                'capt_sitekey' => $request['capt_sitekey'],
            ]);
        return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
        //return redirect()->back()->with('message', 'Action Sucessful');
    }
}