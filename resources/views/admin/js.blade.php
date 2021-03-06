@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/materialize/dist/js/materialize.min.js"></script>
    <script src="/vendors/echarts/dist/echarts.js"></script>
    <script>
        toggleSideTreeView = function (click) {
            click.parent().toggleClass('active');
            click.next().slideToggle("fast");
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

        setCurrentSide = function (id) {
            $("#" + id).addClass("current");
            if ($("#" + id).parent().hasClass("side-treeview")) {
                $("#" + id).parent().parent().addClass("active");
                $("#" + id).parent().show();
            } else {
                $("#" + id).parent().addClass("active");
            }
        };

        initAdmin = function () {
            $("#side-toggle").click(function () {
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
            });

            $(".side-menu li").each(function (index) {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");
                }
            });
        };

        allSelectColumn = function () {
            $(".manage-row>label").click(function () {
                if ($("#all_select").is(":checked")) {
                    $(".select-row>input[type='checkbox']").each(function () {
                        if ($(this).is(':checked')) {
                            $(this).next().click();
                        }
                    });
                } else {
                    $(".select-row>input[type='checkbox']").each(function () {
                        if (!$(this).is(':checked')) {
                            $(this).next().click();
                        }
                    });
                }
            });
        };

        $(document).ready(function () {
            initAdmin();
            $('select').material_select();
            $('.modal').modal();
        });
    </script>
@endsection