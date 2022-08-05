<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateLikeException;
use App\Exceptions\LikeNotFoundException;
use App\Models\Post;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public $likesCount;
    public $hasLiked;
    public $commentCount;

    protected $listeners = [
        'commentWasAdded',
        'replyWasAdded',
        'postWasUpdated',
    ];

    public function mount(Post $post, $likesCount)
    {
        $this->post = $post;
        $this->likesCount = $likesCount;
        $this->hasLiked = $post->isLikedByUser(auth()->user());
    }

    public function commentWasAdded()
    {
        $this->post->refresh();
    }

    public function replyWasAdded()
    {
        $this->post->refresh();
    }

    public function postWasUpdated()
    {
        $this->post->refresh();
    }

    public function createLike()
    {
        if (! auth()->check())
        {
            return redirect(route('login'));
        }

        if ($this->hasLiked)
        {
            try {
                $this->post->removeLike(auth()->user());
            } catch(LikeNotFoundException) {
                // do nothing
            }
    
            $this->likesCount--;
            $this->hasLiked = false;
        }
        else
        {
            try {
                $this->post->like(auth()->user());
            } catch(DuplicateLikeException $e) {
                // do nothing
            }
    
            $this->likesCount++;
            $this->hasLiked = true;
        }
    }

    public function render()
    {
        return view('livewire.post-show');
    }
}
