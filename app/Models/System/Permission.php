<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $casts = [
        'permissions'  => 'json'
    ];

    const TABLE      = "permissions";

    const REMOVED    = 0;

    const ALIVE      = 1;
    public static function getPermissions( $user_id )
    {
        $permissions = null;

        $query = self::where('user_id', $user_id)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $permissions = $query->permissions;

        }

        return $permissions;
    }

    public static function generatePermissions( $data )
    {
        $query = self::where('user_id', $data->user_id)
            ->where('status', 1)
            ->first();

        if ( $query ) {

            $item = $query;
            $item->user_id     = $data->user_id;
            $item->permissions = $data->permissions;
            $item->created_by  = auth()->user()->id."-".auth()->user()->name;

            if ( $item->update() ) {

                Binnacle::binnacleRegister( 'update', self::TABLE, 'permissions', $item->id );

                return true;

            }

        } else {

            $item = new self();
            $item->user_id     = $data->user_id;
            $item->permissions = $data->permissions;
            $item->created_by  = auth()->user()->id."-".auth()->user()->name;

            if ( $item->save() ) {

                Binnacle::binnacleRegister( 'create', self::TABLE, 'permissions', $item->id );

                return true;

            }

        }

        return false;
    }

    public static function getPermissionsById( $id )
    {
        $result = null;

        $query  = self::where('user_id', $id )
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $result = $query;

        }

        return $result;
    }

}
