<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;


function ___routeArmored()
{

    $result = (object)[
        'route_name'    => \Request::route()->getName(),
        'routes_access' => session()->get('access_routes')[0]
    ];

    return $result;

}
function ___accessPermissions( $schools_access )
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
}
