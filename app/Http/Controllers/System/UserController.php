<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

        $submodule = 'Usuarios';

        return view('system.users.index', [
            'module'    => $module,
            'submodule' => $submodule
        ]);

    }

}
