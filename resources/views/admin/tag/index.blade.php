@extends('admin.index')

@section('content')

    <div class="container">
        <h5>标签管理</h5>
        {{--<div class="cart z-depth-4">--}}
            <table class="table-list bordered highlight">
                <thead class="grey lighten-4">
                <tr>
                    <th class="manage-row">
                        <input type="checkbox" id="all_select">
                        <label for="all_select"></label>
                    </th>
                    <th width="70%">名称</th>
                    <th width="10%">总数</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($tags as $tag)
                    <tr>
                        <td class="select-row">
                            <input type="checkbox" id="{{ $tag['id'] }}" name="cateIds">
                            <label for="{{ $tag['id'] }}"></label>
                        </td>
                        <td>{{ $tag['name'] }}</td>
                        <td>10</td>
                        <td>
                            <a class="modal-a" href="#modal1" data-target="modal1"
                               data-id="{{ $tag['id'] }}" data-url="{{route('categories.update', $tag['id'])}}"
                               data-name="{{ $tag['name'] }}">编辑
                            </a>
                            {{--</div>--}}
                            {{--<div class="col m6 s6">--}}
                            <a class="delete-a" data-id="{{ $tag['id'] }}">删除</a>
                            {{--<a class="btn btn-success" href="{{ route('tag.edit', $tag['id'])}}">编辑</a>--}}
                            {{--<a class="btn btn-danger" name="{{ route('tag.destroy', $tag['id']) }}">删除</a>--}}
                            {{--<div class="col-sm-6">--}}
                            {{--<a class="btn btn-success" href="{{ route('tag.edit', $tag['id'])}}">编辑</a>--}}
                            {{--<button class="btn btn-success btn-edit" data-toggle="modal" data-target="#editTagModal"--}}
                            {{--id="{{ $tag['id'] }}" url="{{route('tag.update', $tag['id'])}}"--}}
                            {{--name="{{ $tag['name'] }}">编辑--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            <form hidden class="form-only-button col-sm-6" method="POST"
                                  action="{{ route('tag.destroy', $tag['id']) }}">
                                {{--更改隐身提交方法为DELETE--}}
                                <input type="hidden" name="_method" value="DELETE"/>
                                {{--添加csrf认证--}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="删除" class="btn btn-danger"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{--</div>--}}
        {!! $tags->render() !!}
        <p style="font-weight: bold">添加标签</p>
        <form class="form" method="POST" action="{{ route('tag.store') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col m10 s8">
                    <input id="add_cate" type="text" class="validate">
                    <label for="add_cate">目录名称</label>
                </div>
                <div class="col m2 s4 right-align right">
                    <button type="submit" class="waves-effect waves-green input-field-button btn btn-success"
                            value="添加">添加
                    </button>
                </div>
            </div>
        </form>
        <!-- 模态框（Modal） -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h4>标签编辑</h4>
                </div>

                <form class="form" method="POST" action="{{ route('tag.create') }}">
                    {{ csrf_field() }}

                    <div class="row input-field">
                        <input id="edit_cate" type="text" class="validate">
                        <label for="edit_cate">标签名称</label>
                    </div>
                    <input id="submit_cate_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="change_cate_input" class="waves-effect waves-green btn btn-success">更改</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function () {

            setCurrentSide("side_tags_manage");
            $('.modal').modal();

            $(".modal-a").click(function () {
                var target = $(this).attr('data-target');
                $("#" + target).modal('open');
            });


            $("#updateSubmit").click(function () {
                $.post($("#editForm").attr('action'), {
                    id: $("#tag-id").attr('name'),
                    name: $("#editTagInput").val(),
                    _token: $("#modal-token").val(),
                    _method: "PATCH",
                }, function (data, status) {
                    console.log(data);
                    console.log(status);
                    if (status == 'success') {
                        if (data.state == 0) {
                            // 刷新页面
                            history.go(0);
                        }
                    } else {
                        alert('ajax update error');
                    }

                });
            });
            $(".btn-edit").click(function () {
                $("#editTagTitle").text("编辑");
                $("#tag-id").attr('name', $(this).attr('id'));
                $("#editTagInput").val($(this).attr('name'));
                $("#editForm").attr('action', $(this).attr('url'));
                $("#myModal").modal();
            });
        });
    </script>

@endsection