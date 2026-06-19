<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — E-Vinoteka</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar { width:240px; min-height:100vh; background:#5c0a1e !important; flex-shrink: 0; }
        .sidebar .nav-link { color:#e9c3cc; border-radius:.4rem; }
        .sidebar .nav-link:hover { background:rgba(255,255,255,.08); color:#fff; }
        .sidebar .nav-link.active { background:#fff; color:#5c0a1e; font-weight:600; }
        .sidebar .brand { color:#fff; }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">

    {{-- SIDEBAR (responsive: offcanvas ispod md, fiksni od md naviše) --}}
    <div class="offcanvas-md offcanvas-start sidebar text-white p-3" tabindex="-1" id="sidebar">
        <div class="offcanvas-header px-0">
            <a href="{{ route('admin.dashboard') }}" class="brand navbar-brand d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" height="32"
                     onerror="this.style.display='none'">
                <span class="fw-bold">E-Vinoteka</span>
            </a>
            <button type="button" class="btn-close btn-close-white d-md-none"
                    data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
        </div>

        <ul class="nav nav-pills flex-column gap-1 mt-3">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.wines.index') }}"
                   class="nav-link {{ request()->routeIs('admin.wines.*') ? 'active' : '' }}">
                    <i class="bi bi-cup-straw me-2"></i> Vina
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                   class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i> Kategorije
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.wineries.index') }}"
                   class="nav-link {{ request()->routeIs('admin.wineries.*') ? 'active' : '' }}">
                    <i class="bi bi-building me-2"></i> Vinarije
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check me-2"></i> Porudžbine
                </a>
            </li>
        </ul>
    </div>

    {{-- GLAVNI DEO --}}
    <div class="flex-grow-1">
        {{-- Topbar --}}
        <nav class="navbar bg-white border-bottom px-4 py-2">
            <button class="btn btn-outline-secondary d-md-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="ms-auto dropdown">
                <a href="#" class="dropdown-toggle text-decoration-none text-dark" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/') }}">Javni sajt</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Odjava</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Sadržaj stranice --}}
        <main class="p-4">
            {{-- Flash poruke za uspeh/grešku --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif  
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>