<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Outbuster') }}</title>
    <link href="{!! url('assets/images/favicon-icon.png') !!}" rel="shortcut icon" type="image/x-icon">
    <!-- Outbuster External CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet" type="text/css" media="all">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{!! url('assets/css/owl.carousel.css') !!}">
    <link rel="stylesheet" href="{!! url('assets/css/styles.css') !!}" type="text/css" media="all">

    <!-- Outbuster Scripts -->
    <script src="{!! url('assets/js/jquery.min.js') !!}"></script>
    <script src="{!! url('assets/js/owl.carousel.min.js') !!}"></script>
    <script src="{!! url('assets/js/scripts.js') !!}"></script>

</head>

<body class="profile">

    <!-- Header -->
    <header>
        <div class="header-main">
            <div class="header-left-part">
                <a href="{{ route('home') }}" class="logo-wrap">
                    <img src=" {!! url('assets/images/logo.png') !!}" alt="main-logo">
                </a>
            </div>
            <ul class="header-right-part">
                @include('layouts.account-list')
            </ul>
        </div>
    </header>


    <main>
        <!-- my account -->
        <section class="my-account">
            <div class="container">
                <h1 class="section-title">Mon compte</h1>
                <ul class="mobile-menu d-none">
                    <li><a href="#0">Mon abonnement</a></li>
                </ul>
                <ul class="option">
                    <li><a @if(isset($page_name) && $page_name == 'subscription') class="active" @endif href="{{ route('account.subscription') }}">Mon abonnement</a></li>
                    <li><a @if(isset($page_name) && $page_name == 'profile') class="active" @endif href="{{ route('account.profile') }}">Mon profil</a></li>
                    <li><a @if(isset($page_name) && $page_name == 'playlist') class="active" @endif href="{{ route('account.playlist') }}">Ma playlist</a></li>
                    <li><a @if(isset($page_name) && $page_name == 'payment') class="active" @endif href="{{ route('account.payment') }}">Mes paiements</a></li>
                </ul>

                @yield('content')
            </div>
        </section>

    </main>

    <script>
        var path = "{{ Request::segment(2) }}";
        // $(document).ready(function() {
        //     $("option").addClass("active");
        // });
    </script>
</body>

</html>
