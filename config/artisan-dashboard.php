<?php

return [

    /**
     * The kernel class
     */
    'class' => App\Kernel\Console::class,

    /**
     * Prefix the routes
     */
    'prefix' => 'console',

    /**
     * Middleware to apply to the routes
     */
    'middleware' => ['web'],
];