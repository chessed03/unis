<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Programas';

        $location  = 'Inicio';

        return view('system.programs.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Programas';

        $location     = 'Crear';

        $list_schools = Program::getAliveSchools();

        return view('system.programs.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id'   => 'required',
            'name'        => 'required',
            'slug'        => 'required',
            'level'       => 'required',
            'area'        => 'required',
            'description' => 'required',
            'duration'    => 'required',
            'image_url'   => 'required',
            'content'     => 'required'
        ]);
        
        $validateProgramName = Program::validateProgramName( $request->name, null );

        if ( $validateProgramName ) {

            return redirect()->route('program-index')->with('error', "Ups!, ya existe un programa con el nombre: $request->name.");

        } else {

            $result = Program::createItem( $request );

            if ($result) {

                return redirect()->route('program-index')->with('success', "Exito!, programa creado correctamente.");

            } else {

                return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Programas';

        $location     = 'Editar';

        $list_schools = Program::getAliveSchools();

        $item         = Program::findOrFail( $request->id );
        
        return view('system.programs.update', [
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
            'school_id'   => 'required',
            'name'        => 'required',
            'slug'        => 'required',
            'level'       => 'required',
            'area'        => 'required',
            'description' => 'required',
            'duration'    => 'required',
            'image_url'   => 'required',
            'content'     => 'required'
        ]);
        
        $validateProgramName = Program::validateProgramName( $request->name, $request->id );

        if ( $validateProgramName ) {

            return redirect()->route('program-index')->with('error', "Ups!, ya existe un programa con el nombre: $request->name.");

        } else {

            $result = Program::updateItem( $request );

            if ($result) {

                return redirect()->route('program-index')->with('success', "Exito!, programa editado correctamente.");

            } else {

                return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
