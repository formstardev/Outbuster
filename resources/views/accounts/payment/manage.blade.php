<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Outbuster">
    <meta name="keywords" content="Outbuster">
    <meta name="author" content="Outbuster">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Outbuster - account managemenet</title>
    <link href="{{ asset('assets/images/favicon-icon.png')}}" rel="shortcut icon" type="image/x-icon">
    <!-- Outbuster External CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet" type="text/css" media="all">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css')}}" rel="stylesheet" type="text/css" media="all">

<body class="profile">

    <!-- Header -->
    <header>
        <div class="header-main">
            <div class="header-left-part">
                <a href="{{ route('home') }}" class="logo-wrap">
                    <img src="{{ asset('assets/images/logo.png')}}" alt="main-logo">
                </a>
            </div>
            <ul class="header-right-part">
                @include('layouts.account-list')
            </ul>
        </div>
    </header>


    <main>
        <!-- my account -->
        <section class="my-account payment-management">
            <div class="container">
                <h1 class="section-title">Gérer mes informations de paiement</h1>
                <div class="management-note">
                    <img src="{{ asset('assets/images/wallet.png')}}" alt="wallet">
                    <p>Modifiez vos informations de paiement, changez votre mode de paiement préféré,<br>ou ajoutez un
                        mode de paiement secondaire.</p>
                </div>
                <div class="content">
                    <div class="selected payment-option">
                        <h2 class="title">Informations de paiements</h2>
                        <div class="detail">
                            <p>Votre type de paiement actuel : <span class="card"><strong><img src="{{ asset('assets/images/visa.png')}}">
                                        .... .... .... 0247</strong> <input type="text" placeholder="Par défaut"
                                        class="form-element"><a href="#0" class="modify">Modifier</a><span
                                        class="dash">-</span><a href="#0" class="delete">supprimer</a></p>
                        </div>
                    </div>
                    <div class="payment-options">
                        <h5 class="payment-text">Types de paiement acceptés</h5>
                        <div class="pay-option-images">
                            <a href="#0"><img src="{{ asset('assets/images/pay1.png')}}" alt="payment"></a>
                            <a href="#0"><img src="{{ asset('assets/images/pay2.png')}}" alt="payment"></a>
                            <a href="#0"><img src="{{ asset('assets/images/pay3.png')}}" alt="payment"></a>
                            <a href="#0"><img src="{{ asset('assets/images/pay4.png')}}" alt="payment"></a>
                            <a href="#0"><img src="{{ asset('assets/images/pay5.png')}}" alt="payment"></a>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a href="#0" class="btn">AJOUTER UN MODE DE PAIEMENT</a>
                    <a href="{{ route('account.subscription') }}" class="btn non-bg">
                        < Revenir sur mon compte</a>
                </div>
            </div>
        </section>

    </main>

    <div class="popup payment-pop">
        <div class="management-note">
            <img src="{{ asset('assets/images/wallet-red.png')}}" alt="wallet">
            <p>Vous êtes sur le point de supprimer ce mode de paiement</p>
        </div>
        <p><strong><img src="{{ asset('assets/images/visa.png')}}"> .... .... .... 0247</strong></p>
        <div class="btn-wrap">
            <a href="#0" class="btn">SUPPRIMER CE MODE DE PAIEMENT</a>
            <a href="#0" class="btn btn-gray">
                < Revenir sur mon compte</a>
        </div>
    </div>




    <!-- Outbuster Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.js')}}"></script>
</body>

</html>
