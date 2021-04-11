<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/FontAwesome.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css?no-cache='.rand()) }}" rel="stylesheet">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,300&display=swap');
      /* Set the border color */ 
        
      .custom-toggler.navbar-toggler { 
          border-color: rgb(225, 170, 40); 
      } 
      /* Setting the stroke to green using rgb values (0, 128, 0) */ 
        
      .custom-toggler .navbar-toggler-icon { 
          background-image: url( "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(225, 170, 40)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E"); 
      } 
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
            <div class="container">
                <a class="navbar-brand text-light font-weight-bold" href="{{ url('/teacher-dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon my-toggler"></span>
                </button> --}}
                <button class="navbar-toggler ml-auto custom-toggler" 
                        type="button" 
                        data-toggle="collapse"  data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
                        data-target="#nav3"> 
                        <span class="navbar-toggler-icon"></span> 
                </button> 

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-light">
                        <!-- Authentication Links -->
                        {{-- @guest
                          @if (Route::has('login'))
                              <li class="nav-item">
                                  <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                              </li>
                          @endif
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                        @else
                          <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ ucwords(Auth::user()->name) }} 
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
                        @endguest --}}
                    </ul>
                    <div class="row w-100 ml-auto text-light lheight-2p6 header-rs">
                      <div class="col-lg-2 offset-lg-5 mt-1 ico-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="inputSuccess4">
                      </div>
                      <div class="col-lg-1 text-center" style="max-width: 3.6%;">
                        <i class="far fa-calendar-alt cursor"></i>
                        <span class="badge badge-danger badge-pill i-notif">14</span>
                      </div>
                      <div class="col-lg-1 text-center" style="max-width: 3.6%;">
                        <i class="far fa-heart cursor"></i>
                        <span class="badge badge-danger badge-pill i-notif">14</span>
                      </div>
                      <div class="col-lg-1 text-center" style="max-width: 3.6%;">
                        <i class="far fa-envelope cursor"></i>
                        <span class="badge badge-danger badge-pill i-notif">14</span>
                      </div>
                      <div class="col-lg-1 text-center" style="max-width: 3.6%;">
                        <i class="fas fa-bell cursor"></i>
                        <span class="badge badge-danger badge-pill i-notif">14</span>
                      </div>
                      <div class="col-lg-2 text-right">
                        {{-- <span class="span-profile-n">Juan Dela Cruz</span> --}}
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $data->email }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                      </div>
                      <div class="col-lg-1 text-left">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')


            {{-- {{ Auth::user()->id }} --}}
        </main>
    </div>
</body>
</html>


<style>
	.container-xl, .container-lg, .container-md, .container-sm, .container {
		max-width: 100%;
	}
</style>