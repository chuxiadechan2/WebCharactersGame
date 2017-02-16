<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $configData['web_title'] }}</title>
    <link rel="stylesheet" href="{{ URL::asset('/')}}css/mui.min.css">
    <link rel="stylesheet" href="{{ URL::asset('/')}}css/font-awesome.min.css">
    <script src="{{ URL::asset('/') }}js/mui.min.js"></script>
</head>
<body>
{{--<button class="mui-btn mui-btn--raised mui-btn--primary"> 立即登录账号 </button>--}}
{{-- 设置顶部导航 --}}
<div class="mui-appbar mui--appbar-top">
    <dvi class="mui--text-title mui--text-center">{{ $configData['web_title'] }}</dvi>
</div>
@yield('content')
