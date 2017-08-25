{{--@extends("admin.layout")--}}
{{--@extends("admin.header")--}}
{{--@extends("admin.sidebar")--}}

{{--@extends("admin.footer")--}}

{{--@extends("admin.css")--}}
{{--@extends("admin.js")--}}
@extends("admin.index")

@section('content')

<h3>文章列表</h3>
<div class="row">
    <ul class="select-status">
        <li class="active"><a>全部 （3）</a>
        </li>
        <li>|</li>
        <li><a>已发布 ( 3 )</a></li>
        <li>|</li>
        <li><a>草稿 ( 2 )</a></li>
    </ul>
</div>

<div class="table-responsive">
    <table class="table-list-article table table-striped">
        <tbody>
        <tr>
            <th width="30%">文章标题</th>
            <th width="10%">文章作者</th>
            <th width="10%">文章分类</th>
            <th width="25%">文章标签</th>
            <th width="10%">赞 / 查看</th>
            <th width="15%">操作</th>
        </tr>
        @foreach($articleList as $article)
            <tr>
                <td class="table-article-title">
                    <a>{{ $article['title'] }}</a>
                </td>
                <td><span>{{ $article['user'] }}</span></td>
                <td><span>{{ $article['cate'] }}</span></td>
                <td class="table-article-tags">
                    <ul class="article-tags">
                        @foreach($article['tags'] as $tag)
                            <li class="bg-success"><span>{{ $tag }}</span></li>
                        @endforeach
                    </ul>
                </td>

                <td><span>5 / {{ $article['click_count'] }}</span></td>
                {{--<td><a href="article/{{ $article['id'] }}/edit">编辑</a>--}}
                {{--                                        <a href="article/{{ $article['id'] }}/destroy">删除</a> </td>--}}
                <td class="table-article-action">
                    {{--<a href="{{ route('article.edit', $article['id']) }}"--}}
                       {{--class="btn btn-raised btn-success">编辑</a>--}}
                        {{--<a href="{{ route('article.destroy', $article['id']) }}" class="btn btn-danger">删除</a>--}}
                    {{--<form method="POST"--}}
                          {{--action="{{ route('article.destroy', $article['id']) }}">--}}
                        {{--更改隐身提交方法为DELETE--}}
                        {{--<input type="hidden" name="_method" value="DELETE"/>--}}
                        {{--添加csrf认证--}}
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                        {{--<input type="submit" value="删除" class="btn btn-raised btn-danger"/>--}}
                    {{--</form>--}}
                    <ul class="article-operator">
                        <li><a href="">查看</a></li>
                        <li><a href="">编辑</a></li>
                        <li><a href="">删除</a></li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $articleAll->render() !!}
</div>
@endsection
{{--@stop--}}
{{--@override--}}

@section("common_js")
    @parent
<script>
    $(document).ready(function(){
        initCurrentSide("side_article_list");
    });

</script>
@endsection
{{--@stop--}}