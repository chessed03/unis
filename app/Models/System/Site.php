<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Site extends Model
{

    use HasFactory;

    protected $table = 'sites';

    protected $casts = [
        'social_networks'  => 'json'
    ];

    const TABLE      = "sites";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public static function getAliveSitesForView( $keyWord, $paginateNumber, $orderBy )
    {

        $result = null;

        $query  = DB::table( self::TABLE );

        $query->whereRaw('title LIKE "' . $keyWord . '"');

        if ( $orderBy == 1 ) {

            $query->orderByRaw('title ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('title DESC');

        }

        if ( $orderBy == 3 ) {

            $query->orderByRaw('created_at DESC');

        }

        if ( $orderBy == 4 ) {

            $query->orderByRaw('created_at ASC');

        }

        $query->whereRaw('status = "' . self::ALIVE . '"');

        $result = $query->paginate($paginateNumber);

        return $result;

    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function getAliveSitesByArrayId( $schools )
    {

        $result      = null;

        $query       = self::whereIn('school_id', $schools)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function validateSiteName( $titulo, $id )
    {

        $result = null;

        $query  = DB::table(self::TABLE);

        if ( $id ) {

            $query->where('id', '!=', $id);

        }

        $query->where('title', $titulo);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ( $rows ) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem( $data )
    {

        $item                  = new self();
        $item->school_id       = $data->school_id;
        $item->logo_url        = $data->logo_url;
        $item->title           = $data->title;
        $item->base_url        = $data->base_url;
        $item->server_name     = $data->server_name;
        $item->social_networks = $data->social_networks;
        $item->created_by      = auth()->user()->id."-".auth()->user()->name;


        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'site', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item                  = self::where('id', $data->id)->first();
        $item->school_id       = $data->school_id;
        $item->logo_url        = $data->logo_url;
        $item->title           = $data->title;
        $item->base_url        = $data->base_url;
        $item->server_name     = $data->server_name;
        $item->social_networks = $data->social_networks;

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'site', $item->id );

            return true;


        }

        return false;
    }

}
