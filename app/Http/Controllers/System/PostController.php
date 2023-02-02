<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Posts';

        return view('system.posts.index', [
            'module'    => $module,
            'submodule' => $submodule
        ]);

    }

    public function uploadImage( Request $request )
    {

        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }

}
