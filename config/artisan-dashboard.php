<?php

return [

    /**
     * The kernel class
     */
    'class' => \App\Console\Kernel::class,

    /**
     * Prefix the routes
     */
    'prefix' => 'console',

    /**
     * Middleware to apply to the routes
     */
    'middleware' => ['web'],
];