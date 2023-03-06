<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadImage( Request $request )
    {

        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }

}
