@section('header')
    <header class="admin-header">
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="#" class="waves-effect waves-light">个人信息</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('logout') }}" class="waves-effect waves-light">登出</a></li>
        </ul>
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <a href="{{ route('root') }}" class="brand-logo waves-effect waves-light"
                   style="margin-left: 20px">MBlog</a>
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
                    <li>
                        <a class="nav-user dropdown-button waves-effect waves-light" href="#"
                           data-activates="dropdown1">
                            <img src="/images/user.jpg" alt="" class="user-img">
                            Luna
                            <i class="iconfont icon-xiangxia right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

@endsection