<?php
	Route::group(['prefix' => 'setup','middleware'=>'auth'], function () {
		Route::group(['prefix' => 'branch'], function () {
			Route::get('/','Branch@index');
			Route::post('event','Branch@event');
		});
		Route::group(['prefix' => 'department'], function () {
			Route::get('/','Department@index');
			Route::post('event','Department@event');
		});
		Route::group(['prefix' => 'group'], function () {
			Route::get('/','Group@index');
			Route::post('event','Group@event');
		});
		Route::group(['prefix' => 'level'], function () {
			Route::get('/','Level@index');
			Route::post('event','Level@event');
		});
		Route::group(['prefix' => 'position'], function () {
			Route::get('/','Position@index');
			Route::post('event','Position@event');
		});
		Route::group(['prefix' => 'nationality'], function () {
			Route::get('/','Nationality@index');
			Route::post('event','Nationality@event');
		});

		Route::group(['prefix' => 'hotel'], function () {
			Route::group(['prefix' => 'room'], function () {
				Route::get('/','Room@index');
				Route::post('event','Room@event');
			});
			Route::group(['prefix' => 'room-type'], function () {
				Route::get('/','RoomType@index');
				Route::post('event','RoomType@event');
			});
			Route::group(['prefix' => 'floor'], function () {
				Route::get('/','HotelFloor@index');
				Route::post('event','HotelFloor@event');
			});
			Route::group(['prefix' => 'discount'], function () {
				Route::get('/','HotelDiscount@index');
				Route::post('event','HotelDiscount@event');
			});
			Route::group(['prefix' => 'price-type'], function () {
				Route::get('/','PriceType@index');
				Route::post('event','PriceType@event');
			});
			Route::group(['prefix' => 'price-template'], function () {
				Route::get('/','PriceTemplate@index');
				Route::post('event','PriceTemplate@event');
			});
			Route::group(['prefix' => 'complimentary'], function () {
				Route::get('/','Complimentary@index');
				Route::post('event','Complimentary@event');
			});
			Route::group(['prefix' => 'package'], function () {
				Route::get('/','HotelPackage@index');
				Route::post('event','HotelPackage@event');
			});
		});
	});
?>