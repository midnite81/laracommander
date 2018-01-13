<?php



Route::prefix(config('laracommander.prefix', 'console'))
    ->middleware(config('laracommander.middleware', ['web']))
    ->namespace('Midnite81\LaraCommander\Controllers')
    ->group(function($router) {

        $router->get('/', 'ConsoleController@index')->name('midnite81.artisan.dashboard');
        $router->get('/{command}/view', 'ConsoleController@view')->name('midnite81.artisan.view');
        $router->post('/{command}/execute', 'ConsoleController@execute')->name('midnite81.artisan.execute');

    });

