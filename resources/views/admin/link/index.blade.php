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
                                    <tr><th width="25%">名称</th><th width="55%">链接</th><th width="20%">操作</th></tr>
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{ $link['name'] }}</td>
                                            <td><a href="{{$link['url']}}">{{ $link['url'] }}</a></td>
                                            <td>
                                                <div class="col-sm-6">
                                                    {{--<a class="btn btn-success" href="{{ route('link.edit', $link['id'])}}">编辑</a>--}}
                                                    <button class="btn btn-success btn-edit" data-toggle="modal" data-target="#editLinkModal"
                                                            id="{{ $link['id'] }}" update-url="{{route('link.update', $link['id'])}}"
                                                            name="{{ $link['name'] }}" url="{{ $link['url'] }}">编辑
                                                    </button>
                                                </div>
                                                {{--<a class="btn btn-danger" name="{{ route('categories.destroy', $cate['id']) }}">删除</a>--}}
                                                <form class="col-sm-6 form-only-button" method="POST" action="{{ route('link.destroy', $link['id']) }}">
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
                        {!! $links->render() !!}
                        <form class="form" method="post" action="{{ route('link.store') }}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="control-label ">添加链接</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="链接名称" name="linkName">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" placeholder="链接url地址" name="linkUrl">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="form-control btn btn-primary">添加</button>
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
                                        <h4 class="modal-title" id="editLinkTitle">
                                            友情链接编辑
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" method="POST" id="editForm">
                                            {{--添加csrf认证--}}
                                            <input hidden id="modal-token" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label id="link-name-id" class="control-label">
                                                    链接名称
                                                </label>
                                                <input id="editLinkNameInput" type="text" class="form-control" name="linkName" placeholder="目录名称">
                                            </div>
                                            <div class="form-group">
                                                <label id="link-url-id" class="control-label">
                                                    链接地址
                                                </label>
                                                <input id="editLinkUrlInput" type="url" class="form-control" name="linkUrl" placeholder="链接地址">
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
                    id : $("#link-id").attr('name'),
                    name : $("#editLinkNameInput").val(),
                    url: $("#editLinkUrlInput").val(),
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
                $("#editLinkTitle").text("编辑");
                $("#tag-id").attr('name', $(this).attr('id'));
                $("#editLinkNameInput").val($(this).attr('name'));
                $('#editLinkUrlInput').val($(this).attr('url'));
                $("#editForm").attr('action', $(this).attr('update-url'));
                $("#myModal").modal();
            });
        });
    </script>

@endsection