<html>
<head>
    <title>Laravel Blog</title>
    @yield("css")

    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body>
{{--@extends("layouts.header")--}}
{{--@extends("layouts.content")--}}
@yield("header")
@yield("content")
@yield("footer")
{{--@extends("layouts.footer")--}}

@yield("js")

</body>
</html>

