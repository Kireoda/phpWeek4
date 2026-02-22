<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blog.*') || request()->routeIs('posts.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link" href="{{ route('about') }}">About</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
</li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white mt-auto">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="fw-bold mb-3">{{ config('app.name', 'Laravel Blog') }}</h5>
                        <p class="text-muted">A modern blogging platform built with Laravel. Share your coding journey, tutorials, and experiences with the developer community.</p>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="{{ route('blog.index') }}" class="text-muted text-decoration-none">Blog</a></li>
                            @auth
                                <li class="mb-2"><a href="{{ route('posts.create') }}" class="text-muted text-decoration-none">Write Post</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">Resources</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="https://laravel.com/docs" target="_blank" class="text-muted text-decoration-none">Documentation</a></li>
                            <li class="mb-2"><a href="https://github.com" target="_blank" class="text-muted text-decoration-none">GitHub</a></li>
                            <li class="mb-2"><a href="https://laracasts.com" target="_blank" class="text-muted text-decoration-none">Laracasts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3">Connect</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-muted"><i class="bi bi-twitter fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-github fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-linkedin fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-envelope fs-4"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="my-4 border-secondary">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="text-muted mb-0">Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
