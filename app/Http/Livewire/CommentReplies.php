<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentReplies extends Component
{
    public $comment;

    protected $listeners = [
        'replyWasAdded',
        'commentWasDeleted',
    ];

    public function commentWasDeleted()
    {
        // $replies = $this->comment->replies()->get();
        // ddd($replies);
        return $this->comment->refresh();
    }

    public function replyWasAdded()
    {
        $this->comment->refresh();
    }

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment-replies', [
            'replies' => $this->comment->replies()->get()
        ]);
    }
}
