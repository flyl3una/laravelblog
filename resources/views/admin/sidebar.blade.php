@section('sidebar')

<div class="side-left">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/admin/user" class="">
            用户信息
            </a>
        </li>
    </ul>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('article.index') }}" class="">
            文章列表
            </a>
        </li>
        <li class="list-group-item text-center">
            <a href="{{ route('article.create') }}" class="">
                创建文章
            </a>
        </li>
    </ul>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/admin/categroies" class="">分类管理</a>
        </li>
    </ul>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="#">标签管理</a>
        </li>
    </ul>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="#">友情连接</a>
        </li>
    </ul>
</div>

@endsection

