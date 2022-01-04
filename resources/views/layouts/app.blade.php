<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- <!-- Styles --> Bootstrap v5 --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- <!-- Styles --> Bootstrap v4 --}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- Material Design for Bootstrap --}}
    <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    @include('includes.header')
    {{-- 
        https://getbootstrap.com/docs/4.0/utilities/spacing/

        py-4: padding top and bottom, size 4
    --}}
    <main class="py-4">
        <div class="container">

            @include('includes.message')
            
            @yield('content')
        </div>
    </main>

    {{-- https://stackoverflow.com/questions/10808109/script-tag-async-defer --}}
    <!-- Scripts -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- Bootstrap tooltips --}}
    <script defer src="{{ asset('js/popper.min.js') }}" ></script>
    {{-- Bootstrap Core JavaScript --}}
    <script defer src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- MDB Core JavaScript --}}
    <script defer src="{{ asset('js/mdb.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
