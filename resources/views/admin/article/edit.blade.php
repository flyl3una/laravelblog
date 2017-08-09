@extends("admin.layout")
@extends("admin.sidebar")

@extends("layouts.css")
@extends("layouts.js")

@section('content')
<div class="admin-content">
<div class="container">
    <div class="row">
        <div class="col-md-12 margin-top-50">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        编辑文章
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ isset($article) ? route('article.update', $article['id']) : route('article.store')}}">
{{--                        <input hidden value="{{ csrf_token() }}">--}}
                        {{ csrf_field() }}
                        @if(isset($article))
                        <input hidden name="_method" value="PUT">
                        @endif
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="titleInput">文章标题</label>
                                <div class="col-sm-10">
                                    <input id="titleInput" placeholder="title" type="text" class="form-control" name="title" value="{{ isset($article) ? $article['title'] : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="categoryInput">文章目录</label>
                                <div class="col-sm-10">
                                    {{--<input id="categoryInput" class="form-control" name="category">--}}
                                    <select id="categoryInput" class="form-control" name="category">
                                        @foreach($cates as $cate1)
                                            <option value="{{ $cate1['id'] }}" @if(isset($cate) && $cate['id'] === $cate1['id']) selected @endif>{{ $cate1['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="tags[]">文章标签</label>
                                <div class="col-sm-10">
                                    {{--<div class="form-control">--}}
                                    {{--</div>--}}
                                    <select class="form-control" multiple id="tagsInput" name="tags[]">
                                        {{--@foreach($tagAll as $tag)--}}
                                            {{--<option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>--}}
                                        {{--@endforeach--}}
                                        @foreach($tagAll as $tag)
                                            @if(isset($tags) && in_array($tag, $tags))
                                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                            @else
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="col-sm-2">--}}
                                    {{--<div class="dropdown">--}}
                                        {{--<ul --}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="description">文章描述</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description" value=
                                    "{{ isset($article) ? $article['description'] : ''}}">
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label class="col-sm-2 control-label" for="markdown"--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="post-content-textarea" class="control-label">文章内容</label>
                                <textarea spellcheck="false" id="post-content-textarea" class="form-control" name="markdown_content"
                                          rows="20"
                                          placeholder="请使用 Markdown 格式书写"
                                          style="resize: vertical"
                                >{{ isset($article) ? $article['markdown_content'] : ''}}</textarea>
                                {{--@if($errors->has('content'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('content') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary" value="{{ isset($article) ? "更改" : "创建"}}">
                                </div>
                                {{--<div class="radio radio-inline">--}}
                                {{--<label>--}}
                                {{--<input type="radio"--}}
                                {{--{{ (isset($post)) && $post->status == 1 ? ' checked ':'' }}--}}
                                {{--name="status"--}}
                                {{--value="1">发布--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--<div class="radio radio-inline">--}}
                                {{--<label>--}}
                                {{--<input type="radio"--}}
                                {{--{{ (!isset($post)) || $post->status == 0 ? ' checked ':'' }}--}}
                                {{--name="status"--}}
                                {{--value="0">草稿--}}
                                {{--</label>--}}
                                {{--</div>--}}
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
{{--</div>--}}
</div>
</div>
@endsection