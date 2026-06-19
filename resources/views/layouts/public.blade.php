<!DOCTYPE html>
<html lang="sr">

<head>
    <title>@yield('title', 'E-Vinoteka')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('zayshop-assets/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('zayshop-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('zayshop-assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('zayshop-assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('zayshop-assets/css/fontawesome.min.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@evinoteka.rs">info@evinoteka.rs</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:011-123-4567">011-123-4567</a>
                </div>
                <div>
                    <a class="text-light" href="#" target="_blank"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="#" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="{{ route('home') }}">
                E-Vinoteka
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Početna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Vinska karta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontakt</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    @auth
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('profile.edit') }}">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-success ms-2">Odjava</button>
                        </form>
                    @else
                        <a class="btn btn-sm btn-outline-success ms-2" href="{{ route('login') }}">Prijava</a>
                        <a class="btn btn-sm btn-success ms-2" href="{{ route('register') }}">Registracija</a>
                    @endauth
                </div>
            </div>

        </div>
    </nav>

    {{-- Flash poruke --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>

    {{-- SADRŽAJ STRANICE --}}
    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">E-Vinoteka</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><i class="fas fa-map-marker-alt fa-fw"></i> Knez Mihailova 1, Beograd</li>
                        <li><i class="fa fa-phone fa-fw"></i> <a class="text-decoration-none" href="tel:011-123-4567">011-123-4567</a></li>
                        <li><i class="fa fa-envelope fa-fw"></i> <a class="text-decoration-none" href="mailto:info@evinoteka.rs">info@evinoteka.rs</a></li>
                    </ul>
                </div>
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Navigacija</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="{{ route('home') }}">Početna</a></li>
                        <li><a class="text-decoration-none" href="{{ route('catalog') }}">Vinska karta</a></li>
                        <li><a class="text-decoration-none" href="{{ route('contact') }}">Kontakt</a></li>
                    </ul>
                </div>
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">O nama</h2>
                    <p class="text-light">Vaša online vinoteka — pažljivo birana vina iz najboljih domaćih i svetskih vinarija.</p>
                </div>
            </div>

            <div class="w-100 bg-black py-3 mt-4">
                <div class="container">
                    <div class="row pt-2">
                        <div class="col-12">
                            <p class="text-left text-light mb-0">
                                Copyright &copy; {{ date('Y') }} E-Vinoteka
                                | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('zayshop-assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('zayshop-assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('zayshop-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('zayshop-assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('zayshop-assets/js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>