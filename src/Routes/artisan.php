<?php



Route::prefix(config('artisan-dashboard.prefix', 'console'))
    ->middleware(config('artisan-dashboard.middleware', ['web']))
    ->namespace('Midnite81\ArtisanDashboard\Controllers')
    ->group(function($router) {

        $router->get('/', 'ConsoleController@index')->name('midnite81.artisan.dashboard');
        $router->get('/{command}/view', 'ConsoleController@view')->name('midnite81.artisan.view');
        $router->post('/{command}/execute', 'ConsoleController@execute')->name('midnite81.artisan.execute');

    });

