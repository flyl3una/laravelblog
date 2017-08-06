<html>
<head>
    <title>Laravel Blog</title>
    @yield("css")

    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body>
{{--@extends("layouts.header")--}}
{{--@extends("layouts.content")--}}
<div class="container-fluid">
    <div class="row">
        @yield("sidebar")
        @yield("content")
        {{--@yield("footer")--}}
    </div>
</div>

{{--@extends("layouts.footer")--}}

@yield("js")

</body>
</html>

