@extends('admin.index')

@section('css')
    @parent
    <link rel="stylesheet" href="/vendors/editor.md/css/editormd.css">
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h5>创建文章</h5>
        <div class="row"></div>
        <form class="form-horizontal" method="POST"
              action="{{ route('article.store') }}" target="target_iframe">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="input_title_id">文章标题</label>
                    <input id="input_title_id" type="text" class="validate" name="title">
                </div>
            </div>
            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="description_id" type="text" name="description" class="validate">
                    <label for="description_id">文章描述</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <select id="select_category_id" class="initialized" name="category">
                        <option value="" disabled selected>选择目录</option>
                        @foreach($cates as $cate1)
                            @if($cate1['id'] != 1)
                                <option value="{{ $cate1['id'] }}"
                                        @if(isset($cate) && $cate['id'] === $cate1['id']) selected @endif>{{ $cate1['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="select_category_id">文章目录</label>
                </div>
                <div class="input-field col m6 s12">
                    <select class="form-control" multiple id="select_tags_id" name="tags[]">
                        <option value="" disabled selected>选择标签</option>
                        @foreach($tagAll as $tag)
                            @if(isset($tags) && in_array($tag, $tags))
                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                            @else
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="select_tags_id">文章标签</label>
                </div>
            </div>
            <div class="row">
                <div id="editormd" class="editormd editormd-vertical" style="width: 640px">
                    {{--<textarea style="display:none;">### Hello Editor.md !</textarea>--}}
                </div>
            </div>
            {{--<div class="row">--}}
            {{--<div class="file-field input-field col m12 s12">--}}
            {{--<div class="btn">--}}
            {{--<span>上传markdown文件</span>--}}
            {{--<input type="file" name="md_file">--}}
            {{--</div>--}}
            {{--<div class="file-path-wrapper">--}}
            {{--<input class="file-path validate" name="file_name" type="text">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <button class="btn waves-effect waves-light right" type="submit" name="action">提交
                    <i class="iconfont icon-fabu right"></i>
                </button>
            </div>

        </form>

    </div>


@endsection

@section('js')
    @parent
    <script src="/vendors/editor.md/editormd.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var editor = editormd("editormd", {
                path: "/vendors/editor.md/lib/", // Autoload modules mode, codemirror, marked... dependents libs path
//                appendMarkdown : md,
                saveHTMLToTextarea : true
            });

            /*
            // or
            var editor = editormd({
                id   : "editormd",
                path : "../lib/"
            });
            */
        });
    </script>
    <script>
        showCreateResult = function (data) {
            if (data.code == 0) {
                window.location = data.url;
            } else {
                alert(data.info);
            }
        };

        $(document).ready(function () {
            setCurrentSide("side_article_create");
//            Materialize.updateTextFields();
        });
    </script>
@endsection