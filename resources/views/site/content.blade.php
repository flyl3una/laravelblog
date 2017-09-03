@section("content")

    <div class="container">
        <ul id="tabs_id" class="tabs">
            <li class="tab right"><a href="#test3">友情链接</a></li>
            <li class="tab right"><a class="active" href="#test2">归档</a></li>
            <li class="tab right"><a href="#test1">首页</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col m9 s12">
                @yield('left')
            </div>
            <div class="col m3 s12">
                <div id="user_card" class="right-card card z-depth-3">
                    <img src="/images/user.jpg" class="center">
                    <div class="card-content">
                        Welcome to my small home.
                    </div>
                </div>
                <div class="card z-depth-3">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>目录</h5></li>
                        @foreach($cates as $cate)
                            <li class="collection-item">
                                <div>{{ $cate['name'] }}
                                    <a href="#!" class="secondary-content">
                                        <span class="new badge" data-badge-caption="">{{ $cate['count'] }}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card z-depth-3">
                    <div class="card-action">
                        <h5>标签</h5>
                    </div>
                    <div class="card-action">
                        @foreach($tags as $tag)
                            <div class="chip">{{ $tag['name'] }}</div>
                        @endforeach
                        <div class="chip">css</div>
                        <div class="chip">html</div>
                        <div class="chip">随感</div>
                        <div class="chip">css</div>
                        <div class="chip">html</div>
                        <div class="chip">随感</div>
                        <div class="chip">css</div>
                        <div class="chip">html</div>
                        <div class="chip">随感</div>
                    </div>
                </div>

                <div class="card z-depth-3">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>友情链接</h5></li>
                        @foreach($links as $link)
                            <li class="collection-item">
                                <div>{{ $link['name'] }}
                                    <a href="{{ $link['url'] }}" class="secondary-content">
                                        <i class="iconfont icon-fabu"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">--}}
    {{--<div class="col m88">--}}
    {{--@foreach($articles as $article)--}}
    {{--<div class="panel panel-info">--}}
    {{--<div class="panel-heading">--}}
    {{--<div class="panel-title">--}}
    {{--xxx--}}
    {{--{{ $article['title'] }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<ul class="list-group">--}}
    {{--<li class="list-group-item">--}}
    {{--date--}}
    {{--{{ $article['created_date'] }}--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--content--}}
    {{--{{ $article['html_content'] }}--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--<div class="panel-footer">--}}
    {{--tags--}}
    {{--<div class="nav navbar-right">--}}
    {{--<a class="btn btn-info" href="{{ route("blog.show", $article->id) }}">阅读文章</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--{!! $articles->render() !!}--}}
    {{--</div>--}}
    {{--<div class="col-md-4 navbar-left">--}}
    {{--<div class="panel panel-info">--}}
    {{--个人--}}
    {{--</div>--}}
    {{--<div class="panel panel-info">--}}
    {{--<div class="panel-heading">--}}
    {{--分类--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($cates as $cate)--}}
    {{--<li class="list-group-item">--}}
    {{--{{ $cate['name'] }}--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="panel panel-info">--}}
    {{--<div class="panel-heading">--}}
    {{--标签--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($tags as $tag)--}}
    {{--<li class="list-group-item">--}}
    {{--{{ $tag['name'] }}--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--xxx--}}
    {{--<div class="row">--}}

    {{--</div>--}}
    {{--</div>--}}

@endsection