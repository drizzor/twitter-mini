<?php

namespace App;

// Un trait est simplement un groupe de methodes que l'ont souhaite inclure dans une autre classe.
// A la base les méthodes de follow étaient directement dans la class model User
// Cette class doit etre vue comme abstraite, elle ne peut pas être directement instanciée
// En gros l'idée est de scinder le code et éviter de surcharger la class User
trait Followable
{
    // Lancer l'action de suivre une nouvelle personne
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
       return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        // if($this->isFollowing($user)) {
        //     return $this->unfollow($user);
        // }
        // return $this->follow($user);
        $this->follows()->toggle($user);
    }    
        
    // Check si l'utilisteur est déjà suivi
    public function isFollowing(User $user)
    {
        // return $this->follows->contains($user); -> cette méthode fonctionne, mais il vaut miex l'éviter car elle charge une collection complète contrairement à la seconde ligne
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }  

    // Montrer la liste des personnes que l'ont suis
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}