<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{asset('images/logo/bike.png')}}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo/bike_green.png') }}">

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-green  shadow-sm  ">
            <div class="container">
                @guest()
                    <a class="navbar-brand font-weight-bold text-white" href="{{ url('/') }}">
                        @endguest
                        @auth()
                            <a class="navbar-brand text-yellow " href="{{route('home') }}">
                                @endauth
                                <img src="{{asset('images/logo/bike.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                                <span class="px-1">{{ config('app.name', 'Laravel') }}</span>
                            </a>

                <button class="navbar-toggler bg-green-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item  mt-3 mx-1 mt-md-0">
                                <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="{{route('race.index')}}">Races</a>
                            </li>
                            <li class="nav-item  mt-3 mx-1 mt-md-0">
                                <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="{{route('events.index')}}">Explore</a>
                            </li>
                            <li class="nav-item  mt-3 mx-1 mt-md-0">
                                <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="{{route('events.my.index')}}">My Events</a>
                            </li>
                        <li class="nav-item  mt-3 mr-3 ml-1 mt-md-0">
                            <a class="px-3 btn btn-green-light nav-link text-white rhombus-right border border-white" style="border-width: 1px!important;"  href="{{route('ride.create')}}">Create Ride</a>
                        </li>
                        @endauth
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item  mt-3 mt-md-0">
                                    <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item mx-0 mx-md-3 mt-2 mt-md-0">
                                    <a class="px-3 btn btn-green-light nav-link text-white rhombus-right" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white mt-3 mt-md-0 text-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('avatars/'.\Illuminate\Support\Facades\Auth::id().'.jpg'))
                                  <img src="{{\Illuminate\Support\Facades\Storage::url('avatars/'.\Illuminate\Support\Facades\Auth::id().'.jpg')}}" style="width: 30px" class="mx-1 rounded-circle" alt="Avatar">
                                        @endif{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.preferences.show') }}">
                                        {{ __('Preferences') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
