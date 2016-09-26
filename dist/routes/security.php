<?php

/*
|--------------------------------------------------------------------------
| Security Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['prefix' => 'users'], function() {
	Route::get('/','Users@index');
	Route::get('/getData','Users@getData');
	Route::put('/create','Users@store');
	Route::delete('/delete/{id}','Users@delete');
	Route::get('/edit/{id}','Users@edit');
});
