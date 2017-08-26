<html>
<head>
    <title>Laravel Blog</title>

    @yield("css")
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {{--<link href="/css/boostrap-theme.css" rel="stylesheet">--}}
</head>

<body class="side-md">
@yield("header")

{{--@extends("layouts.content")--}}
<main class="admin-content">

    @yield("sidebar")
    {{--<div class="container-fluid">--}}
    {{--<div class="row side-md">--}}

        {{--sss--}}
    {{--<main class="admin-right-content">--}}
        {{--<main id="admin_content" class="container-fluid">--}}

            @yield("content")
        {{--</main>--}}
    {{--</main>--}}
    {{--@yield("footer")--}}

    {{--</div>--}}
    {{--</div>--}}
</main>
@yield("footer")
{{--@extends("layouts.footer")--}}
@yield("js")
</body>
</html>

