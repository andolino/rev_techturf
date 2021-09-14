<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/FontAwesome.css') }}">
{{-- 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">  --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css?no-cache='.rand()) }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/darkly/bootstrap.min.css"> --}}
    {{-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.flipster.min.css') }}">
    
    <script src="https://js.stripe.com/v3/"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body class="sb-nav-fixed">
<div>
    <main class="">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">
              <img src="{{ asset('images/icon-main.png') }}" alt="" width="23"> Heygo Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                    </ul>
                </li>
            </ul>
          </nav>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
          {{-- <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ ucwords(Auth::user()->name) }} 
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                    
            </a>
            
            </div>
          </li> --}}
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">Core</div>
                                <a class="nav-link" href="{{ url('/admins') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                                <div class="sb-sidenav-menu-heading">Interface</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Payments
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{ url('/admins/student-payments') }}">Students</a>
                                        <a class="nav-link" href="layout-sidenav-light.html">Teachers</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed d-none" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Pages
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse d-none" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                            Authentication
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="login.html">Login</a>
                                                <a class="nav-link" href="register.html">Register</a>
                                                <a class="nav-link" href="password.html">Forgot Password</a>
                                            </nav>
                                        </div>
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                            Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="401.html">401 Page</a>
                                                <a class="nav-link" href="404.html">404 Page</a>
                                                <a class="nav-link" href="500.html">500 Page</a>
                                            </nav>
                                        </div>
                                    </nav>
                                </div>
                                <div class="sb-sidenav-menu-heading ">Wallet</div>
                                <a class="nav-link " href="{{ url('/admins/heygo-wallet') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                                    Heygo Wallet
                                </a>
                                <a class="nav-link" href="{{ url('/admins/teacher-wallet') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                                    Teachers Wallet
                                </a>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            {{ ucfirst($data->name) }}
                        </div>
                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    @yield('content')
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Your Website 2021</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
    </main>
    <div id="app">

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('sb-admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-admin/js/datatables-simple-demo.js') }}"></script>
</body>
</html>