@section("content")
    <ul id="slide-out" class="side-nav">
        <li><div class="userView">
                <div class="background">
                    <img src="images/office.jpg">
                </div>
                <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
                <a href="#!name"><span class="white-text name">张三</span></a>
                <a href="#!email"><span class="white-text email">jdandturk@sina.com</span></a>
            </div></li>
        <li><a href="#!"><i class="material-icons">cloud</i>带图标的第一链接</a></li>
        <li><a href="#!">第二链接</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">子标题</a></li>
        <li><a class="waves-effect" href="#!">带波纹效果的第三链接</a></li>
    </ul>
    {{--<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>--}}

    <div class="container">
        <ul id="tabs_id" class="tabs">
            {{--<li class="tab right"><a href="#test3" class="teal-text">友情链接</a></li>--}}
            <li class="tab right"><a id="archive_tab_id" class="teal-text" href="{{ route('home.archive') }}">归档</a></li>
            <li class="tab right"><a id="index_tab_id" href="#index_id" class="teal-text active">首页</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col m9 s12">
                @yield('left')
            </div>
            <div class="col m3 s12">
                <div id="user_card" class="right-card card z-depth-2">
                    <a href="#" data-activates="slide-out" class="button-collapse">
                        <img src="/images/user.jpg" class="center circle ">
                    </a>
                    {{--<img src="/images/user.jpg" class="center circle ">--}}
                    <div class="card-content">
                        Welcome to my small home.
                    </div>
                </div>

                <div class="card z-depth-2">
                    <div class="card-action">
                        <h5>归档</h5>
                    </div>
                    <div class="card-action">
                        @foreach($groups as $group)
                            <li class="collection-item">
                                <div>{{ $group['year'] }}
                                    <a href="#!" class="secondary-content">
                                        <span class="new badge" data-badge-caption="">{{ $group['count'] }}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </div>
                </div>

                <div class="card">
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

                <div class="card z-depth-2">
                    <div class="card-action">
                        <h5>标签</h5>
                    </div>
                    <div class="card-action">
                        @foreach($tags as $tag)
                            <div class="chip">{{ $tag['name'] }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="card z-depth-2">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>友情链接</h5></li>
                        @foreach($links as $link)
                            <li class="collection-item">
                                <div>{{ $link['name'] }}
                                    <a href="{{ $link['url'] }}" class="secondary-content cyan-text">
                                        <i class="iconfont icon-fabu "></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection