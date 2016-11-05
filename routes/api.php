<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Auth */
Route::any('/auth/new', 'AuthController@auth');    // Get token
Route::any('/auth/ref', 'AuthController@refresh'); // Refresh token
Route::any('/auth/check', 'AuthController@check'); // Check token for errors
Route::any('/auth/roles', 'AuthController@roles'); // Get all roles of current user

/* Routes, than doesn't require roles */
Route::any('/updates/{stamp}', 'UpdatesController@updates');
Route::any('/theatre/', 'TheatreController@index'); // Get list of theatres and their halls


/* Routes, that require roles */
Route::any('/theatre/create', 'TheatreController@store')->middleware('role:create_theatre');

