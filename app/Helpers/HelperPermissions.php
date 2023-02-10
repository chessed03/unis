<?php

use App\Models\System\Permission;
use Illuminate\Support\Facades\Auth;

function ___routeArmored()
{

    session()->forget('route_name');

    $route_name = Route::currentRouteName();

    session()->put('route_name', $route_name);

    $result = (object)[
        'route_name'    => session()->get('route_name'),
        'routes_access' => session()->get('access_routes')[0]
    ];

    return $result;

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

    foreach ( $permissions as $p => $permission ) {

        if ( in_array( $permission, $schools ) ) {

            $result = true;

        }

    }

    return $result;

}

/*function ___accessPermissions( $schools_access )
{
    $route               = \Request::route()->getName();

    $permissions_user    = session()->get('access_permissions');

    $found_key           = array_search($route, array_column($permissions_user, 'module_route'));

    $schools_permissions = [];

    foreach ( $schools_access as $a => $school_id ) {

        foreach ( $permissions_user[$found_key]->permissions as $p => $permission ) {

            if ( intval($permission['school_id']) == intval($school_id) ) {

                $schools_permissions['permissions'][$school_id] = (object)[
                    'school_id' => intval($permission['school_id']),
                    'read'      => intval($permission['read']),
                    'write'     => intval($permission['write'])
                ];

            }

        }

    }

    $schools_selected = [];

    foreach ( $schools_access as $s => $school ) {

        if( array_key_exists($school, $schools_permissions['permissions']) ){

            if ( $schools_permissions['permissions'][$school]->write == 1 ) {

                array_push($schools_selected, $school);

            }
        }

    }

    $result = (object)[

        'permissions'      => $schools_permissions['permissions'],
        'schools_selected' => $schools_selected

    ];

    return $result;
}*/
