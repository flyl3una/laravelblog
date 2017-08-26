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
        <div class="card z-depth-4">
            <table class="bordered centered highlight table-list-article">
                <thead>
                <tr>
                    <th width="36px" class="manage-column">
                        <input type="checkbox" id="all">
                        <label for="all"></label>
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
                        <td>
                            <input type="checkbox" id="{{ $article['id'] }}">
                            <label for="{{ $article['id'] }}"></label>
                        </td>
                        <td class="table-article-title">
                            <a>{{ $article['title'] }}</a>
                        </td>
                        <td><span>{{ $article['user'] }}</span></td>
                        <td><span>{{ $article['cate'] }}</span></td>
                        <td class="table-article-tags">
                            {{--<ul class="article-tags">--}}
                                @foreach($article['tags'] as $tag)
                                    {{--<li class="">--}}
                                        <div class="chip-tag chip left">{{ $tag }}</div>
                                    {{--</li>--}}
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
                            {{--<ul class="article-operator">--}}
                                {{--<li>--}}
                            <div class="row">
                                <div class="col m4">
                                    <a href="">查看</a>
                                </div>
                                    {{--</li>--}}
                                    {{--<li>--}}
                                <div class="col m4">
                                    <a href="">编辑</a>
                                </div>
                                    {{--</li>--}}
                                    {{--<li>--}}
                                <div class="col m4">
                                    <a href="">删除</a>
                                </div>
                            </div>

                                {{--</li>--}}
                            {{--</ul>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row article-bottom-option">
            <div class="col m3 s8 input-field">
                {{--<div class="select-wrapper">--}}

                    <select class="initialized">
                        <option value="" disabled="" selected="">选择操作</option>
                        <option>
                            删除
                        </option>
                    </select>
            </div>
            <div class="col m2 s4">
                <button type="submit" class="waves-effect waves-light btn" value="应用">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $articleAll->render() !!}
            </div>
        </div>
    </div>
@endsection
{{--@stop--}}
{{--@override--}}

@section("js")
    @parent
    <script>
        $(document).ready(function () {
            initCurrentSide("side_article_list");
            $('select').material_select();
//            $('select').material_select('destroy');
        });
    </script>
@endsection
{{--@stop--}}