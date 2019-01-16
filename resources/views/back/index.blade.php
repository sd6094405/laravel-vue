<?php
    $setting = \App\Models\Systems::query()->first();
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$setting->desc}}"/>
    <meta name="keywords" content="{{$setting->seo}}"/>
    <meta name="author" content="hhb"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap  -->

    <link rel="stylesheet" href="http://at.alicdn.com/t/font_830376_qzecyukz0s.css">

</head>
<body>

<div id="app"></div>

<script src="{{mix('js/admin.js')}}"></script>

</body>
</html>
