<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    
    use HasFactory;

    protected $table = 'events';

    const TABLE      = "events";

    const REMOVED    = 0;

    const ALIVE      = 1;


    # Relationship polymorphic
    public function notices()
    {
        
        return $this->morphMany(Notice::class, 'noticeable');

    }

    public static function findNoticeById( $id )
    {
        
        return Notice::findNoticeById( $id , self::class );
        
    }

    public static function getAliveEventsForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = DB::table(self::TABLE);

        /*$query->where(function ($q) use ($schools) {

            foreach ($schools as $school_id) {

                $q->orWhereJsonContains('schools', $school_id);

            }

        });*/

        $query->whereRaw('status = "' . self::ALIVE . '"');

        $query->whereRaw('name LIKE "' . $keyWord . '"');

        if ($orderBy == 1) {

            $query->orderByRaw('name ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('name DESC');

        }

        if ($orderBy == 3) {

            $query->orderByRaw('created_at DESC');

        }

        if ($orderBy == 4) {

            $query->orderByRaw('created_at ASC');

        }

        $collection = $query->paginate($paginateNumber);

        if ($collection) {

            $result = $collection;

        }

        return $result;
    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId($shoolsPermissions);
    }

    public static function validateEventName($name, $id)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        if ($id) {

            $query->where('id', '!=', $id);

        }

        $query->where('name', $name);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ($rows) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem($data)
    {

        $item              = new self();
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->start_date  = $data->start_date;
        $item->finish_date = $data->finish_date;
        $item->created_by  = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'event', $item->id);

            //Notice::launchNoticeById( $item->id, self::class, $data->launch_notice, $item->created_by );
            
            if ( !is_null($data->launch_notice) ) {
                
                self::find($item->id)->notices()->create([

                    'created_by' => $item->created_by
    
                ]);

            }
            
            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item              = self::where('id', $data->id)->first();
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->start_date  = $data->start_date;
        $item->finish_date = $data->finish_date;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'event', $item->id);

            //Notice::launchNoticeById( $data->id, self::class, $data->launch_notice, $item->created_by );

            $notice = $item->notices()
                ->where('noticeable_id', $data->id)
                ->where('noticeable_type', self::class)
                ->first();

            if ( is_null( $notice ) ) {

                if ( !is_null($data->launch_notice) ) {
                
                    self::find($item->id)->notices()->create([
    
                        'created_by' => $item->created_by
        
                    ]);
    
                }

            } else {
                                
                $notice->status = ( is_null($data->launch_notice) ) ? self::REMOVED : self::ALIVE ;

                $notice->update();               

            }

            return true;


        }

        return false;
    }

}
