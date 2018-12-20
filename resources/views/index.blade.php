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

<footer id="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p style="margin-top:15px;">
                    <a href="http://moell.cn" target="_blank"><strong>Powered by 咸鱼王</strong></a>
                    &nbsp;&nbsp;
                    <a href="https://github.com/moell-peng/moell-blog" target="_blank">
                        <span class="icon-github" style="padding-right:20px;"></span>
                    </a>
                </p>
                <p>蜀ICP备18033382号</p>
            </div>
        </div>
    </div>
</footer>
<script src="{{mix('js/app.js')}}"></script>

<script src="{{asset('default/js/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('default/js/bootstrap.min.js')}}"></script>
</body>
</html>
