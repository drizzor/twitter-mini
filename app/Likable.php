<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'SELECT tweet_id, SUM(liked) as likes, SUM(!liked) as dislikes FROM `likes` group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
        
        // SELECT * FROM `tweets`
        // left join(
        //     SELECT tweet_id, SUM(liked) as likes, SUM(!liked) as dislikes FROM `likes` group by tweet_id
        //     ) likes on likes.tweet_id = tweets.id
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
        [
            'user_id' => $user ? $user->id : auth()->id()
        ], 
        [
            'liked' => $liked
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    // Est-ce que le tweet a été liké par tel utilisateur?
    public function isLikedBy(User $user)
    {
       // $this->likes()->where('user_id', $user->id)->exists(); -> a éviter si cela est exploité dans une boucle
       return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }

    // Est-ce que le tweet a été disliké par tel utilisateur?
    public function isDislikedBy(User $user)
    {
       return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', false)->count();
    }

    public function likes()
    {
       return $this->hasMany(Like::class);
    }
}