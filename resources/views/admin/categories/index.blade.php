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
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr><th width="80%">名称</th><th width="20%">操作</th></tr>
                                @foreach($cates as $cate)
                                    <tr>
                                        <td>{{ $cate['name'] }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('categories.edit', $cate['id'])}}">编辑</a>
                                            <a class="btn btn-danger" name="{{ route('categories.destroy', $cate['id']) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $cates->render() !!}
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