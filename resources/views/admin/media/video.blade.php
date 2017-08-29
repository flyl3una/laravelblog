@extends('admin.index')

@section('content')

    <div class="container">
        <h5>创建文章</h5>
        <div class="row">
            <div class="input-field col m12 s12">
                <label for="inputTitleId">文章标题</label>
                <input id="inputTitleId" type="text" class="validate" name="title">
            </div>
        </div>
        <div class="row">
            {{--<div class="input-filed col m12 s12">--}}
            <div class="input-field col m10 s8">
                <input id="add_cate" type="text" name="cateName" class="validate">
                <label for="add_cate">目录名称</label>
            </div>
            {{--</div>--}}
        </div>
    </div>


@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function(){
            setCurrentSide("side_media_picture");
//            Materialize.updateTextFields();
        });
    </script>
@endsection