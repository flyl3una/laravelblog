@section("header")
    <header>
        <nav id="header_id">
            <div class="nav-wrapper transparent container" style="">
                <div class="row">
                    <div class="col m8 s12">
                        <form id="article_search_form">
                            <div class="input-field">
                                <input id="search_input" type="search" required placeholder="关键字">
                                <label class="label-icon" for="search_input">
                                    <i class="iconfont icon-sousuo3 prefix"></i>
                                </label>
                                <i class="iconfont icon-guanbi3 suppix material-icons"></i>
                            </div>
                        </form>
                    </div>
                    <div class="col m4 s12">
                        <ul id="select_page" class="right">
                            <li id="index_page_id"><a href="{{ route('home.index') }}" class=" white-text">首页</a></li>
                            <li id="archive_page_id"><a href="{{ route('home.archive') }}" class="white-text">归档</a></li>
                            <li id="category_page_id"><a href="{{ route('home.category') }}" class="white-text">目录</a></li>
                            <li id="about_page_id"><a href="#" class="white-text">关于</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="parallax-container">
            <div class="container">
                <div class="parallax"><img src="/images/header.jpg"></div>

                <div class="valign-wrapper" style="height: 100%">
                    {{--<h5 class="valign">这个应该垂直居中对齐</h5>--}}
                    <div class="valign center">
                        {{--<div class="row">--}}
                        {{--<img src="/images/user.jpg" alt="" class="center-align user-img">--}}
                        {{--</div>--}}
                        <div class="row">
                            <h4>Luna's Blog</h4>
                            <p>Welcome to the small home</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

@endsection