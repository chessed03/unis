<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Videos';

        $location  = 'Inicio';

        return view('system.videos.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Videos';

        $location     = 'Crear';

        $list_schools = Video::getAliveSchools();

        return view('system.videos.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id' => 'required',
            'name'      => 'required',
            'video_url' => 'required'
        ]);
        
        $result = Video::createItem( $request );

        if ( $result ) {

            return redirect()->route('video-index')->with('success', "Exito!, preunta creada correctamente.");

        } else {

            return redirect()->route('video-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

}
