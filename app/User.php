<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Followable fait référence à une sorte de classe d'héritage
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $guarded = [];
    protected $fillable = [
        'username', 'name', 'avatar', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Ceci est un accesseur reconnu par Laravel. Dans mes vues je peux faire appelle directement à la propriété "avatar" grâce à cette méthode
    public function getAvatarAttribute($value)
    {
        if($value) $value = 'storage/' . $value;
        else $value = '/images/default-avatar.jpeg';

        return asset($value);
        // return "https://i.pravatar.cc/200?u=" . $this->email; // plus besoin de ça car nous avons l'upload actif
    }

    // Méthode qui va s'occuper de crypter les mdp
    public function setPasswordAttribute($value)
    {
       $this->attributes['password'] = bcrypt($value);
    }    

    // Récupérer nos propres tweets, mais également ceux de nos follows
    public function timeline()
    {
        // inclure tous les tweets des utilisateurs
        // Ainsi que les tweets de ceux que nous suivons
        // Ceci par ordre DESC via la date de création

        // Je récupère tous les id des personnes suivie via pluck et en m'appuyant de la méthode follows
        // Le fait d'avoir mis "()" à follows permet de ne pas prendre la collection complète, mais uniquement les IDS. Cela rend l'agorithme plus efficace.
        $ids = $this->follows()->pluck('id');
        // J'intègre à ce tableau l'id de la personne connectée
        // $ids->push($this->id); -> Cette ligne est remplacée par orWhere dans la ligne de code suivant

        // On affiche les tweets dont l'id est soit un follow soit sois-même
        // whereIn vérifie si les valeurs données sont existante
        return Tweet::whereIn('user_id', $ids)
            ->orWhere('user_id', $this->id)
            ->withLikes()
            ->latest()
            ->paginate(50);
    }

    // Récupérer uniquement nos propres tweets
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }  

    // Va écraser la route par défaut pour afficher le profil d'un utiliseur
    // Par défaut Laravel travail uniquement avec l'id pour récupérer un utilisateur alors qu'ici nous souhaiton afficher le profil utilisateur via son username et non l'id 
    // Cependant à partir Larvel 7, cette méthode n'est plus nécessaire, on peut faire une déclaration directement dans web route. Mais il faudra toutefois faire référence à user->name dans les vues. Si on veut pouvoir mettre que user alors on doit activer cette méthode.
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function likes()
    {
       return  $this->hasMany(Like::class);
    }
}
