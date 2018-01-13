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


    /**
     * Accepted Namespaces
     * If you don't define accepted namespaces it will return all artisan commands.
     * You can restrict wish commands by giving the namespace prefix. e.g. App\\
     *
     */
    'accepted-namespaces' => ['App\\'],

    /**
     * Showable
     * If you want a specific command to show which might otherwise not show,
     * add it to the showable array. The showable class must not have a property of
     * dontShow defined on the class
     */
    'showable' => [
        // \Symfony\Component\Console\Command\ListCommand::class
    ],

    /**
     * Hidden
     * If you want a specific command not to show that might other wise be shown,
     * you can either add a property of dontShow to that class or add it to the hidden
     * array
     */
    'hidden' => [
        // \App\Console\Commands\SomeClass::class
    ],

    /**
     * Urls of links displayed in the navigation
     */
    'links' => [

        // Link to your main admin panel
        // specify either route or url, not both
        'admin' => [
            'route' => null, // e.g. 'route' => 'admin.index'
            'url'   => null, // e.g. 'url' => '/admin's
        ],

        // Link to your main website
        // specify either route or url, not both
        'main' => [
            'route' => null,
            'url'   => null,
        ],

        // Link to your logout route if you're using auth
        // specify either route or url, not both
        'logout' => [
            'route' => null,
            'url'   => null,
        ],
    ]
];