<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font -->
    {!! style('https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700', true) !!}
    {!! style('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700', true) !!}

    <!-- Styles -->
    {!! style('vendors/styles/style.css') !!}

</head>
<body>
    <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
        <div class="login-box bg-white box-shadow pd-30 border-radius-5">

            @yield('content')

        </div>
    </div>

    {!! script('vendors/scripts/script.js') !!}
</body>
</html>
