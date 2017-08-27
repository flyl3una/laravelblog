<html>
<head>
    <title>MBlog</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <script src="/js/jquery-3.2.1.min.js"></script>


    @yield("css")

</head>

<body>

@yield("header")
@yield("content")
@yield("footer")

<script src="/js/bootstrap.min.js"></script>
@yield("js")

</body>
</html>

