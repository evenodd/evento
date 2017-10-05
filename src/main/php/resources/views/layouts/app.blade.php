<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Evento') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/flat-ui.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/bootstrap-flat/bootstrap-flat.css') }}" rel="stylesheet"> -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="app" class="" style="height:100vh;">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/event/public">Public Events</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Events<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/event/manager">Event Manager</a></li>
                                    @can('create', App\Evento::class)
                                    <li><a href="/event/create">Create Event</a></li>
                                    @endcan
                                    <li><a href="/event/list">Event List</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Venues<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/venue/create">Create Venue</a></li>
                                </ul>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/venue/venuelist">Venue list</a></li>
                                </ul>
                            </li>
                            <li><a href="/calendar">Calendar</a></li>
                            <li class="dropdown"> 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Supplier<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/supplier">Create Supplier</a></li>
                                    <li><a href="/supplier_view">Supplier View</a></li>
                                </ul>
                            
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} | <small>{{Auth::user()->type}}</small><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::guest())
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="alertPanel" class="panel-body">
                            @if(isset($status) && isset($msg))
                                @component('components.alerts', ['status' => $status, 'msg' =>$msg])
                                @endcomponent
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="managerPage">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        @yield('sub-content')
                    </div>

                    <div class="col-md-8">
                        @yield('main-content')
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        @yield('modals')
    <!-- Page script -->
    </div>
    @yield('script')
    @stack('scripts')
</body>
</html>
