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

Route::get('/', function () { return view('index'); });

Route::get('/auth/logout', 'AuthController@logout');

Route::get('/theatres/', 'TheatreController@index');
Route::get('/theatres/{id}', 'TheatreController@show');

Route::get('/articles/', 'ArticleController@index');
Route::get('/articles/{id}', 'ArticleController@show');


Auth::routes();
