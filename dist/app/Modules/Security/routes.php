<?php

//SECURITY
 	Route::get('logout', 'Users@logout');

	Route::group(['prefix' => 'security','middleware'=>'auth'], function () {
	    Route::group(['prefix' => 'access'], function () {
	    	Route::get('/', 'Security@index');
		    Route::post('access', 'Security@access');
		    Route::post('accounts', 'Security@accounts');
		    Route::post('actions', 'Security@actions');
		});

		Route::group(['prefix' => 'users'], function () {
	    	Route::get('/', 'Users@index');
		    Route::post('event', 'Users@event');
		});

		Route::group(['prefix' => 'email-blast'], function () {
	    	Route::get('/', 'EmailBlast@index');
		    Route::post('event', 'EmailBlast@event');
		});

		Route::group(['prefix' => 'password'], function () {
	    	Route::get('/', 'Password@index');
		    Route::post('event', 'Password@event');
		});

		Route::group(['prefix' => 'logs'], function () {
		    Route::get('/', 'AuditTrails@index');
			Route::post('search', 'AuditTrails@search');
		});
	});

	Route::group(['prefix' => 'reset'], function () {
	    Route::get('/', 'Reset@index');
		Route::post('sendEmailReset','Reset@sendEmailReset');
		Route::post('password','Reset@reset');
	});

	Route::group(['prefix' => 'invite'], function () {
	    Route::get('/', 'Invite@index');
		Route::post('create','Invite@create');
	});
	
	Route::get('changePswd', 'Reset@changePswd');
	Route::post('pchangePswd', 'Reset@pchangePswd');
	
	Route::group(['prefix' => 'profile'], function () {
	    Route::get('/', 'Profile@index');
		Route::post('event', 'Profile@event');

		Route::group(['prefix' => 'account'], function () {
		    Route::get('/', 'Profile@account');
		});

		Route::group(['prefix' => 'help'], function () {
		    Route::get('/', 'Profile@help');
		});
	});

	Route::group(['prefix' => 'help'], function () {
		Route::group(['prefix' => 'contact-us'], function () {
		    Route::get('/', 'ContactUs@index');
		    Route::post('event', 'ContactUs@event');
		});
		Route::group(['prefix' => 'faq'], function () {
		    Route::get('/', 'FAQ@index');
		    Route::post('event', 'FAQ@event');
		});
	});
?>