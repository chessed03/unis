<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $table   = 'users';

    protected $casts   = [
        'schools'  => 'json'
    ];

    const TABLE        = 'users';

    const REMOVED      = 0;

    const ALIVE        = 1;

    const DISCONTINUED = 2;

    public static function getUserById( $id )
    {

        $result = null;

        $query  = self::where('id', auth()->user()->id)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function getAliveUsers( $keyWord, $paginateNumber, $orderBy )
    {

        return self::all();

    }

    public static function getAliveSchools()
    {

        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );

    }

    public static function getAliveSubmodules()
    {

        return Module::getAliveSubmodules();

    }

    public static function getSchoolsByUserId()
    {
        $shoolsWrite       = ___getPermissionUser()->write;

        $shoolsUser        = self::getUserById( auth()->user()->id )->schools;

        $schools           = array_merge($shoolsWrite, $shoolsUser);

        $distinct          = array_unique( $schools );

        $shoolsPermissions = array_diff_key( $schools, $distinct );

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function createItem( $data )
    {

        $item             = new self();
        $item->name       = $data->name;
        $item->schools    = $data->schools;
        $item->email      = $data->email;
        $item->password   = Hash::make($data->password);
        $item->created_by = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'user', $item->id );

            return true;

        }

        return false;

    }

    public static function updateItem( $data )
    {

        $item          = self::where('id', $data->id)->first();
        $item->name    = $data->name;
        $item->schools = $data->schools;
        $item->email   = $data->email;

        if ( $data->password ) {

            $item->password = Hash::make($data->password);

        }

        $item->created_by = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'user', $item->id );

            return true;

        }

        return false;

    }

}
