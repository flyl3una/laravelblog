@section("header")
    <div class="main-header">
        <div class="container-fluid">
            <nav class="navbar site-navbar">
                <div class="navbar-header navbar-nav">
                    <a href="{{ route('blog.index') }}" class="navbar-brand white-color">Laravel Blog</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route("blog.index") }}" class="btn white-color">归档</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ url('login') }}" class="white-color">登陆</a>
                        </li>
                        <li><a href="{{ url('register') }}" class="white-color">注册</a> </li>
                    </ul>
                </div>

            </nav>
        </div>
        <div class="container-fluid">
            <div class="description">Welcome</div>
        </div>
    </div>

@endsection