<?php

Route::group([
    'namespace' => 'Seat\Cara\Explorer\Http\Controllers',
    'middleware' => 'web',
    'prefix' => 'explorer',
    'as'    => 'explorer.'
], function () {

    Route::resource('map', 'ExplorerController');
});