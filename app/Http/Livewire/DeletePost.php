<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Response;
use Livewire\Component;

class DeletePost extends Component
{
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function deletePost()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->post))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->post->delete();

        $this->emit('postWasDeleted');

        return redirect(route('post.index'));
    }

    public function render()
    {
        return view('livewire.delete-post');
    }
}
