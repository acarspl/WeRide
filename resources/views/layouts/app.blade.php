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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo/bike_green.png') }}">

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
                                <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="">Explore</a>
                            </li>
                            <li class="nav-item  mt-3 mx-1 mt-md-0">
                                <a class="px-3 btn btn-green-light nav-link text-white rhombus-right"  href="">My Events</a>
                            </li>
                        <li class="nav-item  mt-3 mr-3 ml-1 mt-md-0">
                            <a class="px-3 btn btn-green-light nav-link text-white rhombus-right border border-white" style="border-width: 1px!important;"  href="">Create Ride</a>
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
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
