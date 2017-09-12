<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>MBlog</title>
    @yield("css")
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

@yield("header")
<iframe name="target_iframe" hidden frameborder="0"></iframe>
<main class="grey lighten-5">

    @yield("content")

</main>
@yield("footer")
@yield("js")
</body>
</html>

