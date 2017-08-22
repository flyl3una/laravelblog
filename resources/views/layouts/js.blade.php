@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/material.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/ripples.js"></script>
    <script>

    </script>


<script>

    $(document).ready(function() {
//初始化material
        $.material.init();

        $("#side-toggle").click(function () {
            $("#content").toggleClass("side-sm");
            $("#content").toggleClass("side-md");
        });

        $("ul.side-menu>li>a").click(function () {
            $(this).parent().toggleClass('active');
            $(this).next().slideToggle("normal");
        });
    });
</script>
@endsection