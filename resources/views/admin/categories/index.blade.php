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
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{--<a class="btn btn-success" href="{{ route('categories.edit', $cate['id'])}}">编辑</a>--}}
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#editCateModal"
                                                            id="{{ $cate['id'] }}" name="{{ $cate['name'] }}" onclick="editCateModal(this);">编辑
                                                    </button>
                                                </div>
                                            {{--<a class="btn btn-danger" name="{{ route('categories.destroy', $cate['id']) }}">删除</a>--}}
                                                <form class="col-sm-6" method="POST" action="{{ route('categories.destroy', $cate['id']) }}">
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
                        <!-- 模态框（Modal） -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="editCateTitle">
                                            模态框（Modal）标题
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="" method="POST" id="editForm">
                                            {{--添加csrf认证--}}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-md-3">--}}
                                                        <label class="control-label">
                                                            目录名称
                                                        </label>
                                                    {{--</div>--}}
                                                    {{--<div class="col-md-9">--}}
                                                        <input type="text" class="form-control" name="cate" placeholder="目录名称">
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <input type="submit" value="更改" class="btn btn-primary"/>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            提交更改
                                        </button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
//        function restSub() {
//            $.ajax({
//                type: "POST",
//                url:
//            })
//        }
        function editCateModal(cate){
//            console.log(cate['id']);
            $("#editCateTitle").text("编辑 " + cate.id);
            $("#editForm").attr("action", "/admin/categories/" + cate.id);
            $("#myModal").modal();
        };
    </script>
@endsection