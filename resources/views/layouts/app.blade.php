<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://unpkg.com/@alenaksu/json-viewer@2.0.0/dist/json-viewer.bundle.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/sass/dash_ui/theme.scss', 'resources/js/app.js'])

    <link href="{{asset('assets/fa/css/all.min.css')}}" type="text/css" rel="stylesheet" />

    @livewireStyles
</head>
<body class="bg-light">
<div id="app">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
    <!-- page content -->
        <div id="page-content">
        @include('layouts.partials.header')
        <!-- Container fluid -->
            @yield('content')
        </div>
    </div>

</div>
@livewireScripts
</body>
</html>
