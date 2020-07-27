<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        // return $user;
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(50)
        ]);
    }

    public function edit(User $user)
    {
        // if($user->isNot(current_user())){
        //     abort(404);
        // }  

        // Le  code ci-dessus est tout à fait correct, mais on peut utiliser une policy comme ici (voir class policy): 
        // $this->authorize('edit', $user); // -> ici nous l'avons exploité directement dans le web route
        
        return view('profiles.edit', ['user' => $user]);
    }
    
    public function update(User $user)
    {
       $attributes = request()->validate([
           'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
           'name' => ['string', 'required', 'max:255'],
           'avatar' => ['file'],
           'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
           'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed'] // Le confirmed = va check après un champ password_confirmation et exiger une équivalence entre ses deux champs
       ]);

       if(request('avatar')){
            $attributes['avatar'] = request('avatar')->store('avatars');
       }
       
       $user->update($attributes);

       return redirect(route('profile-edit', $user));
    }
    
}
