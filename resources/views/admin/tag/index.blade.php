@extends("admin.layout")
@extends('admin.header')
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
                                            <div class="col-sm-6">
                                                {{--<a class="btn btn-success" href="{{ route('tag.edit', $tag['id'])}}">编辑</a>--}}
                                                <button class="btn btn-success btn-edit" data-toggle="modal" data-target="#editTagModal"
                                                        id="{{ $tag['id'] }}" url="{{route('tag.update', $tag['id'])}}" name="{{ $tag['name'] }}">编辑
                                                </button>
                                            </div>
                                            <form class="form-only-button col-sm-6" method="POST" action="{{ route('tag.destroy', $tag['id']) }}">
                                                {{--更改隐身提交方法为DELETE--}}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                {{--添加csrf认证--}}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" value="删除" class="btn btn-danger"/>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $tags->render() !!}
                        <form class="form" method="POST" action="{{ route('tag.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="control-label ">添加目录</div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="tagName" class="form-control" placeholder="目录名称">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" class="form-control btn btn-success" value="添加">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- 模态框（Modal） -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="editCateTitle">
                                            标签编辑
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" method="POST" id="editForm">
                                            {{--添加csrf认证--}}
                                            <input hidden id="modal-token" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label id="tag-id" class="control-label">
                                                    标签名称
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <input id="editTagInput" type="text" class="form-control" name="tagName" placeholder="目录名称">
                                            </div>
                                            {{--<input type="submit" value="更改" class="btn btn-primary"/>--}}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                        </button>
                                        <button id="updateSubmit" type="submit" class="btn btn-primary" onclick="">
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
@endsection

@section('js')

    <script>
        $(document).ready(function(){
            $("#updateSubmit").click(function(){
                $.post($("#editForm").attr('action'), {
                    id : $("#tag-id").attr('name'),
                    name : $("#editTagInput").val(),
                    _token: $("#modal-token").val(),
                    _method: "PATCH",
                },function(data, status) {
                    console.log(data);
                    console.log(status);
                    if(status == 'success') {
                        if (data.state == 0) {
                            // 刷新页面
                            history.go(0);
                        }
                    } else {
                        alert('ajax update error');
                    }

                });
            });
            $(".btn-edit").click(function(){
                $("#editTagTitle").text("编辑");
                $("#tag-id").attr('name', $(this).attr('id'));
                $("#editTagInput").val($(this).attr('name'));
                $("#editForm").attr('action', $(this).attr('url'));
                $("#myModal").modal();
            });
        });
    </script>

@endsection