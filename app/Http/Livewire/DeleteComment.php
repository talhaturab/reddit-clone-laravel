<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteComment extends Component
{
    public ?Comment $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentWasSet');
    }

    public function deleteComment()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $replies = $this->comment->replies()->get();

        foreach ($replies as $reply)
        {
            $this->deleteRelatedReply($reply);
        }

        Comment::destroy($this->comment->id);
        $this->comment = null;
        $this->emit('commentWasDeleted');
    }

    public function deleteRelatedReply($reply)
    {
        $subReplies = $reply->replies()->get();

        if (! $subReplies->isEmpty())
        {
            foreach ($subReplies as $subReply)
            {
                $this->deleteRelatedReply($subReply);
            }
        }
        
        Comment::destroy($reply->id);
        $reply = null;
    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}
