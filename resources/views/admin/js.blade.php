@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    {{--<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>--}}
    {{--<script src="/vendors/bootstrap-material-design/dist/js/material.js"></script>--}}
    {{--<script src="/vendors/bootstrap-material-design/dist/js/ripples.js"></script>--}}
    <script src="/vendors/materialize/dist/js/materialize.min.js"></script>



    <script>
        toggleSideTreeView = function (click) {
            click.parent().toggleClass('active');
            click.next().slideToggle("fast");
//        click.toggleClass('active');
//        click.children(".side-treeview").slideToggle("fast");
        };

        sideGetView = function (click) {
            var data_url = click.attr('data-url');
            if (data_url) {
                console.log(data_url);
                var html_data = $.get(data_url, function (html_data, status) {
                    $("#admin_content").html(html_data);
                });
            }
        };

        initCurrentSide = function (id){
            $("#" + id).addClass("current");
            if($("#" + id).parent().hasClass("side-treeview")) {
                $("#" + id).parent().parent().addClass("active");
                $("#" + id).parent().show();
            }else{
                $("#" + id).parent().addClass("active");
            }
        };

        initAdmin = function () {
            $("#side-toggle").click(function () {
//            $(".side-menu>li.active").toggleClass('active');
                toggleSideTreeView($(".side-menu>li.active>a"));
                if ($(".side-left").width() == 70) {
                    $(".side-left").animate({width: '230px'}, "fast");
                }
                else if ($(".side-left").width() == 230) {
                    $(".side-left").animate({width: '70px'}, "fast");
                }
                $("body").toggleClass("side-sm");
                $("body").toggleClass("side-md");
            });

            $(".side-menu>li>a").click(function () {
                toggleSideTreeView($(this));
//            sideGetView($(this));
            });

            $(".side-menu li").each(function (index) {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");
                }
            });
//        $(".side-treeview>li>a").click(function() {
//            sideGetView($(this));
//        });

//        $(".side-left").height($("#content").height()+$(".footer").height());
        };

        $(document).ready(function () {
            //初始化material
//            $.material.init();
            initAdmin();
//            initCurrentSide();
        });
    </script>
@endsection