<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Paws Hunter') }}</title>


    <link rel="apple-touch-icon" sizes="76x76" href="{{asset("./assets/img/paws-hunger-logo.png")}}">
    <link rel="icon" type="image/png" href="{{asset("./assets/img/paws-hunger-logo.png")}}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href={{asset("./assets/css/nucleo-icons.css")}} rel="stylesheet" />
    <link href={{asset("./assets/css/nucleo-svg.css")}} rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href={{asset("./assets/css/nucleo-svg.css")}} rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('page-styles')
    <style>
        label {
            font-size: 1rem;
        }
    </style>
</head>
<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>

@include('layouts.partials._aside')

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.partials._navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @include('layouts.partials._message')
        @yield('page-content')
    </div>
    @include('layouts.partials._footer')
</main>

<!--   Core JS Files   -->
<script src="{{asset("./assets/js/core/popper.min.js")}}"></script>
<script src="{{asset("./assets/js/core/bootstrap.min.js")}}"></script>
<script src="{{asset("./assets/js/plugins/perfect-scrollbar.min.js")}}"></script>
<script src="{{asset("./assets/js/plugins/smooth-scrollbar.min.js")}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset("./assets/js/argon-dashboard.min.js?v=2.0.4")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('page-scripts')

</body>
</html>
