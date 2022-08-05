<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public $post;

    protected $listeners = [
        'commentWasAdded',
        'commentWasDeleted',
    ];

    public function commentWasAdded()
    {
        $this->post->refresh();
    }

    public function commentWasDeleted()
    {
        $this->post->refresh();
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-comments', [
            'comments' => Comment::where('post_id', $this->post->id)
            ->where('parent_id', null)
            ->latest('id')
            ->get()
        ]);
    }
}
