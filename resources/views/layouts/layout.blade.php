<html>
<head>
    <title>MBlog</title>
    @yield("css")
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

@yield("header")
<iframe name="target_iframe" hidden frameborder="0"></iframe>
<main class="">

    @yield("content")

</main>
@yield("footer")
@yield("js")
</body>
</html>

