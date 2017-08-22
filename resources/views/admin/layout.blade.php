<html>
<head>
    <title>Laravel Blog</title>

    @yield("css")
    <meta name="_token" content="{{ csrf_token() }}"/>
    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body>
@yield("header")
{{--@extends("layouts.content")--}}
<div id="content" class="admin-content side-sm">
    {{--<div class="container-fluid">--}}
        {{--<div class="row side-md">--}}
            @yield("sidebar")
            @yield("content")
            {{--@yield("footer")--}}
        {{--</div>--}}
    {{--</div>--}}
</div>

{{--@extends("layouts.footer")--}}

@yield("js")
</body>
</html>

