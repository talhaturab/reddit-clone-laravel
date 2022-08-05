<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentReply extends Component
{
    public $reply;

    protected $listeners = ['commentWasUpdated'];

    public function commentWasUpdated()
    {
        $this->reply->refresh();
    }

    public function mount(Comment $reply)
    {
        $this->reply = $reply;
    }
    public function render()
    {
        return view('livewire.comment-reply');
    }
}
