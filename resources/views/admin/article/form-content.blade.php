@section('form-content')

    <div class="form-group">
        <label class="col-sm-2 control-label" for="titleInput">文章标题</label>
        <div class="col-sm-10">
            <input id="titleInput" placeholder="title" type="text" class="form-control" name="title" value="{{ $article['title'] }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="categoryInput">文章目录</label>
        <div class="col-sm-10">
            {{--<input id="categoryInput" class="form-control" name="category">--}}
            <select id="categoryInput" class="form-control" name="category">
                @foreach($cates as $cate)
                    <option name="{{ $cate['id'] }}">{{ $cate['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tagsInput">文章标签</label>
        <div class="col-sm-10">
            <select class="form-control" multiple id="tagsInput" name="tags">
                @foreach($tagAll as $tag)
                    <option name="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="description">文章描述</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="description" name="description" value="{{ $article['description'] }}">
        </div>
    </div>
    {{--<div class="form-group">--}}
    {{--<label class="col-sm-2 control-label" for="markdown"--}}
    {{--</div>--}}
    <div class="form-group">
        <label for="post-content-textarea" class="control-label">文章内容*</label>
        <textarea spellcheck="false" id="post-content-textarea" class="form-control" name="markdown_content"
                  rows="36"
                  placeholder="请使用 Markdown 格式书写"
                  style="resize: vertical">{{ $article['markdown_content'] }}</textarea>
        {{--@if($errors->has('content'))--}}
        {{--<span class="help-block">--}}
        {{--<strong>{{ $errors->first('content') }}</strong>--}}
        {{--</span>--}}
        {{--@endif--}}
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <input type="submit" class="btn btn-success" value="更改">
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

@endsection