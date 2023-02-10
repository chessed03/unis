<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    const TABLE      = 'schools';

    const REMOVED    = 0;

    const ALIVE      = 1;

    public static function getAliveSchoolsForView( $keyWord, $paginateNumber, $orderBy )
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query  = DB::table( self::TABLE );

        $query->whereRaw('name LIKE "' . $keyWord . '"');

        if ( $orderBy == 1 ) {

            $query->orderByRaw('name ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('name DESC');

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

        return self::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function getAliveSchoolsByArrayId( $schools )
    {

        $result      = null;

        $query       = self::whereIn('id', $schools)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function validateSchoolName( $name, $id )
    {

        $result = null;

        $query  = DB::table(self::TABLE);

        if ( $id ) {

            $query->where('id', '!=', $id);

        }

        $query->where('name', $name);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ( $rows ) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem( $data )
    {

        $item              = new self();
        $item->name        = $data->name;
        $item->address     = $data->address;
        $item->contact     = $data->contact;
        $item->phone       = $data->phone;
        $item->email       = $data->email;
        $item->description = $data->description;
        $item->created_by  = auth()->user()->id."-".auth()->user()->name;


        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'post', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item              = self::where('id', $data->id)->first();
        $item->name        = $data->name;
        $item->address     = $data->address;
        $item->contact     = $data->contact;
        $item->phone       = $data->phone;
        $item->email       = $data->email;
        $item->description = $data->description;

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'post', $item->id );

            return true;


        }

        return false;
    }

}
