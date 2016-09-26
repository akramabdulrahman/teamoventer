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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('event', "EventsController");
Route::resource('team', "TeamsController");
Route::resource('task', "TasksController");
Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::get('photos','PhotosController@index');
Route::post('photos/create','PhotosController@create');
Route::post('photos/{photo}/like','PhotosController@like');
Route::post('photos/{photo}/comment','PhotosController@comment');
