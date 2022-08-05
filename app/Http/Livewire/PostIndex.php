<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateLikeException;
use App\Exceptions\LikeNotFoundException;
use App\Models\Post;
use Livewire\Component;

class PostIndex extends Component
{
    public $post;
    public $likesCount;
    public $hasLiked;

    public function mount(Post $post, $likesCount)
    {
        $this->post = $post;
        $this->likesCount = $likesCount;
        $this->hasLiked = $post->liked_by_user;
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

        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.post-index');
    }
}
