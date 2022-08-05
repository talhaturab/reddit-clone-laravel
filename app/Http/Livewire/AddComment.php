<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class AddComment extends Component
{
    public $comment;
    public $post;

    public function addComment()
    {
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'body' => $this->comment,
        ]);

        $this->reset('comment');

        $this->emit('commentWasAdded');
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
