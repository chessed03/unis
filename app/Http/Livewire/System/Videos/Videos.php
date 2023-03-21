<?php

namespace App\Http\Livewire\System\Videos;

use App\Models\System\Video;
use Livewire\Component;
use Livewire\WithPagination;

class Videos extends Component
{

    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];

    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $keyWord;

    public function render()
    {

        $keyWord        = '%' . $this->keyWord . '%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $list_schools   = Video::getAliveSchools();

        $rows           = Video::getAliveVideosForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.videos.view', [
            'rows'         => $rows,
            'list_schools' => $list_schools,
        ]);
    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function setActiveStatus( $id )
    {

        Video::setActiveStatus( $id );

    }

    public function destroy( $id )
    {
        if ($id) {

            $record         = Video::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Sitio eliminado.','success');

        }
    }
    
}
