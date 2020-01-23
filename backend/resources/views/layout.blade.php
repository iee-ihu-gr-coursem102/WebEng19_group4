<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Ninetynine Weather</title>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <header class="header">
            <div class="navigation">
                <div class="menu mobile-menu">
                    <div class="lines">
                        <span class="burger-line"></span>
                        <span class="burger-line"></span>
                        <span class="burger-line"></span>
                    </div>
                    <div class="menu-nav">
                        <ul class="menu-nav-items">
                            <li class="nav-item"><a href="{{ url('/home') }}">Αρχική</a></li>
                            <li class="nav-item"><a href="{{ url('/theme') }}">Θέμα</a></li>
                            <li class="nav-item"><a href="{{ url('/single') }}">Σήμερα</a></li>
                            <li class="nav-item"><a href="{{ url('/multiple') }}">Αναλυτική</a></li>
                        </ul>
                    </div>
                </div>
                <div class="logo">
                    <a href="/"><img src="{{ asset('assets/images/splash-icon.png') }}" alt="logo" /></a>
                </div>
            </div>
        </header>

            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
