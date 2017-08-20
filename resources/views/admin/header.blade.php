@section('header')
<div class="container-fluid" style="background-color: #1f648b">
    <nav class="navbar site-navbar">
        <div class="navbar-header navbar-nav">
            <a href="{{ route('home.index') }}" class="navbar-brand white-color">Laravel Blog</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route("home.index") }}" class="btn white-color">归档</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('login') }}" class="white-color">登陆</a>
                </li>
                <li><a href="{{ route('register') }}" class="white-color">注册</a> </li>
                <li><a href="{{ route('logout') }}" class="white-color">登出</a> </li>
                <li><a href="{{ route('admin.index') }}" class="white-color">后台</a> </li>
            </ul>
        </div>

    </nav>
</div>

@endsection