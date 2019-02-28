<?php
    $setting = \App\Models\Systems::query()->first();
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$setting->desc}}"/>
    <meta name="keywords" content="{{$setting->seo}}"/>
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
    <link href="https://cdn.bootcss.com/highlight.js/9.13.1/styles/monokai-sublime.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/element-ui/2.4.11/theme-chalk/index.css" rel="stylesheet">

</head>
<body>

<div id="app"></div>

<script src="https://cdn.bootcss.com/vue/2.5.7/vue.min.js"></script>{{-- 新加的 --}}
<script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
<script src="https://unpkg.com/element-ui@2.4.11/lib/index.js"></script>{{-- 新加的 --}}
<script src="https://cdn.bootcss.com/vue-router/3.0.2/vue-router.js"></script>{{-- 新加的 --}}
<script src="https://cdn.bootcss.com/highlight.js/9.13.1/highlight.min.js"></script>{{-- 新加的 --}}

<script src="{{mix('js/app.js')}}"></script>

<script src="{{asset('default/js/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('default/js/bootstrap.min.js')}}"></script>
</body>
</html>
