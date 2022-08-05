<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Response;
use Livewire\Component;

class CreatePost extends Component
{
    public $postTitle;
    public $postDescription;

    protected $rules = [
        'postTitle' => 'required|min:4',
        'postDescription' => 'required|min:4',
    ];

    public function createPost()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();
        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $this->postTitle,
            'description' => $this->postDescription,
        ]);

        $this->reset();

        return redirect()->route('post.index');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
