<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Outbuster">
    <meta name="keywords" content="Outbuster">
    <meta name="author" content="Outbuster">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Outbuster - account managemenet</title>
    <link href="{{ asset('assets/images/favicon-icon.png') }}" rel="shortcut icon" type="image/x-icon">
    <!-- Outbuster External CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet" type="text/css" media="all">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" media="all">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <style>
        body {
            background-color: #343230 !important;
            font-family: Roboto, sans-serif;
            font-weight: 400;
            margin-bottom: 150px;
            padding-top: 0;
        }

        .logo {
            padding-top: 10px;
            color: #09ef6b;
        }

        .hover {
            text-decoration: none !important;
        }

        .main-text {
            color: white;
            font-size: 12px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .custom-text {
            color: #119747;
            font-size: 12px;
            padding-top: 260px;
        }

        .panel {
            background-color: #1a1a1a !important;
            border-radius: 0px !important;
        }

        .panel-body {
            padding-top: 10px;
        }

        .fields {
            padding-bottom: 50px;
        }

        .plan {
            border: 1px solid #111111;
            margin-left: 5px;
            margin-right: 5px;
            border-radius: 4px;
            padding-bottom: 10px;
            margin-top: 10px;
        }

        .plan:hover {
            border: 1px solid #1CB94E;
        }

        .plan-heading {
            color: #FFFFFF;
            font-size: 12px;
            padding-top: 20px;
        }


        .panel-login {
            -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
        }

        .panel-login>.panel-heading {
            color: #00415d;
            background-color: #1a1a1a;
            text-align: center;
        }

        .panel-login>.panel-heading a {
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 12px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }

        .panel-login>.panel-heading a.active {
            /* padding-left: 40px;
            padding-right: 40px; */
            padding-bottom: 21px;
            border-bottom: 2px solid #109847;
            color: #109847;
            font-size: 15px;
        }

        .panel-login input[type="text"],
        .panel-login input[type="email"],
        .panel-login input[type="password"] {
            background-color: #0d0d0d;
            height: 45px;
            border: 1px solid #ddd;
            font-size: 12px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }

        .panel-login input:hover,
        .panel-login input:focus {
            outline: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            border-color: #ccc;
        }

        /* /////////////////////////////////////////////// */

        .dropdown {
            position: absolute;
            top: 48px;
            right: -20px;
            text-align: left;
            background: var(--dark-clr2);
            display: none;
            padding: 16px 25px;
            z-index: 111;
            width: 100%;
            min-width: 240px;
        }

        .dropdown li {
            padding-bottom: 15px;
            display: block;
        }

        .down-arrow .dropdown {
            left: 0;
            right: auto;
        }
    </style>

<body>

    <!-- Header -->
    <header>
        <div class="header-main">
            <div class="header-left-part">
                <a href="{{ route('home') }}" class="logo-wrap">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="main-logo">
                </a>
            </div>
            <ul class="header-right-part">
                @include('layouts.account-list')
            </ul>
        </div>
    </header>

    <p></p>
    <main>
        <div class="container">
            <div class="row justify-content-center" style="justify-content: center;">
                <div class="col-md-8">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="#" class="active hover" id="login-form-link">Upgrade</a>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12" style="color: white;text-align: center;">
                                    <h4> {{ $localPlan->amount }} EUR </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card bg-transparent">
                                        <input class="form-control" id="card-holder-name" type="text"
                                            placeholder="Card Holder Name">
                                        <!-- Stripe Elements Placeholder -->
                                        <div class="form-control my-5" id="card-element"></div>
                                        <div class="row justify-content-center" style="justify-content: center;">
                                            <div class="col-sm-6">
                                                <button class="form-control btn btn-login" id="card-button"
                                                    data-secret="{{ $intent->client_secret }}"
                                                    style="height: 60px">{{ $try_out_trial ? 'Try out trial' : 'Subscribe' }}</button>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="justify-content: center;">
                                            <div class="col-sm-6">
                                                <img src="{{ asset('assets/images/logo-stripe-secure-payments.png') }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
            <div class="card">
                <input id="card-holder-name" type="text" placeholder="Card Holder Name">

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>

                <button id="card-button" data-secret="{{ $intent->client_secret }}">Subscribe</button>
    </div>
</div> --}}
            </div>
        </div>

    </main>

    <style>
        .col-xs-6 {
            width: 50%;
        }

        @media only screen and (min-device-width : 375px) and (max-device-width : 667px) {
            .col-xs-6 {
                width: 49% !important;
            }
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    iconColor: '#000000',
                    color: '#000000',
                    fontWeight: 500,
                    fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                    fontSize: '16px',
                    fontSmoothing: 'antialiased',
                    backgroundColor: '#ffffff',
                    margin: '10px 0',
                    ':-webkit-autofill': {
                        color: '#fce883',
                    },
                    '::placeholder': {
                        color: '#000000',
                    },
                },
                invalid: {
                    iconColor: '#FFC7EE',
                    color: '#FFC7EE',
                },
            },
        });

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                alert(error)
                console.log('error :>> ', error);
            } else {
                var url = "{{ $try_out_trial ? '/subscribe/stripe/trial' : '/subscribe/stripe' }}"
                document.getElementById("card-button").disabled = true;
                axios.post(url, {
                        planID: '{{ $planId }}',
                        paymentMethod: setupIntent.payment_method
                    })
                    .then((response) => {
                        window.location.href = "{{ route('account.subscription') }}";
                    })
                    .catch(error => {
                        const newError = Object.assign({}, error);
                        alert(newError.response.data.errors)
                        console.log('error :>> ', newError.response.data.errors);
                        location.reload();
                    });

            }

        });
    </script>





    <!-- Outbuster Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>

</html>
