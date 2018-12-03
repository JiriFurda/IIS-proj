<?php
    function myAsset($path)
    {
        if(env('APP_ENV') == 'production')
            return '../public/'.$path;
        else
            return asset($path);
    }
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IS lékárny</title>

    <!-- Styles -->
    <link href="{{ myAsset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ myAsset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{ myAsset('css/common.css') }}" rel="stylesheet">
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

            <!-- Scripts -->
            <script src="{{ myAsset('js/jquery-3.3.1.min.js') }}"></script>
            <script src="{{ myAsset('js/jquery-ui.min.js') }}"></script>
            <script src="{{ myAsset('js/datepicker-cs.js') }}"></script>
            <script src="{{ myAsset('js/bootstrap.bundle.min.js') }}"></script>
            @stack('scripts')
        </body>
</html>
