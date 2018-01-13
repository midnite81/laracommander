<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a href="{{ route('midnite81.artisan.dashboard') }}" class="navbar-brand">
                <div class="brand-title">LaraCommander</div>
            </a></div>
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                @if(! empty(config('laracommander.links.admin.route')) || ! empty(config('laracommander.links.admin.url')))
                    <li>
                        <a href="{{ ! empty(config('laracommander.links.admin.route')) ?
                                      route(config('laracommander.links.admin.route')) :
                                      config('laracommander.links.admin.url') }}">
                            Admin Home
                        </a>
                    </li>
                @endif

                    @if(! empty(config('laracommander.links.main.route')) || ! empty(config('laracommander.links.main.url')))
                        <li>
                            <a href="{{ ! empty(config('laracommander.links.main.route')) ?
                                      route(config('laracommander.links.main.route')) :
                                      config('laracommander.links.main.url') }}">
                                Main Site
                            </a>
                        </li>
                    @endif

                    @if(! empty(config('laracommander.links.logout.route')) || ! empty(config('laracommander.links.logout.url')))
                        <li>
                            <a href="{{ ! empty(config('laracommander.links.logout.route')) ?
                                      route(config('laracommander.links.logout.route')) :
                                      config('laracommander.links.logout.url') }}">
                                Logout
                            </a>
                        </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>