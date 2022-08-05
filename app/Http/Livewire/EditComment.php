<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class EditComment extends Component
{
    public $body;
    public Comment $comment;

    protected $rules = [
        'body' => 'required|min:4'
    ];

    public $listeners = ['setEditComment'];

    public function setEditComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->body = $this->comment->body;

        $this->emit('editCommentWasSet');
    }

    public function updateComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->comment->body = $this->body;
        $this->comment->save();

        $this->emit('commentWasUpdated');
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
