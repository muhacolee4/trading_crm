<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Apitrait
{

    public function get_rate($coin, $currency)
    {
        $assetbase = $coin . $currency;
        $price = Http::get("https://api.brynamics.com/api/current-market-price/$assetbase")["0"]["Price"];
        return $price;
    }
};