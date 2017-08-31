<html>
<head>
    <title>MBlog</title>
    @yield("css")
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body class="side-md">

@yield("header")

<main class="admin-content grey lighten-5">
    <iframe name="target_iframe" hidden frameborder="0"></iframe>
    @yield("sidebar")
    @yield("content")

</main>
@yield("footer")
@yield("js")
</body>
</html>

