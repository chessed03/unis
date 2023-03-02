<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            $access_route = ___routeArmored();

            return ___getAccess( $request, $next, $access_route );

        });
    }*/

    public function uploadImage( Request $request )
    {

        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }
    
}
