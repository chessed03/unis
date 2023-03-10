<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Eventos';

        $location  = 'Inicio';

        return view('system.events.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Eventos';

        $location     = 'Crear';

        $list_schools = Event::getAliveSchools();

        return view('system.events.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'start_date'  => 'required',
            'finish_date' => 'required',
            'location'    => 'required',
            'image_url'   => 'required'
        ]);
        
        $validateEventName = Event::validateEventName( $request->name, null );

        if ( $validateEventName ) {

            return redirect()->route('event-index')->with('error', "Ups!, ya existe un evento con el nombre: $request->name.");

        } else {

            $result = Event::createItem( $request );

            if ($result) {

                return redirect()->route('event-index')->with('success', "Exito!, evento creado correctamente.");

            } else {

                return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Eventos';

        $location     = 'Editar';

        $list_schools = Event::getAliveSchools();

        $item         = Event::findOrFail( $request->id );

        $notice       = Event::findNoticeById( $request->id );

        return view('system.events.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools,
            'item'         => $item,
            'notice'       => $notice
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'start_date'  => 'required',
            'finish_date' => 'required',
            'location'    => 'required',
            'image_url'   => 'required'
        ]);

        $validateEventName = Event::validateEventName( $request->name, $request->id );

        if ( $validateEventName ) {

            return redirect()->route('event-index')->with('error', "Ups!, ya existe un evento con el nombre: $request->name.");

        } else {

            $result = Event::updateItem( $request );

            if ($result) {

                return redirect()->route('event-index')->with('success', "Exito!, evento editado correctamente.");

            } else {

                return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
