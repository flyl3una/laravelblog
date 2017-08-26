@section('header')
    <header class="admin-header">
    {{--<div class="navbar nav-default">--}}
    {{--<div class="container-fluid">--}}
    {{--<div class="navbar-header">--}}
    {{--<a href="{{ route('home.index') }}" class="navbar-brand white-color">Laravel Blog</a>--}}
    {{--</div>--}}
    {{--<div class="navbar-collapse collapse navbar-responsive-collapse">--}}
    {{--<ul class="nav navbar-nav nav-admin">--}}
    {{--<li>--}}
    {{--<a href="{{ route("admin.index") }}" class="white-color">--}}
    {{--<i class="iconfont icon-home"></i>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<li>--}}
    {{--<a href="{{ route('login') }}" class="white-color">登陆</a>--}}
    {{--</li>--}}
    {{--<li><a href="{{ route('admin.index') }}" class="white-color">归档</a></li>--}}
    {{--<li><a href="{{ route('register') }}" class="white-color">注册</a></li>--}}
    {{--<li><a href="{{ route('logout') }}" class="white-color">登出</a></li>--}}
    {{--<li><a href="{{ route('admin.index') }}" class="white-color">后台</a></li>--}}
    {{--<li>--}}
    {{--<a href="#" class="nav-user" data-toggle="dropdown">--}}
    {{--<img src="/images/img.jpg" alt="" class="user-img">--}}
    {{--Luna--}}
    {{--<i class="iconfont icon-unfold"></i>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu dropdown-user">--}}
    {{--<li><a href="#">个人信息</a></li>--}}
    {{--<li><a href="{{ route('logout') }}">登出</a></li>--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}

    <!-- Dropdown Structure -->
        {{--<div class="container-fluid">--}}
            {{--<div class="row">--}}


                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="#" class="waves-effect waves-light">个人信息</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}" class="waves-effect waves-light">登出</a></li>
                    {{--<li><a href="#!">三</a></li>--}}
                </ul>
                <nav class="teal lighten-2">
                    <div class="nav-wrapper">
                        {{--<div class="col s12">--}}
                            <a href="{{ route('admin.index') }}" class="brand-logo waves-effect waves-light" style="margin-left: 20px">MBlog</a>
                            <a href="#" data-activates="mobile-demo" class="button-collapse">
                                <i class="iconfont icon-menu"></i></a>
                            <ul class="side-nav" id="mobile-demo">
                                <li><a href="sass.html">Sass</a></li>
                                <li><a href="badges.html">组件</a></li>
                                <li><a href="collapsible.html">JavaScript</a></li>
                            </ul>

                            <ul id="mobile-demo" class="right hide-on-med-and-down">
                                <li><a href="{{ route('admin.index') }}" class="waves-effect waves-light">归档</a></li>
                                <li><a href="{{ route('admin.index') }}" class="waves-effect waves-light">关于</a></li>
                                <!-- Dropdown Trigger -->
                                <li>
                                    <a class="dropdown-button waves-effect waves-light" href="#" data-activates="dropdown1">
                                        下拉
                                        <i class="iconfont icon-xiangxia right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </nav>
            </header>
        {{--</div>--}}
    {{--</div>--}}

@endsection