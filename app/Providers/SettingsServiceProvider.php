<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Models\Paystack;
use App\Models\SettingsCont;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::where('id', '1')->first();
        $paystack = Paystack::where('id', '1')->first();
        $settings2 = SettingsCont::find(1);


        if ($settings->install_type == 'Sub-Folder') {
            $urls = explode('/', $settings->site_address);
            $assetUrl = '/' . end($urls);
        } else {
            $assetUrl = null;
        }

        // Set configuration values at run time
        config([
            'captcha.secret' => $settings->capt_secret,
            'captcha.sitekey' => $settings->capt_sitekey,
            'services.google.client_id' =>  $settings->google_id,
            'services.google.client_secret' =>  $settings->google_secret,
            'services.google.redirect' =>  $settings->google_redirect,
            'mail.mailers.smtp.host' =>  $settings->smtp_host,
            'mail.mailers.smtp.port' =>  $settings->smtp_port,
            'mail.mailers.smtp.encryption' =>  $settings->smtp_encrypt,
            'mail.mailers.smtp.username' =>  $settings->smtp_user,
            'mail.mailers.smtp.password' =>  $settings->smtp_password,
            'mail.default' => $settings->mail_server,
            'mail.from.address' => $settings->emailfrom,
            'mail.from.name' => $settings->emailfromname,
            'app.timezone' => $settings->timezone,
            'app.name' => $settings->site_name,
            'app.url' => $settings->site_address,
            'paystack.publicKey' => $paystack->paystack_public_key,
            'paystack.secretKey' => $paystack->paystack_secret_key,
            'paystack.paymentUrl' => $paystack->paystack_url,
            'paystack.merchantEmail' => $paystack->paystack_email,
            'livewire.asset_url' => $assetUrl,
            'flutterwave.publicKey' => $settings2->flw_public_key,
            'flutterwave.secretKey' => $settings2->flw_secret_key,
            'flutterwave.secretHash' => $settings2->flw_secret_hash,
            'services.telegram-bot-api.token' =>  $settings2->telegram_bot_api,
        ]);
    }
}