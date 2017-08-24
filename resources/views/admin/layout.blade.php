<html>
<head>
    <title>Laravel Blog</title>

    @yield("css")
    <meta name="_token" content="{{ csrf_token() }}"/>
    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body class="side-md">
@yield("header")
@yield("sidebar")
{{--@extends("layouts.content")--}}
<div id="content" class="admin-content">
    {{--<div class="container-fluid">--}}
    {{--<div class="row side-md">--}}

    @yield("content")
    {{--@yield("footer")--}}
    @yield("footer")
    {{--</div>--}}
    {{--</div>--}}
</div>

{{--@extends("layouts.footer")--}}

@yield("js")
</body>
</html>

