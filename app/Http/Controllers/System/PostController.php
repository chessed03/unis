<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Post;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            $access_route = ___routeArmored();

            if( !in_array( $access_route->route_name, $access_route->routes_access ) ) {

                return redirect()->route('403');

            }

            return $next($request);

        });
    }

    public function index( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Posts';

        $location  = 'Inicio';

        return view('system.posts.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Configuración';

        $submodule    = 'Posts';

        $location     = 'Crear';

        $list_schools = Post::getAliveSchools();

        return view('system.posts.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'subtitle' => 'required',
            'schools'  => 'required',
            'content'  => 'required'
        ]);

        $validatePostTitle = Post::validatePostTitle( $request->title, null );

        if ( $validatePostTitle ) {

            return redirect()->route('post-index')->with('error', "Ups!, ya existe un post con el titulo: $request->title.");

        } else {

            $result = Post::createItem( $request );

            if ($result) {

                return redirect()->route('post-index')->with('success', "Exito!, post creado correctamente.");

            } else {

                return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Configuración';

        $submodule    = 'Posts';

        $location     = 'Editar';

        $list_schools = Post::getAliveSchools();

        $item         = Post::findOrFail( $request->id );

        return view('system.posts.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools,
            'item'         => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'subtitle' => 'required',
            'schools'  => 'required',
            'content'  => 'required'
        ]);

        $validatePostTitle = Post::validatePostTitle( $request->title, $request->id );

        if ( $validatePostTitle ) {

            return redirect()->route('post-index')->with('error', "Ups!, ya existe un post con el titulo: $request->title.");

        } else {

            $result = Post::updateItem( $request );

            if ($result) {

                return redirect()->route('post-index')->with('success', "Exito!, post editado correctamente.");

            } else {

                return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function uploadImage( Request $request )
    {

        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }

}
