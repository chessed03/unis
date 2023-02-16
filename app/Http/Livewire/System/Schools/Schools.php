<?php

namespace App\Http\Livewire\System\Schools;

use App\Models\System\School;
use Livewire\Component;
use Livewire\WithPagination;

class Schools extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];

    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $keyWord;

    public function render()
    {

        $keyWord        = '%'.$this->keyWord .'%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $list_schools   = School::getAliveSchools();

        $rows           = School::getAliveSchoolsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.schools.view', [
            'rows'         => $rows,
            'list_schools' => $list_schools,
        ]);
    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function destroy( $id )
    {
        if ($id) {

            $record         = School::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Universidad eliminada.','success');

        }
    }

}
