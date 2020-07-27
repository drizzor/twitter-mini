<?php

// Petite astuce afin de voir la query executée par Laravel
// DB::listen(function ($query) {var_dump($query->sql, $query->bindings); });

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Le middleware aurait très bien pu se mettre dans le TweetsController, les deux choix son correct.
Route::middleware('auth')->group(function(){
    // Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store');

    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
    Route::post('/tweets/{tweet}/dislike', 'TweetLikesController@store2');

    Route::post('profiles/{user:username}/follow', 'FollowsController@store');
    Route::get('/profiles/{user:username}/edit', "ProfilesController@edit")->name('profile-edit')->middleware('can:edit,user');
    Route::put('/profiles/{user:username}', 'ProfilesController@update')->name('profile-update')->middleware('can:edit,user');
    // user:name = Laravel va chercher après le nom pour trouver l'utilisateur (et non l'id par défaut)
    Route::get('profiles/{user:username}', 'ProfilesController@show')->name('profile');

    Route::get('/explore', 'ExploreController');
});

Auth::routes();