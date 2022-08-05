<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class AddReply extends Component
{
    public $replyBody;
    public $comment;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function addReply()
    {
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->comment->post->id,
            'parent_id' => $this->comment->id,
            'body' => $this->replyBody,
        ]);

        $this->replyBody='';

        $this->emit('replyWasAdded');
    }
    public function render()
    {
        return view('livewire.add-reply');
    }
}
