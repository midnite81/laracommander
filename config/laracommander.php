<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kernel Class
    |--------------------------------------------------------------------------
    |
    | This is the location of the kernel class to enable LaraCommander to be able
    | to get the available commands. Commands do not have to be registered to in the
    | kernel's commands property to be made available.
    |
    */

    'class' => \App\Console\Kernel::class,

     /*
     |--------------------------------------------------------------------------
     | Route Prefix
     |--------------------------------------------------------------------------
     |
     | This is the url prefix you would like to access LaraCommander from. By default
     | it is console, but you may want to make it 'admin/console' if you have an admin
     | section.
     |
     */

    'prefix' => 'console',

     /*
     |--------------------------------------------------------------------------
     | Route Middleware
     |--------------------------------------------------------------------------
     |
     | This allows you to specify the middleware you wish to be active on LaraCommander.
     | By default it is just the 'web' middleware, but it is strongly recommended that you
     | place this behind either laravel's default auth or equivalent middleware.
     |
     */

    'middleware' => ['web'],

     /*
     |--------------------------------------------------------------------------
     | Accepted Namespaces
     |--------------------------------------------------------------------------
     |
     | This allows you to limit commands show to those in a particular set of
     | namespaces. It is unadvisable to allow unrestricted listing of all artisan
     | commands. By default it is restricted to the app namespace.
     |
     */

    'accepted-namespaces' => ['App\\'],

     /*
     |--------------------------------------------------------------------------
     | Showable Commands
     |--------------------------------------------------------------------------
     |
     | This allows you to define certains classes you want to show regardless
     | of if they are allowed within the accepted-namespaces array above, or
     | whether or not they have the dontShow property defined.
     |
     */
    'showable' => [
        // \Symfony\Component\Console\Command\ListCommand::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Hidden Commands
    |--------------------------------------------------------------------------
    |
    | If you wish to hide any commands which might otherwise be shown, you can either
    | add a property of dontShow to that commands class or add it to the hidden array
    |
    */

    'hidden' => [
        // \App\Console\Commands\SomeClass::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-complete
    |--------------------------------------------------------------------------
    |
    | If you don't want fields to autocomplete set the following property to false.
    |
    */

    'autocomplete' => true,

     /*
     |--------------------------------------------------------------------------
     | Memory and runtime
     |--------------------------------------------------------------------------
     |
     | When you run a command through the command line there are different expectations
     | on run time and memory needed.
     |
     */

     'runtime' => [
         /**
          * The amount of memory you want to provide the command
          * When null it will take the default. It uses the ini_set method to set
          * the memory limit and there are limits on that. You may need to consult your
          * system administrator if in doubt.
          */
         'memory' => null, // example value '2048M'

         /**
          * The amount of time your command can uses before it times out.
          * When null it will take the default, usually 30 seconds. You should specify
          * the time in seconds. For example, 5 minutes is 300 seconds but can be specified either
          * as 300 or 60 * 5. If you want to allow infinite runtime, set it to 0, but this can be
          * risky on a web dashboard.
          */
         'timeout' => null, // example 60 * 5
     ],

    /*
    |--------------------------------------------------------------------------
    | URL links
    |--------------------------------------------------------------------------
    |
    | By default, LaraCommander comes with a navigation bar which can link to
    | other parts of your application (admin, main site and logout). If you wish
    | to make use of these then either provide the route or url for the section.
    | Route will take precedence over url
    |
    */

    'links' => [

        // Link to your main admin panel
        'admin' => [
            'route' => null, // e.g. 'route' => 'admin.index'
            'url'   => null, // e.g. 'url' => '/admin'
        ],

        // Link to your main website
        'main' => [
            'route' => null,
            'url'   => null,
        ],

        // Link to your logout route if you're using auth
        'logout' => [
            'route' => null,
            'url'   => null,
        ],
    ],

    /**
     * You can override the default views if you wish to.
     * Please bear in mind that the inner content has bootstrap styling.
     */

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    |
    | By default, LaraCommander comes with a set of default views, however it is understandable,
    | that you may wish to customise it in keeping with your admin system. You can define views
    | that are used in place of the default ones. You will need to include a view within your
    | view as specified below to enable to LaraCommander to work.
    |
    */

    'views' => [
        // index : lists all the commands available
        'index' => null, // you will need to include laracommander::data.index in this view

        // view : lists the arguments and options for a particular command
        'view' => null, // you will need to include laracommander::data.view in this view
    ]
];