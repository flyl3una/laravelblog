{{--@extends("admin.layout")--}}
{{--@extends('admin.header')--}}
{{--@extends("admin.sidebar")--}}

{{--@extends("layouts.css")--}}
{{--@extends("layouts.js")--}}

{{--@extends("admin.index")--}}

{{--@section('content')--}}

{{--<div class="admin-right-content">--}}
{{--<div class="container-">--}}

<h3>文章列表</h3>
{{--<div class="row">--}}
    {{----}}
{{--</div>--}}
<div class="row">
<ul class="select-status">
    <li class="active"><a>全部 ( 3 )</a>
    </li>
    <li><a>已发布 ( 3 )</a></li>
    <li><a>草稿 ( 2 )</a></li>
</ul>
</div>

<div class="content-panel">
    {{--<div class="panel panel-info center-block">--}}
        {{--<div class="panel-heading">--}}
            {{--文章列表--}}
        {{--</div>--}}
        {{--<div class="panel-body">--}}
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th class="col-md-1" width="20%">文章作者</th>
                        <th class="col-md-1" width="20%">文章分类</th>
                        <th class="col-md-2" width="20%">文章标签</th>
                        <th class="col-md-1" width="20%">文章标题</th>
                        <th class="col-md-1" width="20%">点击次数</th>
                        <th class="col-md-2" width="20%">操作</th>
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
                            <td>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ route('article.edit', $article['id']) }}"
                                           class="btn btn-success">编辑</a>
                                    </div>
                                    <div class="col-sm-6">
                                        {{--<a href="{{ route('article.destroy', $article['id']) }}" class="btn btn-danger">删除</a>--}}
                                        <form method="POST"
                                              action="{{ route('article.destroy', $article['id']) }}">
                                            {{--更改隐身提交方法为DELETE--}}
                                            <input type="hidden" name="_method" value="DELETE"/>
                                            {{--添加csrf认证--}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" value="删除" class="btn btn-danger"/>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $articleAll->render() !!}
            </div>
        {{--</div>--}}
    {{--</div>--}}
</div>
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}