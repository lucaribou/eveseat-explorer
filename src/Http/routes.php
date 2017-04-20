<?php

Route::group([
    'namespace' => 'Seat\Cara\Explorer\Http\Controllers',
    'middleware' => ['web', 'bouncer:explorer.view'],
    'prefix' => 'explorer'
], function () {

	Route::group([
		'prefix' => 'maps'
	], function() {

   		Route::get('/', [
			'as' => 'explorer.maps.index',
			'uses' => 'MapsController@index',
		]);

	});

	Route::group([
		'prefix' => 'settings'
	], function() {

   		Route::get('/', [
			'as' => 'explorer.settings.index',
			'uses' => 'SettingsController@index',
		]);

	});
});