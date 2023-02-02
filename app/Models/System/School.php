<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    const TABLA      = 'schools';

    const REMOVED    = 0;

    const ALIVE      = 1;


    public static function getAliveSchools( $schools )
    {

        //$permissions = ___accessPermissions( $schools );

        $result      = null;

        $query       = self::whereIn('id', $schools)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function getSchoolsById( $schools )
    {

        //$permissions = ___accessPermissions( $schools );

        $result      = null;

        $query       = self::whereIn('id', $schools)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

}
