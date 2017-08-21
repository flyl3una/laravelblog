<html>
<head>
    <title>Laravel Blog</title>
    <link href="/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="/vendors/bootstrap-material-design/dist/css/bootstrap-material-design.css" rel="stylesheet">
    <link href="/vendors/bootstrap-material-design/dist/css/ripples.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendors/font-awesome/css/font-awesome.min.css">

    {{--<link rel="stylesheet" href="/css/blog.css">--}}
    <link rel="stylesheet" href="/css/my.css">
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
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendors/bootstrap-material/dist/material.js"></script>
<script src="/vendors/bootstrap-material/dist/ripples.js"></script>
<script>
    $.material.init();
</script>
@yield("js")
</body>
</html>

