<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Generate 'REST' API routes for model
 *
 * @param $n - Model name
 */
function addRoute ($n, $c) {
    Route::any('/'.$n.'s/',       $c . 'Controller@all')->middleware('role:' . $n . 's');
    Route::any('/'.$n.'s/create', $c . 'Controller@store')->middleware('role:' . $n . '_create');
    Route::any('/'.$n.'s/edit',   $c . 'Controller@update')->middleware('role:' . $n . '_edit');
    Route::any('/'.$n.'s/delete', $c . 'Controller@delete')->middleware('role:' . $n . '_delete');
    Route::any('/'.$n.'s/{id}',   $c . 'Controller@get');
}


/* Auth */
Route::any('/auth/new', 'AuthController@auth');    // Get token
Route::any('/auth/ref', 'AuthController@refresh'); // Refresh token
Route::any('/auth/check', 'AuthController@check'); // Check token for errors
Route::any('/auth/perms', 'AuthController@perms'); // Get all permissions of current user

Route::any('/updates/{stamp}', 'UtilsController@updates'); // All rows that updated since $stamp
Route::any('/lists/{name}', 'UtilsController@lists'); // Get lists of id-name to ComboBoxes and ListWidgets in admin app
Route::any('/theatres/change', 'UtilsController@change');


/* Model routes */
addRoute('article', 'Article');
//addRoute('actor'  , 'Actor'  );
addRoute('theatre', 'Theatre');
addRoute('user'   , 'User'   );

addRoute('t_perf', 'T_Performance');
addRoute('poster', 'Poster');

