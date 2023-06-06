<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Content;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    //

    public function getContent($ref_key, $prop){
        $content = Content::where('ref_key', $ref_key)->first();
        return $content->$prop;
    }

    public function getImage($ref_key, $prop){
        $images = Images::where('ref_key', $ref_key)->first();
        return $images->$prop;
    }
}
