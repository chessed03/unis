<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CarouselImage extends Model
{
    use HasFactory;

    protected $table = 'carousel_images';

    const TABLE      = "carousel_images";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public function dataSchool()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public static function getAliveItemBySiteId( $id )
    {
        
        if ( $id ) {

            $query = self::where( 'site_id', $id )
                ->where( 'status', self::ALIVE )
                ->first();
            
            if ( $query ) {

                return true;

            }

        }

        return false;

    }

    public static function getAliveImagesForView( $keyWord, $paginateNumber, $orderBy )
    {
        $result = null;

        $query  = self::select(
                'sites.school_id',
                'carousel_images.id as id',
                'carousel_images.site_id',
                'carousel_images.name',
                'carousel_images.title',
                'carousel_images.description',
                'carousel_images.image_url',
                'carousel_images.status'
                )
            ->leftjoin('sites', 'sites.id', '=', 'carousel_images.site_id');

        $query->whereRaw('carousel_images.name LIKE "' . $keyWord . '"');

        if ( $orderBy == 1 ) {

            $query->orderByRaw('carousel_images.name ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('carousel_images.name DESC');

        }

        if ( $orderBy == 3 ) {

            $query->orderByRaw('carousel_images.created_at DESC');

        }

        if ( $orderBy == 4 ) {

            $query->orderByRaw('carousel_images.created_at ASC');

        }

        $query->whereRaw('carousel_images.status = "' . self::ALIVE . '"');

        $result = $query->paginate($paginateNumber);

        return $result;
    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function getAliveSites()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return Site::getAliveSitesByArrayId( $shoolsPermissions );
    }

    public static function validateImageName( $titulo, $id )
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

        $item              = new self();
        $item->site_id     = $data->site_id;
        $item->name        = $data->name;
        $item->title       = $data->title;
        $item->description = $data->description;
        $item->link_url    = $data->link_url;
        $item->image_url   = $data->image_url;
        $item->created_by  = auth()->user()->id."-".auth()->user()->name;


        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'carousel image', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item              = self::where('id', $data->id)->first();
        $item->site_id     = $data->site_id;
        $item->name        = $data->name;
        $item->title       = $data->title;
        $item->description = $data->description;
        $item->link_url    = $data->link_url;
        $item->image_url   = $data->image_url;

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'carousel image', $item->id );

            return true;


        }

        return false;
    }

}
