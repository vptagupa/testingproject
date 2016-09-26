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

Route::get('/auth/login','Auth\LoginController@showLoginForm');
Route::post('/auth/login','Auth\LoginController@login');
// Route::get('/login','Auth\LoginController@showLoginForm');