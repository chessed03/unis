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

        $result = null;

        $query = self::whereRaw('name LIKE "' . $keyWord . '"');

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

        $result = null;

        $query  = self::whereIn('id', $schools)
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

        $item                        = new self();
        $item->name                  = $data->name;
        $item->contact               = $data->contact;
        $item->address               = $data->address;
        $item->phone_main            = $data->phone_main;
        $item->phone_secondary       = $data->phone_secondary;
        $item->email_main            = $data->email_main;
        $item->email_secondary       = $data->email_secondary;
        $item->facebook              = $data->facebook;
        $item->instagram             = $data->instagram;
        $item->twitter               = $data->twitter;
        $item->youtube               = $data->youtube;
        $item->description           = $data->description;
        $item->logo_url              = $data->logo_url;
        $item->title_about_us        = $data->title_about_us;
        $item->description_about_us  = $data->description_about_us;
        $item->meta_keywords         = $data->meta_keywords;
        $item->meta_description      = $data->meta_description;
        $item->image_about_us_url    = $data->image_about_us_url;
        $item->created_by            = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Permission::addNewSchool( $item->id );

            Binnacle::binnacleRegister( 'create', self::TABLE, 'school', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item                        = self::where('id', $data->id)->first();
        $item->name                  = $data->name;
        $item->contact               = $data->contact;
        $item->address               = $data->address;
        $item->phone_main            = $data->phone_main;
        $item->phone_secondary       = $data->phone_secondary;
        $item->email_main            = $data->email_main;
        $item->email_secondary       = $data->email_secondary;
        $item->facebook              = $data->facebook;
        $item->instagram             = $data->instagram;
        $item->twitter               = $data->twitter;
        $item->youtube               = $data->youtube;
        $item->description           = $data->description;
        $item->logo_url              = $data->logo_url;
        $item->title_about_us        = $data->title_about_us;
        $item->description_about_us  = $data->description_about_us;
        $item->meta_description      = $data->meta_description;
        $item->image_about_us_url    = $data->image_about_us_url;

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'school', $item->id );

            return true;

        }

        return false;
    }

    public static function validateDestroy( $id )
    {
        
        $result = false;

        $models = [
            'App\Models\System\Post', 
            'App\Models\System\Site',
            'App\Models\System\Certification', 
            'App\Models\System\Program',
            'App\Models\System\FaqQuestion',
            'App\Models\System\Video'
        ];

        foreach ( $models as $model) {
           
            $model_name      = app($model);

            $query           = $model_name::getAliveItemBySchoolId( $id );

            $located         = '';

            $substring_model = substr( $model, 18 );

            if ($substring_model == "Post") {

                $located = 'Publicaciones';

            }

            if ($substring_model == "Site") {

                $located = 'Sitios';

            }

            if ($substring_model == "Certification") {

                $located = 'Certificaciones';

            }

            if ($substring_model == "Program") {

                $located = 'Programas';

            }

            if ($substring_model == "Program") {

                $located = 'Programas';

            }

            if ($substring_model == "FaqQuestion") {

                $located = 'Preguntas';

            }

            if ($substring_model == "Video") {

                $located = 'Videos';

            }
            
            if ( $query ) {
                
                $result = (object)[
                    'status'  => true,
                    'located' => $located
                ];

            }

        }
        
        return $result;

    }

}
