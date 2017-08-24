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
<div class="admin-content">
    {{--<div class="container-fluid">--}}
    {{--<div class="row side-md">--}}
    <div id="admin_content" class="container-fluid">
        @yield("content")
    </div>

    {{--@yield("footer")--}}
    @yield("footer")
    {{--</div>--}}
    {{--</div>--}}
</div>

{{--@extends("layouts.footer")--}}

@yield("js")
</body>
</html>

