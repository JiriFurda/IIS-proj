<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.partials.header')

        @include('layouts.partials.flash_messages')

        @yield('content')

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/datepicker-cs.js') }}"></script>
        @stack('scripts')
    </body>
</html>
