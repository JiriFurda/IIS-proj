<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">



    <!--<style type="text/css">
        ul.my-ul {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            list-style: none;
            padding: 0;
            white-space: nowrap;
        }

        ul.my-ul > li {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }

    </style>-->


</head>
<body>
    @include('layouts.partials.header')

    @include('layouts.partials.flash_messages')

    @yield('content')
</body>
</html>
