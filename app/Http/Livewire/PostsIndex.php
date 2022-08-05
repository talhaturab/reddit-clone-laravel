<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    public function render()
    {
        return view('livewire.posts-index', [
            'posts' => Post::addselect(['liked_by_user' => Like::select('id')
                ->where('user_id', auth()->id())
                ->wherecolumn('post_id', 'posts.id')
            ])
                ->withCount('comments')
                ->withCount('likes')
                ->latest('id')
                ->paginate(10),
        ]);
    }
}
