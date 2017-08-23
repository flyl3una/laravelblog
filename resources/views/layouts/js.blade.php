@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/material.js"></script>
    <script src="/vendors/bootstrap-material-design/dist/js/ripples.js"></script>
    <script>

    </script>


<script>

    toggleSideTreeView = function (click){
        click.parent().toggleClass('active');
        click.next().slideToggle("fast");
//        click.toggleClass('active');
//        click.children(".side-treeview").slideToggle("fast");
    };

    sideGetView = function(click){
        var data_url = click.attr('data-url');
        if(data_url) {
//            console.log(data_url);
            // bug
            var html_data = $.get(data_url);
            console.log(html_data);
            $(".admin-right-content").html(html_data);
        }
    };

    function initAdmin() {
        $("#side-toggle").click(function () {
//            $(".side-menu>li.active").toggleClass('active');
            toggleSideTreeView($(".side-menu>li.active>a"));
            if($(".side-left").width() == 70){
                $(".side-left").animate({width: '230px'}, "fast");
            }
            else if($(".side-left").width() == 230){
                $(".side-left").animate({width: '70px'}, "fast");
            }
            $("#content").toggleClass("side-sm");
            $("#content").toggleClass("side-md");
        });

        $(".side-menu>li>a").click(function () {
//            $(this).parent().toggleClass('active');
//            $(this).next().slideToggle("normal");
            toggleSideTreeView($(this));
            sideGetView($(this));
//            $(this).toggleClass('active');
//            $(this).children(".side-treeview").slideToggle("normal");
        });
        $(".side-treeview>li>a").click(function() {
            sideGetView($(this));
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