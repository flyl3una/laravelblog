@section("content")
    <ul id="slide-out" class="side-nav">
        <li>
            <div class="userView">
                <div class="background">
                    <img src="/images/header.jpg">
                </div>
                <a href="#!user"><img class="circle" src="/images/user.jpg"></a>
                <a href="#!name"><span class="white-text name">FlyL3una</span></a>
                <a href="#!email"><span class="white-text email">fly_luna@outlook.com</span></a>
            </div>
        </li>
        <li>
            <a class="" target="_blank" href="http://www.github.com/flyl3una/">
                <i class="iconfont icon-github"></i>flyl3una
            </a>
        </li>
        <li><a href="http://www.flyl3una.cc">www.flyl3una.cc</a></li>
        {{--<li>--}}
        {{--<div class="divider"></div>--}}
        {{--</li>--}}

        <ul class="collection with-header">
            <li class="collection-header"><h5>归档</h5></li>
            @foreach($groups as $group)
                <li class="collection-item">
                    <div>{{ $group['year'] }}
                        <a href="{{ route('home.archive', $group['year']) }}" class="secondary-content">
                            <span class="new badge" data-badge-caption="">{{ $group['count'] }}</span>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </ul>

    <div id="main_content_id" class="container">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="col m9 s12">
                @yield('left')
            </div>
            <div class="col m3 s12">
                <div id="user_card" class="card z-depth-2">
                    <a href="#" data-activates="slide-out" class="button-collapse">
                        <img src="/images/user.jpg" class="center circle ">
                        {{--<i class="iconfont icon-xitongcaidan1 center circle" style="font-size: 2em;"></i>--}}
                    </a>
                    {{--<img src="/images/user.jpg" class="center circle ">--}}
                    <div class="card-content">
                        Welcome to my small home.
                    </div>
                </div>

                <div class="card z-depth-2">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>归档</h5></li>
                        @foreach($groups as $group)
                            <li class="collection-item">
                                <div>{{ $group['year'] }}
                                    <a href="{{ route('home.archive', $group['year']) }}" class="secondary-content">
                                        <span class="new badge" data-badge-caption="">{{ $group['count'] }}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card z-depth-2">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>目录</h5></li>
                        @foreach($cates as $cate)
                            <li class="collection-item">
                                <div>{{ $cate['name'] }}
                                    <a href="{{ route('home.category', $cate['id']) }}" class="secondary-content">
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