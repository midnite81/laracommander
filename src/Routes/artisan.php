<?php

Route::group([
    'middleware' => config('laracommander.middleware', ['web']),
    'namespace' => 'Midnite81\LaraCommander\Controllers',
    'prefix' => config('laracommander.prefix', 'console'),
], function($router) {
    $router->get('/', 'ConsoleController@index')->name('midnite81.artisan.dashboard');
    $router->get('/{command}/view', 'ConsoleController@view')->name('midnite81.artisan.view');
    $router->post('/{command}/execute', 'ConsoleController@execute')->name('midnite81.artisan.execute');
});