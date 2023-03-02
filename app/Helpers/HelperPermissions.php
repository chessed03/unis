<?php

use App\Models\System\Permission;
use Illuminate\Support\Facades\Auth;

function ___routeArmored()
{

    session()->forget('route_name');

    $route_name = Route::currentRouteName();

    session()->put('route_name', $route_name);
    
    if ( !session()->get('access_routes') ) {

        return redirect()->route('home');

    }
    
    $result = (object)[
        'route_name'    => session()->get('route_name'),
        'routes_access' => session()->get('access_routes')[0]
    ];
    
    return $result;

}

function ___getAccess( $request, $next, $access_route )
{
     
    if ( !isset($access_route->route_name) ) {
               
        return redirect()->route('home');

    }

    if( !in_array( $access_route->route_name, $access_route->routes_access ) ) {

        return redirect()->route('403');

    }

    return $next($request);

}

function ___getPermissionUser()
{

    $result     = null;

    $route      = explode('-', session()->get('route_name'));

    $route_name = session()->get('route_name');

    if ( $route[1] != 'index' ) {

        $route_name = $route[0] . '-' . 'index';

    }

    $id         = Auth::id();

    $permission = Permission::getPermissions( $id );

    $module     = session()->get('access_permissions')[ array_search( $route_name, array_column(session()->get('access_permissions'), 'module_route') ) ];

    $access     = $permission[ array_search( $module->module_id, array_column($permission, 'module_id') ) ];

    if ( $access ) {

        $result = (object)[
            'read'    => $access['read'],
            'write'   => $access['write'],
            'schools' => array_merge( $access['read'], $access['write'] )
        ];

    }

    return $result;
}

function ___getAccessButton( $schools )
{

    $permissions = ___getPermissionUser()->write;

    $result = false;

    if ( !empty( $schools ) ) {

        foreach ( $permissions as $p => $permission ) {

            if ( in_array( $permission, $schools ) ) {

                $result = true;

            }

        }

    } else {

        $result = count( $permissions ) > 0;

    }

    return $result;

}