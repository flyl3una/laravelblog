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
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag['name'] }}</td>
                                        <td>
                                            {{--<a class="btn btn-success" href="{{ route('tag.edit', $tag['id'])}}">编辑</a>--}}
                                            {{--<a class="btn btn-danger" name="{{ route('tag.destroy', $tag['id']) }}">删除</a>--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a class="btn btn-success" href="{{ route('tag.edit', $tag['id'])}}">编辑</a>
                                                </div>
                                                <form class="col-sm-6" method="POST" action="{{ route('tag.destroy', $tag['id']) }}">
                                                    {{--更改隐身提交方法为DELETE--}}
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    {{--添加csrf认证--}}
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" value="删除" class="btn btn-danger"/>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $tags->render() !!}
                        <div class="form-group margin-top-50">
                            <div class="control-label ">添加目录</div>

                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="标签名称">
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