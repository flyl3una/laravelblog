{{--@extends("admin.layout")--}}
{{--@extends("admin.header")--}}
{{--@extends("admin.sidebar")--}}

{{--@extends("admin.footer")--}}

{{--@extends("admin.css")--}}
{{--@extends("admin.js")--}}
@extends("admin.index")

@section('content')
    <div class="container">
        <h5>文章列表</h5>
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
        {{--<div class="card z-depth-4">--}}
            <table class="bordered highlight table-list">
                <thead class="grey lighten-4">
                <tr>
                    <th class="manage-row">
                        <input type="checkbox" id="all_select">
                        <label for="all_select"></label>
                    </th>
                    <th width="25%">文章标题</th>
                    <th width="10%">文章作者</th>
                    <th width="10%">文章分类</th>
                    <th width="25%">文章标签</th>
                    <th width="10%">赞 / 查看</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articleList as $article)
                    <tr>
                        <td class="select-row">
                            <input type="checkbox" class="select-id" id="{{ $article['id'] }}" name="articleIds">
                            <label for="{{ $article['id'] }}"></label>
                        </td>
                        <td>
                            <a>{{ $article['title'] }}</a>
                        </td>
                        <td><span>{{ $article['user'] }}</span></td>
                        <td><span>{{ $article['cate'] }}</span></td>
                        <td>
                            @foreach($article['tags'] as $tag)
                                <div class="chip-tag chip left">{{ $tag }}</div>
                                @endforeach
                        </td>

                        <td><span>5 / {{ $article['click_count'] }}</span></td>
                        {{--<td><a href="article/{{ $article['id'] }}/edit">编辑</a>--}}
                        {{--                                        <a href="article/{{ $article['id'] }}/destroy">删除</a> </td>--}}
                        <td>
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
                            {{--<ul class="article-operator">--}}
                            <a href="">查看</a>
                            <a href="">编辑</a>
                            <a href="">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{--</div>--}}
        <div class="row">
            <div class="col m3 s8 input-field">
                <select class="initialized">
                    <option value="" disabled="" selected="">选择操作</option>
                    <option>
                        <a href="#">删除</a>
                    </option>
                </select>
            </div>
            <div class="col m2 s4">
                <button type="submit" class="waves-effect waves-light btn input-field-button" value="应用">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $articleAll->render() !!}
            </div>
        </div>
    </div>
@endsection


@section("js")
    @parent
    <script>

        $(document).ready(function () {
            setCurrentSide("side_article_list");

        });
    </script>
@endsection
