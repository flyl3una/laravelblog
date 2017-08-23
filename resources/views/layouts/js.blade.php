@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/material.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/ripples.js"></script>
    <script>

    </script>


<script>

    function initAdmin() {
        $("#side-toggle").click(function () {
            if($(".side-left").width() == 70){
//                $(".side-item-name").attr("visiblity", "hidden");
//                $(".side-item-name").attr("opacity", "1");
                $(".side-left").animate({width: '230px'}, "fast");
            }
            else if($(".side-left").width() == 230){
                $(".side-left").animate({width: '70px'}, "fast");
//                $(".side-item-name").hidden();
            }
//            $(".side-item-name").opacity(0);
            $("#content").toggleClass("side-sm");
            $("#content").toggleClass("side-md");
        });

        $(".side-md>.side-left>.side-menu>li").click(function () {
//            $(this).parent().toggleClass('active');
//            $(this).next().slideToggle("normal");
            $(this).toggleClass('active');
            $(this).children(".side-treeview").slideToggle("normal");
        });

        $(".side-left").height($(".admin-content").height());
    }


    $(document).ready(function() {
//初始化material
        $.material.init();
        initAdmin();

    });
</script>
@endsection