@section('header')
    <div class="admin-header">
        <div class="navbar nav-default">
        <div class="container-fluid">
            {{--<div class="row">--}}
            {{--<nav class="navbar navbar-header">--}}
            {{--<ul class="nav navbar-nav nav-home">--}}
                {{--<li>--}}
                    {{--<a href="http://laravelblog/home" class="white-color">--}}
                        {{--<i class="iconfont icon-home"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
                <div class="navbar-header">
                    <a href="{{ route('home.index') }}" class="navbar-brand white-color">Laravel Blog</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav nav-admin">
                        <li>
                            <a href="{{ route("admin.index") }}" class="white-color">
                                <i class="iconfont icon-home"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        {{--<li>--}}
                            {{--<a href="{{ route('login') }}" class="white-color">登陆</a>--}}
                        {{--</li>--}}
                        <li><a href="{{ route('admin.index') }}" class="white-color">归档</a></li>
                        {{--<li><a href="{{ route('register') }}" class="white-color">注册</a></li>--}}
                        {{--<li><a href="{{ route('logout') }}" class="white-color">登出</a></li>--}}
                        {{--<li><a href="{{ route('admin.index') }}" class="white-color">后台</a></li>--}}
                        <li>
                            <a href="#" class="nav-user" data-toggle="dropdown">
                                <img src="/images/img.jpg" alt="" class="user-img">
                                {{--<span>Luna</span>--}}
                                Luna
                                {{--<i class="fa fa-angle-down"></i>--}}
                                <i class="iconfont icon-unfold"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">个人信息</a></li>
                                <li><a href="{{ route('logout') }}">登出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            {{--</nav>--}}
            </div>
        {{--</div>--}}
        </div>
    </div>

@endsection