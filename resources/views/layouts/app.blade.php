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

    @include('partials.stylesheets')
    @yield('stylesheets')

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    @include('includes.header')
    {{-- https://getbootstrap.com/docs/4.0/utilities/spacing/

        py-4: padding top and bottom, size 4 --}}
    <main class="py-4">
        <div class="container">

            @include('includes.message')

            @yield('content')
        </div>
    </main>

    @include('partials.scripts')

    @stack('scripts')
</body>

</html>
