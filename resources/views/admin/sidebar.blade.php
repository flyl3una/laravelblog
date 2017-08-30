@section('sidebar')

    <div class="side-left">
        <div class="user-profile">
            {{--<div class="welcome">Welcome</div>--}}
            {{--<img src="/images/img.jpg" alt="" class="user-img">--}}
            <div class="user-info">
                <p>welcome,</p>
                <h5>Luna</h5>
            </div>
            <div id="side-toggle" class="side-toggle">
                <a class="toggle waves-effect waves-light">
                {{--<i class="fa fa-bars"></i>--}}
                    <i class="iconfont icon-menu"></i>
                </a>
            </div>
            {{--<i --}}
        </div>
        <div class="clearfix"></div>

        <ul class="side-menu">
            <li id="side_system_info">
                <a href="{{ route('admin.index') }}" data-url="{{ route('admin.index') }}" class="waves-effect waves-light">
                    {{--<i class="md-account-balance"></i>--}}
                    {{--<span class="fa fa-dashboard fa-fw"></span>icon-windows--}}
                    <span class="iconfont icon-computer"></span>
                    <span class="side-item-name">系统</span>
                </a>
            </li>
            <li id="user_info">
                <a href="{{ route('admin.index') }}" data-url="{{ route('admin.index') }}" class="waves-effect waves-light">
                    {{--<i class="md-account-balance"></i>--}}
                    {{--<span class="fa fa-user-circle-o fa-fw"></span>--}}
                    <span class="iconfont icon-personal"></span>
                    <span class="side-item-name">用户</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-light">
                    {{--<span class="fa fa-pencil fa-fw"></span>--}}
                    <span class="iconfont icon-brush"></span>
                    {{--<span>文章管理</span>--}}
                    <span class="side-item-name">文章</span>
                    {{--<i class="fa fa-angle-left"></i>--}}
                    <i class="iconfont icon-return"></i>
                </a>
                <ul class="side-treeview ">
                    <li id="side_article_list" class="waves-effect waves-light">
                        <a href="{{ route('article.index') }}" class="">
                            {{--<i class="fa fa-home"></i>--}}
                            <span class="side-item-name">文章列表</span>
                        </a>
                    </li>
                    <li id="side_article_create" class="waves-effect waves-light">
                        <a href="{{ route('article.create') }}" data-url="{{ route('article.create') }}">
                            {{--<i class="fa fa-home"></i>--}}
                            <span class="side-item-name">创建文章</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="waves-effect waves-light">
                    {{--<span class="fa fa-pencil fa-fw"></span>--}}
                    <span class="iconfont icon-copy"></span>
                    {{--<span>文章管理</span>--}}
                    <span class="side-item-name">页面</span>
                    {{--<i class="fa fa-angle-left"></i>--}}
                    <i class="iconfont icon-return"></i>
                </a>
                <ul class="side-treeview ">
                    <li id="side_page_list" class="waves-effect waves-light">
                        <a href="{{ route('page.index') }}" class="">
                            {{--<i class="fa fa-home"></i>--}}
                            <span class="side-item-name">所有页面</span>
                        </a>
                    </li>
                    <li id="side_page_create" class="waves-effect waves-light">
                        <a href="{{ route('page.create') }}">
                            {{--<i class="fa fa-home"></i>--}}
                            <span class="side-item-name">上传页面</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{--<li>--}}
                {{--<a class="waves-effect waves-light">--}}
                    {{--<span class="fa fa-pencil fa-fw"></span>--}}
                    {{--<span class="iconfont icon-duomeiti"></span>--}}
                    {{--<span>文章管理</span>--}}
                    {{--<span class="side-item-name">媒体</span>--}}
                    {{--<i class="fa fa-angle-left"></i>--}}
                    {{--<i class="iconfont icon-return"></i>--}}
                {{--</a>--}}
                {{--<ul class="side-treeview">--}}
                    {{--<li id="side_media_picture" class="waves-effect waves-light">--}}
                        {{--<a href="{{ route('media.picture.index') }}" class="">--}}
                            {{--<i class="fa fa-home"></i>--}}
                            {{--<span class="side-item-name">图片</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li id="side_media_video" class="waves-effect waves-light">--}}
                        {{--<a href="{{ route('media.video.index') }}">--}}
                            {{--<i class="fa fa-home"></i>--}}
                            {{--<span class="side-item-name">视频</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li id="side_media_audio" class="waves-effect waves-light">--}}
                        {{--<a href="{{ route('media.audio.index') }}">--}}
                            {{--<i class="fa fa-home"></i>--}}
                            {{--<span class="side-item-name">音频</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li id="side_media_manage">
                <a href="{{ route('media.index') }}" class="waves-effect waves-light">
                    <span class="iconfont icon-duomeiti"></span>
                    <span class="side-item-name">媒体</span>
                </a>
            </li>
            <li id="side_categories_manage">
                <a href="{{ route('categories.index') }}" class="waves-effect waves-light">
                    {{--<span class="fa fa-bookmark fa-fw"></span>--}}
                    <span class="iconfont icon-subscription"></span>
                    <span class="side-item-name">分类</span>
                </a>
            </li>
            <li id="side_tags_manage">
                <a href="{{ route('tag.index') }}" class="waves-effect waves-light">
                    {{--<span class="fa fa-tags fa-fw"></span>--}}
                    <span class="iconfont icon-zhekou"></span>
                    <span class="side-item-name">标签</span>
                </a></li>
            <li id="side_links_index">
                <a href="{{ route('link.index') }}" class="waves-effect waves-light">
                    {{--<span class="fa fa-link fa-fw"></span>--}}
                    <span class="iconfont icon-accessory"></span>
                    <span class="side-item-name">链接</span>
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

