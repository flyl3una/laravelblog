<html>
<head>
    <title>Laravel Blog</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <script src="/js/jquery-3.2.1.min.js"></script>

    @yield("css")
    <meta name="_token" content="{{ csrf_token() }}"/>
    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body>
@yield("header")
{{--@extends("layouts.content")--}}
<div class="container-fluid">
    <div class="row">
        @yield("sidebar")
        @yield("content")
        {{--@yield("footer")--}}
    </div>
</div>

{{--@extends("layouts.footer")--}}
<script src="/js/bootstrap.min.js"></script>
@yield("js")
</body>
</html>

