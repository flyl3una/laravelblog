@section("content")

    <div class="content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @foreach($articles as $article)
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    {{--xxx--}}
                                    {{ $article['title'] }}
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{--date--}}
                                    {{ $article['created_date'] }}
                                </li>
                                <li class="list-group-item">
                                    {{--content--}}
                                    {{ $article['html_content'] }}
                                </li>
                            </ul>
                            <div class="panel-footer">
                                tags
                                <div class="nav navbar-right">
                                    <a class="btn btn-info" href="{{ route("article.show", $article->id) }}">阅读文章</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! $articles->render() !!}
                </div>
                <div class="col-md-4 navbar-left">
                    <div class="panel panel-info">
                        个人
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            分类
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($cates as $cate)
                                    <li class="list-group-item">
                                        {{ $cate['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            标签
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($tags as $tag)
                                    <li class="list-group-item">
                                        {{ $tag['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection