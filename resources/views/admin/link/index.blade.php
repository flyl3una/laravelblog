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
                                    <tr><th width="25%">名称</th><th width="55%">链接</th><th width="20%">操作</th></tr>
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{ $link['name'] }}</td>
                                            <td><a href="{{$link['url']}}">{{ $link['url'] }}</a></td>
                                            <td>
                                                <button class="btn btn-success">编辑</button>
                                                <button class="btn btn-danger">删除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $links->render() !!}
                        <form class="form">
                            <div class="form-group">
                                <div class="control-label ">添加链接</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="链接名称">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" placeholder="链接url地址">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="form-control btn btn-success">添加</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection