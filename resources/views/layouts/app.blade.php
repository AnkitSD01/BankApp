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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .customcontainer {
            max-width: 700px;
            margin: 0 auto;
        }

        .nav-link.active {
            position: relative;
            font-weight: bold;
            border-color: white;
        }

        .nav-tabs .nav-link.active {
            border-color: #ffffff;
        }

        .nav-link.active::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: blue;
        }

        .app-anme {
            margin-top: 5px;
        }

        .top-nav {
            margin-top: -15px;
            margin-bottom: -15px;
        }

        .content-box {
            background-color: #ffffff;
            padding: 15px;

        }

        .main-body {
            background-color: #f6f6fb;
            margin-top: -15px;
            height: calc(100vh + 15px);
        }
        .gap{
            padding: 35px 0px;
        }
    </style>
</head>

<body>
    <div class="customcontainer">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h3 class="app-anme"> {{ config('app.name', 'Laravel') }}
                <h3>
        </a>
    </div>
    <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> -->

    <hr>
    <div class="customcontainer">
        <div class="top-nav">
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}{{ Request::is('home') ? ' active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('deposit') ? 'active' : '' }}" href="{{ route('action', ['action' => 'deposit']) }}">
                        <i class="fa fa-cloud-upload"></i> Deposit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('withdraw') ? 'active' : '' }}" href="{{ route('action', ['action' => 'withdraw']) }}">
                        <i class="fa fa-cloud-download"></i> Withdraw
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('transfer') ? 'active' : '' }}" href="{{ route('action', ['action' => 'transfer']) }}">
                        <i class="fas fa-exchange-alt"></i> Transfer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('statement') ? 'active' : '' }}" href="{{ route('action', ['action' => 'statement']) }}">
                        <i class="fas fa-file-alt"></i> Statement
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out"></i>{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <hr>
    <div class="main-body">

        <main class="customcontainer">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
            @endif
            <div class="gap">
            <div>
            @yield('content')
        </main>
    </div>
</body>

</html>