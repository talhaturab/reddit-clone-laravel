<?php

namespace App\Models;

use App\Exceptions\DuplicateLikeException;
use App\Exceptions\LikeNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isLikedByUser(?User $user)
    {
        if (!$user)
        {
            return false;
        }
        return Like::where('user_id', $user->id)
            ->where('post_id', $this->id)
            ->exists();
    }

    public function like(User $user)
    {
        if ($this->isLikedByUser($user)){
            throw new DuplicateLikeException();
        }

        Like::create([
            'user_id' => $user->id,
            'post_id' => $this->id
        ]);
    }

    public function removeLike(User $user)
    {
        $likeToDelete = Like::where('post_id', $this->id)
            ->where('user_id', $user->id)
            ->first();

        if ($likeToDelete){
            $likeToDelete->delete();
        } else {
            throw new LikeNotFoundException();
        }
    }
}
