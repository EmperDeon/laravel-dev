<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Article;
use App\Poster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index')
        ->with('posters', Poster::closest(4)->get())
        ->with('articles', Article::limit(4)->get());
}
);
// TODO: Move to modal
Route::get('/register', function () { return view('auth.register'); });

Route::get('/auth/logout', 'AuthController@logout');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/register', 'Auth\RegisterController@register');


Route::get('/actors/', 'ActorController@index');
Route::get('/actors/{id}', 'ActorController@show');

Route::get('/theatres/', 'TheatreController@index');
Route::get('/theatres/{id}', 'TheatreController@show');

Route::get('/articles/', 'ArticleController@index');
Route::get('/articles/{id}', 'ArticleController@show');

Route::get('/posters/', 'PosterController@index');
Route::get('/posters/{id}', 'T_PerformanceController@show');

Route::get('/performances/', 'T_PerformanceController@index');
Route::get('/performances/{id}', 'T_PerformanceController@show');


//Auth::routes();
