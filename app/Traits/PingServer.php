<?php

namespace App\Traits;

use App\Models\Settings;
use Illuminate\Support\Facades\Http;
use App\Models\SettingsCont;
use Illuminate\Http\Client\Response;

trait PingServer
{
    public function callServer($action, $url, $data = [])
    {
        $baseUrl = $_SERVER['HTTP_HOST'];

        $sett = SettingsCont::find(1);

        $response = Http::withHeaders([
            'licenseKey' => $sett->purchase_code,
            'websiteUrl' => $website,
            'action' => $action,
        ])->acceptJson()->get($baseUrl, $data);
        return $response;
    }


    public function fetctApi(string $url, array $data = [], string $method = 'GET'): Response
    {
        $settings = Settings::find(1);

        $baseUrl = "https://app.getonlinetrader.pro/api/v1" . $url;

        if ($method == 'GET') {
            $response = Http::withHeaders([
                'token' => $settings->merchant_key
            ])->acceptJson()->get($baseUrl, $data);
        }

        if ($method == 'POST') {
            $response = Http::withHeaders([
                'token' => $settings->merchant_key
            ])->acceptJson()->post($baseUrl, $data);
        }

        if ($method == 'PATCH') {
            $response = Http::withHeaders([
                'token' => $settings->merchant_key
            ])->acceptJson()->patch($baseUrl, $data);
        }

        if ($method == 'PUT') {
            $response = Http::withHeaders([
                'token' => $settings->merchant_key
            ])->acceptJson()->put($baseUrl, $data);
        }

        if ($method == "DEL") {
            $response = Http::withHeaders([
                'token' => $settings->merchant_key
            ])->acceptJson()->delete($baseUrl, $data);
        }

        return $response;
    }

    public function backWithResponse(Response $response): array
    {
        $info = json_decode($response);

        if ($response->successful()) {
            if ($info->error) {
                $type = 'message';
            }
            if (!$info->error) {
                $type = 'success';
            }
            $message = $info->message;
        }

        if ($response->failed()) {
            $type = 'message';
            $message = $info->message;
        }

        return [
            'type' => $type,
            'message' => $message
        ];
    }
}