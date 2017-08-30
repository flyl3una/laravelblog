@extends('admin.index')

@section('content')
    <div class="container">
        <h5>编辑文章</h5>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data"
              action="{{ route('article.update', $article['id']) }}" target="target_iframe">
            {{--                        <input hidden value="{{ csrf_token() }}">--}}
            {{ csrf_field() }}
            @if(isset($article))
                {{ method_field('PUT') }}
            @endif
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="inputTitle">文章标题</label>
                    <input id="inputTitle" type="text" class="validate" name="title"
                           value="{{ isset($article) ? $article['title'] : ''}}">
                </div>
            </div>
            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="description_id" type="text" name="description" class="validate"
                           value="{{ isset($article) ? $article['description'] : ''}}">
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
                <div class="file-field input-field col m12 s12">
                    <div class="btn">
                        <span>重新上传markdown文件</span>
                        <input type="file" name="md_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" name="file_name" type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <input type="submit" class="btn btn-primary" value="{{ isset($article) ? "更新" : "创建"}}">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @parent
    <script>
        showCreateResult = function (data){
            if(data.code == 0) {
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