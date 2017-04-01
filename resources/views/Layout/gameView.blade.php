<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>娱乐之游戏人生</title>
    <link rel="stylesheet" href="{{ URL::asset('/')}}css/mui.min.css">
    <link rel="stylesheet" href="{{ URL::asset('/')}}css/font-awesome.min.css">
    <script src="{{ URL::asset('/') }}js/mui.min.js"></script>
</head>
<body>
{{--<button class="mui-btn mui-btn--raised mui-btn--primary"> 立即登录账号 </button>--}}
{{-- 设置顶部导航 --}}
<div class="mui-appbar mui--appbar-top">
    <dvi class="mui--text-title mui--text-center">{{ var_dump($configData) }}}</dvi>
</div>
@yield('content')
<div class="mui-appbar mui--appbar-min-height">
    <button class="mui-btn mui-btn--fab"><i class="fa fa-user-circle fa-lg"></i></button>
    <button class="mui-btn mui-btn--fab"><i class="fa fa-shopping-cart fa-lg"></i></button>
    <button class="mui-btn mui-btn--fab"><i class="fa fa-briefcase fa-lg"></i></button>
    <button class="mui-btn mui-btn--fab"><i class="fa fa-flash fa-lg"></i></button>
    <button class="mui-btn mui-btn--fab"><i class="fa fa-paper-plane fa-lg"></i></button>
</div>
</body>
</html>