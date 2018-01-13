# LaraCommander - Artisan Web Dashboard
[![Latest Stable Version](https://poser.pugx.org/midnite81/laracommander/version)](https://packagist.org/packages/midnite81/laracommander) [![Total Downloads](https://poser.pugx.org/midnite81/laracommander/downloads)](https://packagist.org/packages/midnite81/laracommander) [![Latest Unstable Version](https://poser.pugx.org/midnite81/laracommander/v/unstable)](https://packagist.org/packages/midnite81/laracommander) [![License](https://poser.pugx.org/midnite81/laracommander/license.svg)](https://packagist.org/packages/midnite81/laracommander)

_A web dashboard for Artisan Commands_

Once you've installed LaraCommander, you may wish to view the guide to [How the Dashboard works](dashboard.md)

# Installation

This package requires PHP 5.6+, and includes a Laravel 5 Service Provider.

To install through composer include the package in your `composer.json`.

    "midnite81/laracommander": "1.*"

Run `composer install` or `composer update` to download the dependencies or you can run `composer require midnite81/laracommander`.

## Laravel 5 Integration

If you're using Laravel 5.5, you can ignore the first part of this as Laravel will auto discover this package, but you 
will need to publish the config file.

To use the package with Laravel 5 firstly add the LaraCommander service provider to the list of service providers 
in `app/config/app.php`.

    'providers' => [
      ...
      Midnite81\LaraCommander\CommandServiceProvider::class,
      Collective\Html\HtmlServiceProvider::class,
      ...       
    ];
    
 ### Publish the config       
    
Publish the config files using 
`php artisan vendor:publish --provider="Midnite81\LaraCommander\CommandServiceProvider"`

If you're using Laravel 5.5 or above you can simply type `php artisan vendor:publish` and select 
`Provider: Midnite81\LaraCommander\CommandServiceProvider`
    
# Configuration File

Once you have published the config files, you will find a `laracommander.php` file in the `config` folder. It is 
important that you look through these settings and update these where necessary. By default LaraCommander isn't 
set to use any auth middleware, which can be set in the config depending on your needs. 

# Setup complete

If you've followed the steps above you should now be able to load the LaraCommander Dashboard by going to 
http://example.com/console (or whatever url you're specified in the config).