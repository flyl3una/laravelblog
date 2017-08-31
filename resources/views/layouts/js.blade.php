@section("js")
    <script src="/vendors/jquery/dist/jquery.min.js"></script>

    <script src="/vendors/materialize/dist/js/materialize.min.js"></script>


    <script>

        $(document).ready(function () {
            //初始化material
//            $.material.init();
            $('select').material_select();
            $('.modal').modal();
        });
    </script>
@endsection