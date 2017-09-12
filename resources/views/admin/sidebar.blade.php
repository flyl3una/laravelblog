@section('sidebar')

    <div class="side-left">
        <div class="user-profile">
            <div class="user-info">
                <p>welcome,</p>
                <h5>Luna</h5>
            </div>
            <div id="side-toggle" class="side-toggle">
                <a class="toggle waves-effect waves-light">
                    <i class="iconfont icon-menu"></i>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

        <ul class="side-menu">
            <li id="side_system_info">
                <a href="{{ route('admin.index') }}" data-url="{{ route('admin.index') }}"
                   class="waves-effect waves-light">
                    <span class="iconfont icon-computer"></span>
                    <span class="side-item-name">系统</span>
                </a>
            </li>
            <li id="user_info">
                <a href="{{ route('admin.user', 1) }}" data-url="{{ route('admin.user', 1) }}"
                   class="waves-effect waves-light">
                    <span class="iconfont icon-personal"></span>
                    <span class="side-item-name">用户</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-light">
                    <span class="iconfont icon-brush"></span>
                    <span class="side-item-name">文章</span>
                    <i class="iconfont icon-return"></i>
                </a>
                <ul class="side-treeview ">
                    <li id="side_article_list" class="waves-effect waves-light">
                        <a href="{{ route('article.index') }}" class="">
                            <span class="side-item-name">文章列表</span>
                        </a>
                    </li>
                    <li id="side_article_create" class="waves-effect waves-light">
                        <a href="{{ route('article.create') }}" data-url="{{ route('article.create') }}">
                            <span class="side-item-name">创建文章</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{--<li id="side_media_manage">--}}
                {{--<a href="{{ route('media.index') }}" class="waves-effect waves-light">--}}
                    {{--<span class="iconfont icon-duomeiti"></span>--}}
                    {{--<span class="side-item-name">媒体</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li id="side_categories_manage">
                <a href="{{ route('categories.index') }}" class="waves-effect waves-light">
                    <span class="iconfont icon-subscription"></span>
                    <span class="side-item-name">分类</span>
                </a>
            </li>
            <li id="side_tags_manage">
                <a href="{{ route('tag.index') }}" class="waves-effect waves-light">
                    <span class="iconfont icon-zhekou"></span>
                    <span class="side-item-name">标签</span>
                </a></li>
            <li id="side_links_index">
                <a href="{{ route('link.index') }}" class="waves-effect waves-light">
                    <span class="iconfont icon-accessory"></span>
                    <span class="side-item-name">链接</span>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>

    </div>

@endsection

