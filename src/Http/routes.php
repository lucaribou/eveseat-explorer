<?php

Route::group([
    'namespace' => 'Seat\Cara\Explorer\Http\Controllers',
    'middleware' => ['web', 'bouncer:explorer.view'],
    'prefix' => 'explorer'
], function () {

	Route::group([
		'prefix' => 'maps',
		'middleware' => ['sso-auth', 'explorer-settings']
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

	Route::group([
		'prefix' => 'auth'
	], function() {
		Route::get('/', [
			'as' => 'explorer.auth.index',
			'uses' => 'AuthController@index',
		]);

		Route::get('callback', [
			'as' => 'explorer.auth.callback',
			'uses' => 'AuthController@callback',
		]);
	});
});