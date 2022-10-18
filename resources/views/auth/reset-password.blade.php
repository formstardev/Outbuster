<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
</head>

<body>
    <div class="reset-password-pop popup">
        <h1 class="form-title">Reset Password</h1>

        <form name="myForm" class="form" action="{{ route('password.update') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <input type="password" class="form-control" required="" name="password" id=""
                placeholder="New Password">
            <input type="password" class="form-control" required="" name="password_confirmation" id=""
                placeholder="New Password Confirmation">
            <button type="submit" class="form-control btn" name="submit">Valider</button>
        </form>
    </div>
    <script src="{!! url('assets/js/jquery.min.js') !!}"></script>
    <script src="{!! url('assets/js/owl.carousel.min.js') !!}"></script>
    <script src="{!! url('assets/js/scripts.js') !!}"></script>
    <script>
        $(document).ready(function() {
            // e.stopPropagation();
            $('.reset-password-pop').addClass('show');
        })
    </script>
</body>

</html>
