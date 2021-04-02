
		@extends('layouts.app')
		@section('content')
		<body class="bg-default">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
                
        <div class="main-content">
            <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <a class="navbar-brand" href="https://argon-dashboard-laravel.creative-tim.com/home">
            <img src="https://argon-dashboard-laravel.creative-tim.com/argon/img/brand/white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="https://argon-dashboard-laravel.creative-tim.com/home">
                            <img src="https://argon-dashboard-laravel.creative-tim.com/argon/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://argon-dashboard-laravel.creative-tim.com/home">
                        <i class="ni ni-planet"></i>
                        <span class="nav-link-inner--text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://argon-dashboard-laravel.creative-tim.com/register">
                        <i class="ni ni-circle-08"></i>
                        <span class="nav-link-inner--text">Register</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://argon-dashboard-laravel.creative-tim.com/login">
                        <i class="ni ni-key-25"></i>
                        <span class="nav-link-inner--text">Login</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>                
<div class="header bg-gradient-primary py-7 py-lg-8">
	<div class="container">
		<div class="header-body text-center mb-7">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-6">
					<h1 class="text-white">Welcome to Argon Dashboard FREE Laravel Live Preview.</h1>
					<h3 class="text-white">Log in and see how you can go from prototyping to a fully-functional web app x10 times faster. </h3>
				</div>
			</div>
		</div>
	</div>
	<div class="separator separator-bottom separator-skew zindex-100">
		<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
		</svg>
	</div>
</div>    
<div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="https://argon-dashboard-laravel.creative-tim.com/argon/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">Github</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="https://argon-dashboard-laravel.creative-tim.com/argon/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>
                                    Create new account OR Sign in with these credentials:
                                    <br>
                                    Username <strong><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c4a5a0a9adaa84a5b6a3abaaeaa7aba9">[email&#160;protected]</a></strong> Password: <strong>secret</strong>
                            </small>
                        </div>
                        <form role="form" method="POST" action="https://argon-dashboard-laravel.creative-tim.com/login">
                            <input type="hidden" name="_token" value="7CN8kVEQw2Rahdw6GGvBk9jUInIopXhAeqKq9F85">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email" value="admin@argon.com" required autofocus>
                                </div>
                                                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" type="password" value="secret" required>
                                </div>
                                                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" >
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">Remember me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                                                    <a href="https://argon-dashboard-laravel.creative-tim.com/password/reset" class="text-light">
                                <small>Forgot password?</small>
                            </a>
                                            </div>
                    <div class="col-6 text-right">
                        <a href="https://argon-dashboard-laravel.creative-tim.com/register" class="text-light">
                            <small>Create new account</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

@endsection
