<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class ClearCacheController extends Controller
{
    public function clearcache()
    {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'Cache Cleared Successfully');
    }


    public function saveLicense()
    {
        $website = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
            === 'on' ? "https" : "http") .
            "://" . $_SERVER['HTTP_HOST'];

        $response = Http::post('http://127.0.0.1:8080/api/v1/save-license', [
            'license' => 'enter license here after verification is done',
            'website' => $website
        ]);
    }
}