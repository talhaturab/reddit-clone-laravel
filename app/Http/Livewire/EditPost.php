<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Response;

class EditPost extends Component
{
    public $post;
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:4',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
    }

    public function updatePost()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->post))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->emit('postWasUpdated');
    }
    public function render()
    {
        return view('livewire.edit-post');
    }
}
