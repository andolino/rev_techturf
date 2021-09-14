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
        @yield('content')
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