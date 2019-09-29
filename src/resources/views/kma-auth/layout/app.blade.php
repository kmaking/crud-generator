<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font -->
    {!! style('https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700', true) !!}
    {!! style('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700', true) !!}
    
    <!-- Styles -->
    {!! style('vendors/styles/style.css') !!}
    @stack('style')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

</head>
<body>

    {{-- Header include --}}
    @include('admin.partials.header')

    {{-- Sidebar include --}}
    @include('admin.partials.sidebar')

    {{-- Main Containt --}}
    <div class="main-container">
        <div class="px-4 customscroll customscroll-10-p height-100-p xs-pd-20-10">

            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        {{-- <div class="title">
                            <h4>@yield('title')</h4>
                        </div> --}}
                        @yield('breadcrumbs')
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    {!! script('vendors/scripts/script.js') !!}
    {!! script('js/vindicate.js') !!}
    @stack('script')
</body>
</html>
