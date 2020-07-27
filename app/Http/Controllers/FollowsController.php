<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        // Ceci marche très bien, mais pour diminuer le code la seconde pratique a été utilisée
        // if(auth()->user()->isFollowing($user)) {
        //     auth()->user()->unfollow($user);
        // } else {
        //     auth()->user()->follow($user);
        // }
       auth()->user()->toggleFollow($user);
       return back();
    }        
}
