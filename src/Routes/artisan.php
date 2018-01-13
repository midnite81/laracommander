<?php

$laraCommandRouteConfig = [
    'namespace' => 'Midnite81\LaraCommander\Controllers',
    'prefix' => config('laracommander.prefix', 'console'),
];

if (! empty(config('laracommander.middleware'))) {
    $laraCommandRouteConfig['middleware'] = config('laracommander.middleware');
}


Route::group($laraCommandRouteConfig, function($router) {
    $router->get('/', 'ConsoleController@index')->name('midnite81.artisan.dashboard');
    $router->get('/{command}/view', 'ConsoleController@view')->name('midnite81.artisan.view');
    $router->post('/{command}/execute', 'ConsoleController@execute')->name('midnite81.artisan.execute');
});