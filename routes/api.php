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


Route::any('/updates/{stamp}', 'UtilsController@updates'); // All rows that updated since $stamp

Route::any('/lists/{name}', 'UtilsController@lists'); // Get lists of id-name to ComboBoxes and ListWidgets in admin app

/* Model routes */
Route::any('/actors/', 'ActorController@all');


Route::any('/articles/', 'ArticleController@all');


Route::any('/perfs/', 'PerformanceController@all');


Route::any('/posters/', 'PosterController@all');


Route::any('/t_halls/', 'T_HallController@all');


Route::any('/t_perfs/', 'T_PerformanceController@all');


Route::any('/theatres/', 'TheatreController@all'); // Get list of theatres and their halls
Route::any('/theatres/create', 'TheatreController@store')->middleware('role:create_theatre');
Route::any('/theatres/edit', 'TheatreController@update')->middleware('role:edit_theatre');
Route::any('/theatres/delete', 'TheatreController@delete')->middleware('role:delete_theatre');

Route::any('/users/', 'UserController@all');
Route::any('/users/create', 'UserController@store');
Route::any('/users/edit', 'UserController@update');
Route::any('/users/delete', 'UserController@delete');


