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

    public static function getSchoolsByUserId( $id )
    {

        $result = null;

        $query  = self::find( $id );

        if ( $query ) {

            $result = School::getSchoolsById( $query->schools );;

        }

        return $result;

    }

    public static function getAliveUsers( $schools, $keyWord, $paginateNumber, $orderBy )
    {

        $permissions = ___accessPermissions( $schools );

        $result      = null;

        $contains    = [];

        foreach ( $permissions->permissions as $permission ) {

            $query  = self::whereJsonContains('schools', "$permission->school_id")
                ->where('status', self::ALIVE)
                ->get();

            foreach ( $query as $c => $content ) {

                $contains[$content->id] = (object)[
                    'id'      => $content->id,
                    'figure'  => $content->figure_id,
                    'name'    => $content->name,
                    'schools' => $content->schools,
                    'email'   => $content->email,
                    'write'   => $permission->write
                ];

            }

        }

        if ( $contains ) {

            $result = $contains;

        }

        return $result;
    }

    public static function getAliveSchools( $schools )
    {
        return School::getAliveSchools( $schools );
    }

    public static function getAliveSubmodules()
    {
        return Module::getAliveSubmodules();
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
