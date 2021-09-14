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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/darkly/bootstrap.min.css"> --}}
    {{-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.flipster.min.css') }}">
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
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
        <div class="container mw-100">
            <a class="navbar-brand text-light" href="{{ url('/') }}">
                {{-- {{ config('app.name', 'Laravel') }} --}}
                <img src="{{ asset('images/icon-main.png') }}" alt="">
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
                    @guest
                        {{-- @if (Route::has('login')) --}}
                        {{-- login/teachers
                        login/students --}}

                        @if (!$logged_in)
                            <li class="nav-item mr-3">
                                <a href="javascript:void(0);" class="nav-link btn-white font-12 rounded" data-toggle="modal" data-target="#custom-modal-register-teacher">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (!$logged_in)
                            <li class="nav-item">
                                {{-- <a class="nav-link btn-yellow font-12 rounded" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                                <a href="javascript:void(0);" class="nav-link btn-yellow font-12 rounded" data-toggle="modal" data-target="#custom-modal-register-teacher">{{ __('Register') }}</a>
                            </li>
                            <!-- Modal -->
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="">
        @isset($is_verified)
            @if ($is_verified)
                <div class="verified-container d-none">{{ $msg }}</div>
            @endif
        @endisset
        @yield('content')
    </main>
    <div id="app">
        {{-- Modal Teacher Signup--}}
        <div class="modal fade custom-modal-register" id="custom-modal-register-teacher" tabindex="-1" role="dialog" aria-labelledby="custom-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="custom-modal-register-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 signup-login-left p-0">
                                <div class="row">
                                    <div class="col-lg-12 teacher-sign-up-frm">
                                        <signup-form-teacher base_url="{{ url('') }}"></signup-form-teacher>
                                        <div class="row p-3">
                                            <div class="col-5 border border-secondary" style="height:0;"></div>
                                            <div class="col-2 text-center" style="line-height: 0 !important;">Or</div>
                                            <div class="col-5 border border-secondary" style="height:0;"></div>
                                        </div>
                                        <div class="row p-3">
                                            <div class="col-6 text-right"><img src="{{ asset('images/fb-icon.png') }}" alt=""></div>
                                            <div class="col-6 text-left"><img src="{{ asset('images/gmail-icon.png') }}" alt=""></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center font-style-undeline">
                                                <a href="javascript:void(0);" class="text-dark font-14" data-toggle="modal" data-target="#custom-modal-register-student" onclick="$('#custom-modal-register-teacher').modal('hide');"><u>Sign Up as Student</u></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 signup-login-right p-0">
                                <img src="{{ asset('images/banner-icon.png') }}" alt="">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                                    Totam ipsam voluptate rerum vel nulla unde aspernatur eius 
                                    laboriosam quia distinctio sapiente eos explicabo quidem 
                                    nesciunt provident amet, ab, ad porro!</p>
                            </div>
                        </div>
                        {{-- <div id="app">
                            <signup-form></signup-form>
                        </div> --}}
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- Modal Students Signup--}}
        <div class="modal fade custom-modal-register" id="custom-modal-register-student" tabindex="-1" role="dialog" aria-labelledby="custom-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="custom-modal-register-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 signup-login-left p-0">
                                <div class="row">
                                    <div class="col-lg-12 teacher-sign-up-frm">
                                        <signup-form-student base_url="{{ url('') }}"></signup-form-student>
                                        <div class="row p-3">
                                            <div class="col-5 border border-secondary" style="height:0;"></div>
                                            <div class="col-2 text-center" style="line-height: 0 !important;">Or</div>
                                            <div class="col-5 border border-secondary" style="height:0;"></div>
                                        </div>
                                        <div class="row p-3">
                                            <div class="col-6 text-right"><img src="{{ asset('images/fb-icon.png') }}" alt=""></div>
                                            <div class="col-6 text-left"><img src="{{ asset('images/gmail-icon.png') }}" alt=""></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center font-style-undeline">
                                                <a 
                                                    href="javascript:void(0);" 
                                                    class="text-dark font-14" 
                                                    data-toggle="modal" 
                                                    data-target="#custom-modal-register-teacher" onclick="$('#custom-modal-register-student').modal('hide');"><u>Sign Up as Teacher</u></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 signup-login-right p-0">
                                <img src="{{ asset('images/banner-icon.png') }}" alt="">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                                    Totam ipsam voluptate rerum vel nulla unde aspernatur eius 
                                    laboriosam quia distinctio sapiente eos explicabo quidem 
                                    nesciunt provident amet, ab, ad porro!</p>
                            </div>
                        </div>
                        {{-- <div id="app">
                            <signup-form></signup-form>
                        </div> --}}
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>{{-- id="app" --}}
    {{-- Button to top --}}
    <button id="scrollToTopBtn"><i class="fas fa-chevron-up"></i></button>
</div>
<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
<script src="{{ asset('js/jquery.flipster.min.js') }}"></script>
<script>
	var coverflow = $("#coverflow").flipster();
			var carousel = $("#carousel").flipster({
			style: 'carousel',
			spacing: -0.5,
			nav: true,
			buttons:   true,
	});
	var wheel = $("#wheel").flipster({
			style: 'wheel',
			spacing: 0
	});
	var flat = $("#flat").flipster({
			style: 'flat',
			spacing: -0.25
	});
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    window.onscroll = function() {scrollFunction()};
    var rootElement = document.documentElement
    scrollToTopBtn.addEventListener("click", scrollToTop)
    
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }
    function scrollToTop() {
        // Scroll to top logic
        rootElement.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    }
    if ($('div.verified-container').length) {
        $(window).on('load', function(){
            $('.verified-container').removeClass('d-none');
            setTimeout(function(){
                $(".verified-container").fadeOut();
                window.location.href = "{{ url('/') }}";
            }, 3000);
        });
    }

</script>
</body>
<style>
    .verified-container {
        background: #fceabb;
        background: -webkit-linear-gradient(to left, #f8b500, #fceabb);
        background: linear-gradient(to left, #f8b500, #fceabb);
        text-align: right;
        color: #f0f0f0;
        padding: 17px;
    }
</style>

</html>
