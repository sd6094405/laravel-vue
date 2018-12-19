<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel-Vue博客"/>
    <meta name="keywords" content="Laravel-Blog,laravel-blog,博客,hhb"/>
    <meta name="author" content="hhb"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('default/css/bootstrap.min.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('default/css/animate.css') }}">


    <link rel="stylesheet" href="{{ asset('default/css/index.css') }}">
</head>
<body>

<div id="app"></div>

<script src="{{mix('js/app.js')}}"></script>

<script src="{{asset('default/js/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('default/js/bootstrap.min.js')}}"></script>
</body>
</html>
