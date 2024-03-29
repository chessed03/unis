<?php

namespace App\Http\Livewire\System\Posts;

use App\Models\System\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
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

        $list_schools   = Post::getAliveSchools();

        $rows           = Post::getAlivePostsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.posts.view', [
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

            $record         = Post::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Publicación eliminada.','success');

        }
    }
}
