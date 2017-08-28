<html>
<head>
    <title>MBlog</title>
    @yield("css")
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body class="side-md">

@yield("header")

<main class="admin-content grey lighten-5">

    @yield("sidebar")
    @yield("content")

</main>
@yield("footer")
@yield("js")
</body>
</html>

