@section('sidebar')

    <div class="side-left">
        <div class="user-profile">
            {{--<div class="welcome">Welcome</div>--}}
            {{--<img src="/images/img.jpg" alt="" class="user-img">--}}
            <div class="user-info">
                <p>welcome,</p>
                <h4>Luna</h4>
            </div>
            <div id="side-toggle" class="side-toggle">
                <a class="toggle">
                <i class="fa fa-bars"></i>
                </a>
            </div>
            {{--<i --}}
        </div>
        <div class="clearfix"></div>

        <ul class="side-menu">
            <li>
                <a href="/admin/user">
                    {{--<i class="md-account-balance"></i>--}}
                    <span class="glyphicon glyphicon-home"></span>
                    <span class="side-item-name">用户信息</span>
                </a>
            </li>
            <li class="active">
                <a>
                    <span class="glyphicon glyphicon-home"></span>
                    {{--<span>文章管理</span>--}}
                    <span class="side-item-name">文章管理</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="side-treeview">
                    <li>
                        <a href="{{ route('article.index') }}">
                            {{--<i class="fa fa-home"></i>--}}
                            <span>文章列表</span>
                        </a>
                    </li>
                    <li><a href="{{ route('article.create') }}">
                            {{--<i class="fa fa-home"></i>--}}
                            <span>创建文章</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('categories.index') }}">
                    <span class="fa fa-home"></span>
                    <span class="side-item-name">分类管理</span>
                </a>
            </li>
            <li><a href="{{ route('tag.index') }}">
                    <span class="fa fa-home"></span>
                    <span class="side-item-name">标签管理</span>
                </a></li>
            <li><a href="{{ route('link.index') }}">
                    <span class="fa fa-home"></span>
                    <span class="side-item-name">友情连接</span>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>

        {{--<ul class="list-group">--}}
        {{--<li class="list-group-item">--}}
        {{--<a href="/admin/user" class="">--}}
        {{--用户信息--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('article.index') }}" class="">--}}
                    {{--文章列表--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-group-item text-center">--}}
                {{--<a href="{{ route('article.create') }}" class="">--}}
                    {{--创建文章--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('categories.index') }}" class="">分类管理</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('tag.index') }}">标签管理</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('link.index') }}">友情连接</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </div>

@endsection

