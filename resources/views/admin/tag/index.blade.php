@extends("admin.layout")
@extends("admin.sidebar")

@extends("layouts.css")
@extends("layouts.js")

@section('content')

    <div class="admin-content">
        <div class="container">
            <div class="content-panel">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        文章列表
                    </div>
                    <div class="panel-body">
                        <ul class="list-group ul-list">
                            @foreach($tags as $tag)

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-11 li-name">{{ $tag['name'] }}</div>
                                        <button id="delete-cate-{{$tag['id']}}" class="btn btn-danger">删除</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {!! $tags->render() !!}
                        <div class="form-group margin-top-50">
                            <div class="control-label ">添加目录</div>

                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="目录名称">
                                </div>
                                <div class="col-md-2">
                                    <button class="form-control btn btn-success">添加</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection