<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('') }}">
    <meta name="url-asset" content="{{ asset('') }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    
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

    {{-- custom scrollbar --}}
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
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
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-black shadow-sm">
          <a class="navbar-brand text-light font-weight-bold" href="{{ url('/teachers') }}">
              {{-- {{ config('app.name', 'Laravel') }} --}}
              <img src="{{ asset('images/icon-main.png') }}" alt="">
          </a>
          
          <button class="navbar-toggler ml-auto custom-toggler" 
                  type="button" 
                  data-toggle="collapse"  data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
                  data-target="#nav3"> 
                  <span class="navbar-toggler-icon"></span> 
          </button> 
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
              {{-- <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li> --}}
            </ul>
            <span class="navbar-text my-2 my-lg-0">
              <a href="">
                <i class="far fa-calendar-alt cursor i-con"></i>
                <span class="badge badge-danger badge-pill i-notif">14</span>
              </a>
              
              <a href="">
                <i class="far fa-heart cursor i-con"></i>
                <span class="badge badge-danger badge-pill i-notif">14</span>
              </a>
              <span>
                <a href="#" id="navShowStudentMsg" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="far fa-envelope cursor i-con" ></i>
                    <span class="badge badge-danger badge-pill i-notif">16</span>
                </a>
                <div class="dropdown-menu card-student-msg-cont dropdown-menu-right p-2 custom-scrollbar-css mCustomScrollbar" data-mcs-theme="minimal-dark" aria-labelledby="navShowStudentMsg">
                  <div class="card-group card-student-msg pb-1">
                    <span class="font-12">Unread <span class="badge badge-danger">1</span></span>
                  </div>
                  <div class="card-group card-student-msg pb-1">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{ asset('images/ellipse-2.png') }}" alt="">
                        <small class="text-muted"><strong>Mr. James Cameron</strong></small>
                        <small class="float-right"><strong>08:00 am</strong></small>
                        <p class="font-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa necessitatibus excepturi expedita unde adipisci deserunt d</p>
                      </div>
                    </div>
                  </div>
                  <div class="card-group card-student-msg pb-1">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{ asset('images/ellipse-2.png') }}" alt="">
                        <small class="text-muted"><strong>Mr. James Cameron</strong></small>
                        <small class="float-right"><strong>08:00 am</strong></small>
                        <p class="font-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa necessitatibus excepturi expedita unde adipisci deserunt d</p>
                      </div>
                    </div>
                  </div>
                  <div class="card-group card-student-msg pb-1">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{ asset('images/ellipse-2.png') }}" alt="">
                        <small class="text-muted"><strong>Mr. James Cameron</strong></small>
                        <small class="float-right"><strong>08:00 am</strong></small>
                        <p class="font-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa necessitatibus excepturi expedita unde adipisci deserunt d</p>
                      </div>
                    </div>
                  </div>
                </div>
              </span>

              <a href="">
                <i class="fas fa-bell cursor i-con"></i>
                <span class="badge badge-danger badge-pill i-notif">14</span>
              </a>

              <span class="float-right">
                <a id="navbarDropdownSettings" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Hi Students, <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right settings-cont font-12 p-3" aria-labelledby="navbarDropdownSettings">
                  <a class="dropdown-item l-h-1p4 font-weight-bold" href="#">
                    Hi Students,
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    {{ strtoupper($data->email) }}
                  </a>
                  <hr>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Your Profile
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Edit Profile
                  </a>
                  <hr>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Calendar
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Notifications
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Messages
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Favorites
                  </a>
                  <hr>
                  <a class="dropdown-item l-h-1p4" href="{{ url('students-account-settings') }}">
                    Account Settings
                  </a>
                  <a class="dropdown-item l-h-1p4" href="{{ url('students-payment-methods') }}">
                    Payment Methods
                  </a>
                  <a class="dropdown-item l-h-1p4" href="#">
                    Heygo Credits
                  </a>
                  <a class="dropdown-item l-h-1p4" href="{{ url('students-purchase-history') }}">
                    Purchase History
                  </a>
                  <hr>
                  <a class="dropdown-item pb-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <i class="fas fa-arrow-alt-circle-right" style="float: left;margin-right: 7px;margin-top: 3px;"></i><span> {{ __('Logout') }}</span>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

                </div >
              </span>
            </span>
          </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
            {{-- {{ Auth::user()->id }} --}}
        </main>
    </div>



{{-- custom scrollbar --}}
<!-- Google CDN jQuery with fallback to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
{{-- <script>window.jQuery || document.write('<script src="../js/minified/jquery-1.11.0.min.js"><\/script>')</script> --}}

<!-- custom scrollbar plugin -->
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script>
  (function($){
    $(window).on("load",function(){
      
      $("#content-3").mCustomScrollbar({
        scrollButtons:{enable:true},
        theme:"light-thick",
        scrollbarPosition:"outside"
      });
      
      $("#content-4").mCustomScrollbar({
        theme:"rounded-dots",
        scrollInertia:400
      });
      
      $("#content-5").mCustomScrollbar({
        axis:"x",
        theme:"dark-thin",
        autoExpandScrollbar:true,
        advanced:{autoExpandHorizontalScroll:true}
      });
      
      $("#content-6").mCustomScrollbar({
        axis:"x",
        theme:"light-3",
        advanced:{autoExpandHorizontalScroll:true}
      });
      
      $("#content-7").mCustomScrollbar({
        scrollButtons:{enable:true},
        theme:"3d-thick"
      });
      
      $("#content-8").mCustomScrollbar({
        axis:"yx",
        scrollButtons:{enable:true},
        theme:"3d",
        scrollbarPosition:"outside"
      });
      
      $("#content-9").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65
      });

      
      
    });
  })(jQuery);
</script>

<style>
	.container-xl, .container-lg, .container-md, .container-sm, .container {
		max-width: 100%;
	}
</style>


</body>

</html>
