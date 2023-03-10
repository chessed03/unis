<?php

namespace App\Http\Livewire\System\Programs;

use App\Models\System\Program;
use Livewire\Component;
use Livewire\WithPagination;

class Programs extends Component
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

        $list_schools   = Program::getAliveSchools();

        $rows           = Program::getAliveProgramsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.programs.view', [
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

            $record         = Program::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Evento eliminado.','success');

        }
    }
    
}
