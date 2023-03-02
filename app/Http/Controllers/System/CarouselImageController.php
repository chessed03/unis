<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\CarouselImage;
use Illuminate\Http\Request;

class CarouselImageController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            $access_route = ___routeArmored();

            return ___getAccess( $request, $next, $access_route );

        });
    }*/

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Carrusel de imágenes';

        $location  = 'Inicio';

        return view('system.carousel-images.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module     = 'Publicación';

        $submodule  = 'Carrusel de imágenes';

        $location   = 'Crear';

        $list_sites = CarouselImage::getAliveSites();

        return view('system.carousel-images.create', [
            'module'     => $module,
            'submodule'  => $submodule,
            'location'   => $location,
            'list_sites' => $list_sites
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'site_id'   => 'required',
            'name'      => 'required',
            'image_url' => 'required'
        ]);

        $validateImageName = CarouselImage::validateImageName( $request->title, null );

        if ( $validateImageName ) {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ya existe un sitio con el titulo: $request->title.");

        } else {

            $result = CarouselImage::createItem( $request );

            if ($result) {

                return redirect()->route('carousel-image-index')->with('success', "Exito!, sitio creado correctamente.");

            } else {

                return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module     = 'Publicación';

        $submodule  = 'Sitios';

        $location   = 'Editar';

        $list_sites = CarouselImage::getAliveSites();

        $item       = CarouselImage::findOrFail( $request->id );

        return view('system.carousel-images.update', [
            'module'     => $module,
            'submodule'  => $submodule,
            'location'   => $location,
            'list_sites' => $list_sites,
            'item'       => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'site_id'   => 'required',
            'name'      => 'required',
            'image_url' => 'required'
        ]);

        $validateImageName = CarouselImage::validateImageName( $request->title, $request->id );

        if ( $validateImageName ) {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ya existe un sitio con el titulo: $request->title.");

        } else {

            $result = CarouselImage::updateItem( $request );

            if ($result) {

                return redirect()->route('carousel-image-index')->with('success', "Exito!, sitio editado correctamente.");

            } else {

                return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
