@extends('admin.index')

@section('content')

    <div class="container">

        <h5>
            目录管理
        </h5>
        <div class="card z-depth-4">
            <table class="table-list bordered highlight">
                <thead class="grey lighten-4">
                <tr>
                    <th class="manage-column">
                        <input type="checkbox" id="all">
                        <label for="all"></label>
                    </th>
                    <th width="70%">名称</th>
                    <th width="10%">总数</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cates as $cate)
                    <tr>
                        <td>
                            <input type="checkbox" id="{{ $cate['id'] }}" name="cateIds">
                            <label for="{{ $cate['id'] }}"></label>
                        </td>
                        <td>{{ $cate['name'] }}</td>
                        <td>10</td>
                        <td>
                            <a class="edit-a" href="#modal1" data-target="cate_modal"
                               data-id="{{ $cate['id'] }}" data-submit="{{ route('categories.update', $cate['id']) }}"
                               data-name="{{ $cate['name'] }}">编辑
                            </a>
                            <a class="delete-a" data-id="{{ $cate['id'] }}">删除</a>
                            <form id="delete-{{ $cate['id'] }}" hidden class="col s6 m6 form-only-button" method="POST"
                                  action="{{ route('categories.destroy', $cate['id']) }}">
                                更改隐身提交方法为DELETE
                                <input type="hidden" name="_method" value="DELETE"/>
                                添加csrf认证
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="删除" class="btn btn-danger"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col m3 s8 input-field">
                <select class="initialized">
                    <option value="" disabled="" selected="">选择操作</option>
                    <option>
                        删除
                    </option>
                </select>
            </div>
            <div class="col m2 s4">
                <button type="submit" class="waves-effect waves-light btn input-field-button" value="应用">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $cates->render() !!}
            </div>
        </div>
        {{--{!! $cates->render() !!}--}}

        <p style="font-weight: bold">添加目录</p>
        <iframe hidden name="target_iframe"></iframe>
        <form class="form" method="POST" action="{{ route('categories.store') }}" target="target_iframe">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col m10 s8">
                    <input id="add_cate" type="text" name="cateName" class="validate">
                    <label for="add_cate">目录名称</label>
                </div>
                <div class="col m2 s4 right-align right">
                    {{--<input type="submit" class="waves-effect waves-green input-field-button btn btn-success" value="添加">--}}
                    <button type="submit" class="waves-effect waves-green input-field-button btn btn-success right"
                            value="添加">添加
                    </button>
                </div>
            </div>
        </form>
        <!-- 模态框（Modal） -->
        <div id="cate_modal" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h4>目录编辑</h4>
                </div>

                <form id="update_form" class="form" method="POST">
                    {{ csrf_field() }}
                    <input hidden name="_method" value="PUT">

                    <input id="edit_cate_id" type="number" name="id" hidden>
                    <div class="row input-field">
                        <input id="edit_cate_name" name="name" type="text" class="validate">
                        <label for="edit_cate">目录名称</label>
                    </div>
                    <input id="submit_cate_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="change_cate_input" class="modal-action modal-close waves-effect waves-green btn btn-success">更改</a>
            </div>
        </div>
        <!--（Modal）End -->
    </div>


@endsection

@section('js')
    @parent
    <script>

        promptChangeResult = function(data) {
            if(data.state == 0) {
                alert("更改成功");
                location.reload();
            }else if(data.state == 1) {
                alert("更改失败。失败原因："+data.info);
            }
        };

        $(document).ready(function () {
            setCurrentSide("side_categories_manage");


            $(".edit-a").click(function () {
                var target = $(this).attr('data-target');
                var submit = $(this).attr('data-submit');
                var name = $(this).attr('data-name');
                var id = $(this).attr("data-id");
                $("#edit_cate_id").val(id);
                $("#edit_cate_name").val(name);
                $("#update_form label").addClass('active');
                $("#update_form").attr('action', submit);
                $("#" + target).modal('open');
            });

            $("#change_cate_input").click(function() {
                $("#update_form").submit();
            });


//            $('#modal1').modal('open');
//            $("#updateSubmit").click(function () {
////        console.log('xx');
////        $.ajax({
////            type: "POST",
////            url: $("#editForm").attr('action'),
////            contentType: "application/json;charset=utf-8",
////            dataType: "json",
////            success: function(data) {
////                console.log(data);
////            },
////            error: function(data) {
////                alert('ajax error');
////            }
////        });
//                $.post($("#editForm").attr('action'), {
//                    id: $("#cate-id").attr('name'),
//                    name: $("#editCateInput").val(),
//                    _token: $("#modal-token").val(),
//                    _method: "PATCH",
//                }, function (data, status) {
//                    console.log(data);
//                    console.log(status);
//                    if (status == 'success') {
//                        if (data.state == 0) {
//                            // 刷新页面
//                            history.go(0);
//                        }
//                    } else {
//                        alert('ajax update error');
//                    }
//
//                });
//            });
//            $(".btn-edit").click(function () {
////                $("#editCateTitle").text("编辑");
//                $("#cate-id").attr('name', $(this).attr('id'));
//                $("#editCateInput").val($(this).attr('name'));
//                $("#editForm").attr('action', $(this).attr('url'));
//                $("#myModal").modal();
//            });
        });
    </script>

@endsection