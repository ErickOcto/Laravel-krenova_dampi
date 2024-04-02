<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Dashboard - Dampi</title>

    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('template/assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.svg') }}" type="image/x-icon">
    @stack('add-styles')
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('template/assets/images/logo.svg') }}" alt="" srcset="">
                </div>
                @include('admin.layouts.sidebar')
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            @include('admin.layouts.header')

            @yield('content')

            @include('admin.layouts.footer')
        </div>
    </div>
    @stack('add-scripts')
    <script src="{{ asset('template/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/app.js') }}"></script>

    <script src="{{ asset('template/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('template/assets/js/main.js') }}"></script>
</body>

</html>
