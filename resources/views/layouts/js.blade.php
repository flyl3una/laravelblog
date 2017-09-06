@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/materialize/dist/js/materialize.min.js"></script>

    <script>

        selectTab = function(id) {
            $('#select_page>li').removeClass('active');
            $('#'+id).addClass('active');
        };

        $(document).ready(function () {
            //初始化material
//            $.material.init();
            $('select').material_select();
            $('.modal').modal();
            $('.parallax').parallax();

            $('.button-collapse').sideNav({
                    menuWidth: 300, // Default is 240
                    edge: 'right', // Choose the horizontal origin
                    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                    draggable: true // Choose whether you can drag to open on touch screens
                }
            );
        });
    </script>
@endsection