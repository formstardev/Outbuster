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

<body style="overflow-y:scroll">
    @yield('body')

    <!-- outbusters Header -->
    <header>
        <div class="header-main">
            <div class="header-left-part">
                <a href="{{ route('home') }}" class="logo-wrap">
                    <img src=" {!! url('assets/images/logo.png') !!} " alt="main-logo">
                </a>
                <nav>
                    <ul class="navigation">
                        <li class="menu-item"><a href="{{ route('film.index') }}">Tous les films</a></li>
                        <li class="menu-item down-arrow"><a href="javascript:;">Nos catégories</a>
                            <ul class="dropdown">
                                @foreach (App\Models\MpArtworkCategory::get() as $item)
                                    <li><a
                                            href="{{ route('category.showfilm', $item->id) }}">{!! $item->category !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item down-arrow"><a href="javascript:;">Nos tags</a>
                            <ul class="dropdown">
                                @foreach (App\Models\MpArtworkTag::get() as $item)
                                    <li><a href="{{ route('tag.showfilm', $item->id) }}">{!! $item->tag !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item d-none"><a href="#0" class="btn"><img
                                    src="{{ asset('assets/images/btn-image.png') }}" alt="">ESSAI GRATUIT</a>
                        </li>
                        <li class="menu-item d-none"><a href="#0" class="search-btn"><img
                                    src="{{ asset('assets/images/search.png') }}" alt="">Recherche</a></li>
                        <li class="menu-item d-none"><a href="#0" class="btn user-login-btn">S’identifier</a></li>
                    </ul>
                    <button class="close-nav" type="button"><span class="navbar-toggler-icon"></span></button>
                </nav>
            </div>


            @auth
                {{ auth()->user()->username }}
                <ul class="header-right-part">
                    <li class="d-block"><a href="#0" class="btn"><img src="{!! url('assets/images/btn-image.png') !!}"
                                alt="">ESSAI
                            GRATUIT</a></li>
                    <li class="d-block"><a href="#0" class="search-btn"><img src="{!! url('assets/images/search.png') !!} "
                                alt="">Recherche</a></li>
                    {{-- <li class="d-block"><a href="#0" class="videos">Mes vidéos</a></li> --}}
                    <li><a href="#0" class="bell-btn"><img src="{!! url('assets/images/bell.png') !!}"
                                alt=""><span>9+</span></a>
                    </li>
                    @include('layouts.account-list')
                    <button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
                </ul>
            @endauth

            @guest
                <ul class="header-right-part">
                    <li class="d-block"><a href="#0" class="btn"><img
                                src="{{ asset('assets/images/btn-image.png') }}" alt="">ESSAI
                            GRATUIT</a></li>
                    <li class="search d-block"><a href="#0" class="search-btn"><img
                                src="{{ asset('assets/images/search.png') }}" alt="">Recherche</a></li>
                    <li class="search d-block"><a href="#0" class="btn user-login-btn">S’identifier</a></li>
                    <button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
                </ul>
            @endguest
        </div>
    </header>

    <input type="hidden" @if (Auth::check()) value="1" @else value="0" @endif id="is_logged_in">
    @yield('content')

    <!-- search popup -->
    <div class="search-pop popup">
        <h1 class="form-title">Recherche</h1>
        <form  method="get" name="searchForm" id="search" class="form" action="{{ route('search') }}">
            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
            <button type="submit" class="form-control btn"><img
                    src="{{ asset('assets/images/search.png') }}" alt=""></button>
        </form>
    </div>

    <!-- login popup-->
    <div class="login-pop popup">
        <h1 class="form-title">S’identifier</h1>
        <div id="errors-list"></div>
        <form method="post" name="myForm" id="login" class="form" action="{{ route('login.perform') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="text" class="form-control" required="" name="email" id="email"
                placeholder="Email">
            <input type="password" class="form-control" required="" name="password" id="password"
                placeholder="Mot de passe">
            <a href="#0" class="forgot-password forgotten-password-btn">Mot de passe oublié ?</a>
            <button type="submit" class="form-control btn" name="submit">S’identifier</button>
            <div class="form-group">
                <div class="checkbox-div">
                    <input class="custom-checkbox" id="identity" type="checkbox" name="remember" value="1">
                    <label class="checkbox-lebel" for="identity">Se souvenir de moi</label>
                </div>
                <a href="#0" class="help">besoin d'aide ?</a>
            </div>
        </form>
        <p>Première visite sur OUTBUSTER ?<br> Nous vous invitons à vous inscrire</p>
        <a href="#0" class="btn inscription-btn">S’inscrire</a>
    </div>


    <!-- sign-up popup-->
    <div class="signup-pop popup">
        <h1 class="form-title">Inscription OUTBUSTER</h1>
        <div id="register-errors-list"></div>
        <form name="myForm" method="post" id="register" class="form"
            action="{{ route('register.perform') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
                <div class="col-6">
                    <input type="text" class="form-control" required="" name="firstname" id="rfirstname"
                        placeholder="Prénom" autocomplete="off">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" required="" name="lastname" id="rlastname"
                        placeholder="Nom de famille" autocomplete="off">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" required="" name="email" id="remail"
                        placeholder="email">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" required="" name="email_confirmation"
                        id="remail_confirmation" placeholder="Confirmation - Email">
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" required="" name="password" id="rpassword"
                        placeholder="Mot de passe">
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" name="password_confirmation"
                        id="rpassword_confirmation" placeholder="Confirmation - Mot de passe">
                </div>
            </div>
            <p>Cette page est protégée par Google reCAPTCHA <br>pour nous assurer que vous n'êtes pas un robot. </p>
            <button type="submit" class="form-control btn" name="submit">S’identifier</button>
        </form>
    </div>
    <div class="alert-pop popup">
        <h1 class="form-title">OUTBUSTER</h1>
        <div id="alert-message"></div>
        {{-- <button class="form-control btn" id="alert-message-button">Proche</button> --}}
    </div>

    <!-- forgotten password popup-->
    <div class="forgotten-password-pop popup">
        <h1 class="form-title">Mot de passe oublié ?</h1>
        <p class="forgotten-password-text">
            Veuillez saisir votre adresse email personnelle
            dans le formulaire ci-dessous, un lien va être
            envoyé afin de réinitialiser votre mot de passe.
        </p>
        <div id="forgot-errors-list"></div>
        <form name="myForm" id="forgot-password" class="form" action="{{ route('forget') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="text" class="form-control" required="" name="email" id="forgot-email"
                placeholder="Email">
            <button type="submit" class="form-control btn" name="submit">Valider</button>
        </form>
    </div>
    <script>
        $(function() {
            // handle submit event of form
            $(document).on("submit", "#login", function() {
                var e = this;
                // change login button text before ajax
                $(this).find("[type='submit']").html("LOGIN...");

                $.post($(this).attr('action'), $(this).serialize(), function(data) {

                    // $(e).find("[type='submit']").html("LOGIN");
                    if (data.status) { // If success then redirect to login url
                        window.location = data.redirect_location;
                    }
                }).fail(function(response) {
                    // handle error and show in html
                    $(e).find("[type='submit']").html("LOGIN");
                    $(".alert").remove();
                    var erroJson = JSON.parse(response.responseText);
                    for (var err in erroJson) {
                        if (err == "email") {
                            $("#email").addClass("border-red");
                        } else if (err == "password") {
                            $("#password").addClass("border-red");
                        } else {
                            $("#email").addClass("border-red");
                            $("#password").addClass("border-red");
                        }
                        var alert = '';
                        for (var errstr of erroJson[err]) alert += errstr;
                        $("#errors-list").append("<div class='alert alert-danger'>" + alert +
                            "</div>");
                    }

                });
                return false;
            });

            $(document).on("submit", "#register", function() {
                var e = this;
                // change register button text before ajax
                $(this).find("[type='submit']").html("Register...");

                $.post($(this).attr('action'), $(this).serialize(), function(data) {

                    // $(e).find("[type='submit']").html("REGISTER");
                    if (data.status) { // If success then redirect to login url
                        //window.location = data.redirect_location;
                        var msg = data.msg;

                        $("#alert-message").append("<p>" + msg +
                            "</p>");

                        // e.stopPropagation();
                        $('.signup-pop').removeClass('show');
                        $('.alert-pop').addClass('show');
                        $('header').removeClass('open-navigation');
                    }
                }).fail(function(response) {
                    // handle error and show in html
                    $(e).find("[type='submit']").html("REGISTER");
                    $(".alert").remove();
                    console.log(response.responseText)
                    var erroJson = JSON.parse(response.responseText);
                    console.log(erroJson)
                    for (var err in erroJson) {
                        // alert(err);
                        if (err == "email") {
                            $("#remail").addClass("border-red");
                        } else if (err == "password") {
                            $("#rpassword").addClass("border-red");
                        } else if (err == "password_confirmation") {
                            $("#rpassword_confirmation").addClass("border-red");
                        } else if (err == "firstname") {
                            $("#rfirstname").addClass("border-red");
                        } else if (err == "lastname") {
                            $("#rlastname").addClass("border-red");
                        } else {
                            $("#remail").addClass("border-red");
                            $("#remail_confirmation").addClass("border-red");
                            $("#rpassword").addClass("border-red");
                            $("#rfirstname").addClass("border-red");
                            $("#rlastname").addClass("border-red");
                            $("#rpassword_confirmation").addClass("border-red");
                        }
                        var alert = '';
                        for (var errstr of erroJson[err]) alert += errstr;
                        $("#register-errors-list").append("<div class='alert alert-danger'>" +
                            alert +
                            "</div>");
                    }

                });
                return false;
            });

            $(document).on("submit", "#forgot-password", function() {
                var e = this;
                // change login button text before ajax
                $(this).find("[type='submit']").html("Sending...");

                $.post($(this).attr('action'), $(this).serialize(), function(data) {

                    $(e).find("[type='submit']").html("Valider");
                    if (data.status) { // If success then redirect to login url
                        var msg = data.message;

                        $("#alert-message").append("<p>" + msg +
                            "</p>");

                        // e.stopPropagation();
                        $('.forgotten-password-pop').removeClass('show');
                        $('.alert-pop').addClass('show');
                        $('header').removeClass('open-navigation');

                    }
                }).fail(function(response) {
                    // handle error and show in html
                    $(e).find("[type='submit']").html("Valider");
                    $(".alert").remove();
                    var str = JSON.parse(response.responseText);

                    if (response.code != "200") {
                        $("#forgot-email").addClass("border-red");
                    }
                    $("#forgot-errors-list").html("<div class='alert alert-danger'>" + str +
                        "</div>");

                });
                return false;
            });
            $("#email").on("change", function() {
                $(this).removeClass("border-red");
            })
            $("#password").on("change", function() {
                $(this).removeClass("border-red");
            })
            $("#alert-message-button").click(function() {
                $('.alert-pop').removeClass('show');
            });
            $("#information-btn").click(function(e) {
                e.stopPropagation();
                $('.category-maximize').addClass('show');
                $('.category-maximize').css("z-index", "1111111");
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');
            $('.heart-img').click(function() {
                if ($("#is_logged_in").val() == 0) return;
                let film_id = $(this).data("id");
                let src = $(this).attr('src');
                let active = 0;
                if (src == "{{ asset('assets/images/heart-icon.png') }}") {
                    $(this).attr('src', "{{ asset('assets/images/heart-fill-icon.png') }}");
                    active = 1;
                } else {
                    $(this).attr('src', "{{ asset('assets/images/heart-icon.png') }}");
                    active = 0;
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: "{{ route('account.set_favorite') }}",
                    data: {
                        'film_id': film_id,
                        'active': active,
                    },
                    success: function(response) {}
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            //Owl Carousel Script
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1.2,
                        nav: true,
                        loop: false
                    },
                    400: {
                        items: 2,
                        nav: false,
                        loop: false
                    },
                    650: {
                        items: 3,
                        nav: false,
                        loop: false
                    },
                    900: {
                        items: 4,
                        nav: true,
                        loop: false,
                        margin: 20
                    },
                    1600: {
                        items: 5,
                        nav: true,
                        loop: false,
                        margin: 20
                    }
                }
            });
        });
    </script>

    <style>
        .alert {
            margin-bottom: 10px;
            color: red;
        }

        .border-red {
            border: 1px solid red !important;
        }
    </style>
</body>

</html>
