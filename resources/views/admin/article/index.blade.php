@extends("admin.layout")
@extends("admin.sidebar")


@extends("layouts.css")
@extends("layouts.js")

@section('content')

    <div class="admin-content">

        <div class="content-panel">
            <div class="panel panel-info center-block">
                <div class="panel-heading">
                    文章列表
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="col-md-1">文章作者</th>
                            <th class="col-md-1">文章分类</th>
                            <th class="col-md-2">文章标签</th>
                            <th class="col-md-1">文章标题</th>
                            <th class="col-md-1">点击次数</th>
                            <th class="col-md-2">操作</th>
                        </tr>
                        @foreach($articleList as $article)
                        <tr>
                            <td>{{ $article['user'] }}</td>
                            <td>{{ $article['cate'] }}</td>
                            <td>
                                @foreach($article['tags'] as $tag)
                                <div class="btn"> {{ $tag }}
                                </div>
                                @endforeach
                            </td>
                            <td>{{ $article['title'] }}</td>
                            <td>{{ $article['click_count'] }}</td>
                            {{--<td><a href="article/{{ $article['id'] }}/edit">编辑</a>--}}
{{--                                        <a href="article/{{ $article['id'] }}/destroy">删除</a> </td>--}}
                            <td><a href="{{ route('article.edit', $article['id']) }}">
                                    <button class="btn btn-success">
                                    编辑</button></a>
{{--                                    <a href="{{ route('article.destroy', $article['id']) }}">删除</a>--}}
                                <form method="POST" action="{{ route('article.destroy', $article['id']) }}">
                                    {{--更改隐身提交方法为DELETE--}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{--添加csrf认证--}}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" value="删除" class="btn btn-danger"/>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $articleAll->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection