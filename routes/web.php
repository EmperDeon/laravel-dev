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

Route::get('/', function () {
    return view('index')
        ->with('posters', Poster::closest(4)->get())
        ->with('articles', Article::limit(4)->get());
    }
);

Route::get('/theatres/', 'TheatreController@index');
Route::get('/theatres/{id}', 'TheatreController@show');

Route::get('/articles/', 'ArticleController@index');
Route::get('/articles/{id}', 'ArticleController@show');

Route::get('/posters/', 'PosterController@index');
Route::get('/posters/{id}', 'PerformanceController@show');

Route::get('/performances/', 'PerformanceController@index');
Route::get('/performances/{id}', 'PerformanceController@show');

