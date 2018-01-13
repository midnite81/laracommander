<?php

namespace Midnite81\ArtisanDashboard;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application events.
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laracommander.php' => config_path('laracommander.php')
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../config/laracommander.php', 'laracommander');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/artisan.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'laracommander');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}