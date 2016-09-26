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

Route::group(['prefix' => 'users','middleware'=>'web'], function() {

	Route::get('/logout','Users@logout');
	Route::get('/login','Users@login');
	Route::get('/','Users@index');
	Route::get('/getData','Users@getData');

	Route::get('/edit/{id}','Users@edit');
	Route::get('/getRoles','Users@getRoles');
	Route::get('/getLevels','Users@getLevels');
	Route::get('/getPositions','Users@getPositions');
	Route::get('/getDepartments','Users@getDepartments');

	Route::put('/create','Users@store');
	Route::patch('/update/{id}','Users@update');
	Route::delete('/delete/{id}','Users@delete');
});
