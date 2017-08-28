@extends('admin.index')

@section('content')

    <div class="container">

        <h5>
            目录管理
        </h5>
        {{--<div class="card z-depth-4">--}}
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
            @foreach($cates as $cate)
                <tr>
                    <td class="select-row">
                        @if($cate['id'] != 1)
                            <input type="checkbox" id="{{ $cate['id'] }}" name="delete_cates[]"
                                   value="{{ $cate['id'] }}">
                            <label for="{{ $cate['id'] }}"></label>
                        @endif
                    </td>
                    <td>{{ $cate['name'] }}</td>
                    <td>{{ $cate['count'] }}</td>
                    <td>
                        <a class="edit-a" href="#edit_modal" data-target="edit_modal"
                           data-id="{{ $cate['id'] }}" data-submit="{{ route('categories.update', $cate['id']) }}"
                           data-name="{{ $cate['name'] }}">编辑
                        </a>
                        @if($cate['id'] != 1)
                            {{--模态框提示--}}
                            <a class="delete-a" href="#delete_modal" data-target="delete_modal"
                               data-id="{{ $cate['id'] }}" data-submit="{{ route('categories.destroy', $cate['id']) }}"
                               data-name="{{ $cate['name'] }}" data-count="{{ $cate['count'] }}">删除</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--</div>--}}
        <div class="row">
            <div class="col m3 s8 input-field">
                <select id="select_option" class="initialized">
                    <option value="0" disabled="" selected="">选择操作</option>
                    <option value="1" data-value="删除" data-submit="{{ route('article.deleteMultiple') }}">删除</option>
                </select>
            </div>
            <div class="col m2 s4">
                <button id="apply_option" type="submit" data-target="delete_multiple_modal"
                   class="waves-effect waves-light btn input-field-button">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $cates->render() !!}
            </div>
        </div>

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
                    <button type="submit" class="waves-effect waves-green input-field-button btn btn-success right"
                            value="添加">添加
                    </button>
                </div>
            </div>
        </form>
        <!-- 编辑目录模态框（Modal） -->
        <div id="edit_modal" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h6>目录编辑</h6>
                </div>
                <iframe name="target_iframe" hidden frameborder="0"></iframe>
                <form id="update_form" class="form" method="POST" target="target_iframe">
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
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="update_cate_input"
                   class="modal-action modal-close waves-effect waves-green btn btn-success">更改</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除目录模态框（Modal） -->
        <div id="delete_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除目录</h5>
                </div>
                <iframe name="target_iframe" hidden frameborder="0"></iframe>
                <form id="delete_form" class="form" method="POST" target="target_iframe">
                    {{--添加csrf认证--}}
                    {{ csrf_field() }}
                    {{--更改隐身提交方法为DELETE--}}
                    <input hidden name="_method" value="DELETE">
                    <input id="delete_cate_id" type="number" name="id" hidden>
                    <span>将要删除的目录名称为：</span>
                    <span id="delete_cate_name" class="teal-text darken-3"></span>
                    <span>。<br>该目录下包含 </span>
                    <span id="delete_cate_count" class="teal-text darken-3"></span>
                    <span> 篇文章。<br>删除后该目录下的所有文章将被移至根目录。<br>删除后该目录无法恢复，确定要删除?</span>
                    <input id="submit_cate_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_cate_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->delete_multiple_modal
        <!-- 删除目录模态框（Modal） -->
        <div id="delete_multiple_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除所选目录</h5>
                </div>
                <iframe name="target_iframe" hidden frameborder="0"></iframe>
                <form id="delete_multiple_form" class="form" method="POST" target="target_iframe">
                    {{--添加csrf认证--}}
                    {{ csrf_field() }}
                    {{--更改隐身提交方法为DELETE--}}
                    <input id="delete_multiple_cate_id" type="number" name="ids[]" hidden>
                    <span>删除后选中目录下的所有文章将被移至根目录。<br>删除后该目录无法恢复，确定要删除?</span>
                    <input id="delete_multiple_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_cate_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
    </div>


@endsection

@section('js')
    @parent
    <script>

        promptChangeResult = function (data) {
            if (data.state == 0) {
                location.reload();
            } else if (data.state == 1) {
                alert("更改失败。失败原因：\n" + data.info);
            }
        };

        promptDeleteResult = function (data) {
            if (data.state == 0) {
//                alert("更改成功");
                location.reload();
            } else if (data.state == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };

        promptAddResult = function() {
            if (data.state == 0) {
                location.reload();
            } else if (data.state == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };

        // 每一行的编辑和删除功能
        rowOption = function () {
            // 编辑
            $(".edit-a").click(function () {
                var target = $(this).data('target');
                var submit = $(this).data('submit');
                var name = $(this).data('name');
                var id = $(this).data("id");
                $("#edit_cate_id").val(id);
                $("#edit_cate_name").val(name);
                $("#update_form label").addClass('active');
                $("#update_form").attr('action', submit);
                Materialize.updateTextFields();
                $("#" + target).modal('open');
            });
            $(".delete-a").click(function () {
                var target = $(this).data('target');
                var submit = $(this).data('submit');
                var name = $(this).data('name');
                var count = $(this).data('count');
                var id = $(this).data("id");
                $("#delete_cate_id").val(id);
                $("#delete_cate_name").text(name);
                $("#delete_cate_count").text(count);
                $("#delete_form").attr('action', submit);
                $("#" + target).modal('open');
            });
        };

//        应用批量删除操作
        getOption = function() {
            var select_id = $("#select_option").data('select-id');
            var text = $("#select-options-"+select_id+">.selected>span").text();
            var opt_value = "";
            var opt_value_obj = null;
            $("#select_option>option").each(function() {
                if ($(this).data('value') == text) {
                    opt_value = $(this).val();
                    opt_value_obj = $(this);
                }
            });
            console.log(opt_value_obj.val());
            return opt_value_obj;
        };

        $(document).ready(function () {
            setCurrentSide("side_categories_manage");
//            表格行的编辑和删除操作
            rowOption();

            $("#update_cate_input").click(function () {
                $("#update_form").submit();
            });
            $("#delete_cate_input").click(function () {
                $("#delete_form").submit();
            });
            $("#apply_option").click(function () {
                var target = $(this).data('target');
                var option_obj = getOption();
                var submit = option_obj.data('submit');
                console.log(submit);
                $("#delete_multiple_form").attr('action', submit);
                $("#" + target).modal('open');
            });

            $("#apply_option").click(function () {
                var opt_value_obj = getOption();
                var opt_value = opt_value_obj.val();
                var submit = opt_value_obj.data('submit');
                var b_apply = confirm("是否确认删除所选项。\n删除后将无法恢复");
                if (!b_apply) {
                    return ;
                }
                if (opt_value == 1) {
                    $.post(submit, function() {
                        _token: {{ csrf_field() }},
                    }, function (data, status) {

                    });
                }
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