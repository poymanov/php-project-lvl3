<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css', 'assets') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    @include('layouts._header')
    @include('flash::message')
    <main class="flex-grow-1">@yield('content')</main>
    @include('layouts._footer')
    <script src="{{ mix('js/app.js', 'assets') }}" defer></script>
</body>
</html>
