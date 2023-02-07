<?php

namespace App\Http\Livewire\System;

use App\Models\System\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Posts extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];
    public $paginateNumber     = 5;
    public $orderBy            = 3;

    public $updateMode         = false;

    public $selected_id, $keyWord, $title, $slug, $subtitle, $schools, $content, $status;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function render()
    {
        $keyWord        = '%'.$this->keyWord .'%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $items_schools  = ___getSchoolsUser()->items_school;

        $shools_id      = ___getSchoolsUser()->schools_id;

        $rows           = Post::getAlivePosts( $keyWord, $paginateNumber, $orderBy, $shools_id );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.posts.view', [
            'rows' => $rows,
            'items_schools' => $items_schools
        ]);
    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('select2');
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
        $this->emit('closeCreateModal');
        $this->emit('closeUpdateModal');
        $this->hydrate();
    }

    private function resetInput()
    {

        $this->title    = null;
        $this->slug     = null;
        $this->subtitle = null;
        $this->schools  = null;
        $this->content  = null;
        $this->emit('content', '');

    }

    public function store()
    {

        $this->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'subtitle' => 'required',
            'schools'  => 'required',
            'content'  => 'required'
        ]);

        $validatePostTitle = Post::validatePostTitle( $this->title, null );

        if ( $validatePostTitle ) {

            $this->messageAlert( 'Ya existe un post con el titulo ingresado.','error' );

        } else {

            $data = (object)[
                'title'    => $this->title,
                'slug'     => $this->slug,
                'subtitle' => $this->subtitle,
                'schools'  => $this->schools,
                'content'  => $this->content,
            ];

            $result = Post::createItem( $data );

            if ( $result ) {

                $this->messageAlert( 'Post creaado correctamente.','success' );

            } else {

                $this->messageAlert( 'Existió un error.','error' );

            }

        }

        $this->resetInput();
        $this->emit('closeCreateModal');
        $this->hydrate();

    }

    public function edit($id)
    {
        $record            = Post::findOrFail($id);

        $this->selected_id = $id;

        $this->title       = $record->title;

        $this->slug        = $record->slug;

        $this->subtitle    = $record->subtitle;

        $this->schools     = $record->schools;

        $this->emit('content', $record->content);

        $this->updateMode    = true;
    }

    public function update()
    {
        $this->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'subtitle' => 'required',
            'schools'  => 'required',
            'content'  => 'required'
        ]);

        if ($this->selected_id) {

            $validatePostTitle = Post::validatePostTitle( $this->title, $this->selected_id );

            if ( $validatePostTitle ) {

                $this->messageAlert( 'Ya existe un post con el titulo ingresado.','error' );

            } else {

                $data = (object)[
                    'id'       => $this->selected_id,
                    'title'    => $this->title,
                    'slug'     => $this->slug,
                    'subtitle' => $this->subtitle,
                    'schools'  => $this->schools,
                    'content'  => $this->content,
                ];

                $result = Post::updateItem( $data );

                if ( $result ) {

                    $this->messageAlert( 'Post actualizado correctamente.','success');

                } else {

                    $this->messageAlert( 'Existió un error.','error');

                }

            }

            $this->resetInput();
            $this->emit('closeUpdateModal');
            $this->updateMode = false;
            $this->hydrate();

        }
    }

    public function destroy($id)
    {
        if ($id) {

            $record         = Post::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Cliente eliminado.','success');

        }
    }
}
