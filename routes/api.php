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

Route::get('/tasks', 'TaskController@index');

Route::post('/tasks', 'TaskController@store');

Route::get('/tasks/{id}', 'TaskController@details');

Route::delete('/tasks/{id}', 'TaskController@delete');

Route::put('/tasks/{id}', 'TaskController@update');
