<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'schools' => 'json'
    ];

    const TABLE    = "posts";

    const DELETED  = 0;

    const ALIVE    = 1;

    public static function getAlivePosts( $keyWord, $paginateNumber, $orderBy, $schools )
    {
        $result = null;

        $query  = DB::table(self::TABLE);

        $query->where(function ($q) use ($schools) {

            foreach ($schools as $school_id) {

                $q->orWhereJsonContains('schools', $school_id);

            }

        });

        $query->whereRaw('status = "' . self::ALIVE . '"');

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

        $collection = $query->paginate($paginateNumber);

        if ( $collection ) {

            $result = $collection;

        }

        return $result;
    }

    public static function getAliveSchools()
    {
        $resultado = null;

        $consulta  = School::where('status', self::ALIVE)->get();

        if ( $consulta ) {

            $resultado = $consulta;

        }

        return $resultado;
    }

    public static function validatePostTitle( $titulo, $id )
    {

        $resultado = null;

        $consulta  = DB::table(self::TABLE);

        if ( $id ) {

            $consulta->where('id', '!=', $id);

        }

        $consulta->where('title', $titulo);

        $consulta->where('status', self::ALIVE);

        $registros = $consulta->count();

        if ( $registros ) {

            $resultado = $registros;

        }

        return $resultado;

    }

    public static function createItem( $datos )
    {

        $item                = new self;
        $item->title        = $datos->title;
        $item->slug          = $datos->slug;
        $item->subtitle     = $datos->subtitle;
        $item->schools = $datos->schools;
        $item->content     = $datos->content;
        $item->created_by    = auth()->user()->id."-".auth()->user()->name;


        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'post', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $datos )
    {

        $item                = self::where('id', $datos->id)->first();
        $item->title        = $datos->title;
        $item->slug          = $datos->slug;
        $item->subtitle     = $datos->subtitle;
        $item->schools = $datos->schools;
        $item->content     = $datos->content;
        $item->created_by    = auth()->user()->id."-".auth()->user()->name;


        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'post', $item->id );

            return true;


        }

        return false;
    }


}
