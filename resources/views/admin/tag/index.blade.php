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
                            <input type="checkbox" id="{{ $tag['id'] }}" class="delete-checkbox" name="tagIds"
                                   value="{{ $tag['id'] }}">
                            <label for="{{ $tag['id'] }}"></label>
                        </td>
                        <td>{{ $tag['name'] }}</td>
                        <td>{{ $tagCount[$tag['id']] }}</td>
                        <td>
                            <a class="edit-a" href="#edit_modal" data-target="edit_modal"
                               data-id="{{ $tag['id'] }}" data-submit="{{ route('tag.update', $tag['id']) }}"
                               data-name="{{ $tag['name'] }}">编辑
                            </a>
                            {{--模态框提示--}}
                            <a class="delete-a" href="#delete_modal" data-target="delete_modal"
                               data-id="{{ $tag['id'] }}" data-submit="{{ route('tag.destroy', $tag['id']) }}"
                               data-name="{{ $tag['name'] }}" data-count="{{ $tag['count'] }}">删除</a>

                            {{--<form hidden class="form-only-button col-sm-6" method="POST"--}}
                                  {{--action="{{ route('tag.destroy', $tag['id']) }}">--}}
                                {{--更改隐身提交方法为DELETE--}}
                                {{--<input type="hidden" name="_method" value="DELETE"/>--}}
                                {{--添加csrf认证--}}
                                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                {{--<input type="submit" value="删除" class="btn btn-danger"/>--}}
                            {{--</form>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{--</div>--}}
        {{--{!! $tags->render() !!}--}}
        <div class="row">
            <div class="col m3 s8 input-field">
                <select id="select_option" class="initialized">
                    <option value="0" disabled="" selected="">选择操作</option>
                    <option value="1" data-value="删除" data-target="delete_multiple_modal">删除</option>
                </select>
            </div>
            <div class="col m2 s4">
                <button id="apply_option" type="submit" class="waves-effect waves-light btn input-field-button">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $tags->render() !!}
            </div>
        </div>
        <p style="font-weight: bold">添加标签</p>
        <form class="form" method="POST" action="{{ route('tag.store') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col m10 s8">
                    <input id="add_tag" type="text" class="validate" name="name">
                    <label for="add_tag">标签名称</label>
                </div>
                <div class="col m2 s4 right-align right">
                    <button type="submit" class="waves-effect waves-green input-field-button btn btn-success"
                            value="添加">添加
                    </button>
                </div>
            </div>
        </form>

        <!-- 编辑标签模态框（Modal） -->
        <div id="edit_modal" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h6>标签编辑</h6>
                </div>

                <form id="update_form" class="form" method="POST" target="target_iframe">
                    {{ csrf_field() }}
                    <input hidden name="_method" value="PUT">
                    <input id="edit_tag_id" type="number" name="id" hidden>
                    <div class="row input-field">
                        <input id="edit_tag_name" name="name" type="text" class="validate">
                        <label for="edit_tag">标签名称</label>
                    </div>
                    <input id="submit_tag_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="update_tag_input"
                   class="modal-action modal-close waves-effect waves-green btn btn-success">更改</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除单个标签模态框（Modal） -->
        <div id="delete_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除标签</h5>
                </div>
                <form id="delete_form" class="form" method="POST" target="target_iframe"
                      action="{{ route('tag.deleteMultiple') }}">
                    {{--添加csrf认证--}}
                    {{ csrf_field() }}
                    {{--更改隐身提交方法为DELETE--}}
                    {{--<input hidden name="_method" value="DELETE">--}}
                    {{ method_field('DELETE') }}
                    <input id="delete_tag_id" type="number" name="ids[]" hidden>
                    <span>你选中的标签是 </span>
                    <span id="delete_tag_name"></span>
                    <span>。<br>该标签下包含 </span>
                    <span id="delete_tag_count" class="teal-text darken-3"></span>
                    <span> 篇文章。<br>删除后该标签下的所有文章将被移至根标签。<br>删除后该标签无法恢复，确定要删除?</span>
                    <input id="submit_tag_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_tag_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除多个标签模态框（Modal） -->
        <div id="delete_multiple_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除所选标签</h5>
                </div>
                <form id="delete_multiple_form" class="form" method="POST" target="target_iframe" action="{{ route('tag.deleteMultiple') }}">
                    {{--添加csrf认证--}}
                    {{--{{ csrf_field() }}--}}
                    <input id="token_id" type="text" name="_token" hidden value="{{ csrf_token() }}">
                    <input id="delete_multiple_tag_ids" type="text" name="ids" hidden>
                    <span>你选中了 </span>
                    <span id="delete_multiple_tag_count" class="teal-text darken-3"></span>
                    <span> 个标签。<br>删除后选中标签下的所有文章将被移至根标签。<br>删除后该标签无法恢复，确定要删除?</span>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_multiple_tag_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
    </div>
@endsection

@section('js')
    @parent
    <script>
        promptChangeResult = function (data) {
            if (data.code == 0) {
                location.reload();
            } else if (data.code == 1) {
                alert("更改失败。失败原因：\n" + data.info);
            }
        };

        promptDeleteResult = function (data) {
            if (data.code == 0) {
                console.log(data.info);
                location.reload();
            } else if (data.code == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };

        promptDeleteMultipleResult = function(data) {
            if (data.code == 0) {
                console.log(data.info);
                location.reload();
            } else if (data.code == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };
        rowOption = function () {
            // 编辑
            $(".edit-a").click(function () {
                var target = $(this).data('target');
                var submit = $(this).data('submit');
                var name = $(this).data('name');
                var id = $(this).data("id");
                $("#edit_tag_id").val(id);
                $("#edit_tag_name").val(name);
                $("#update_form label").addClass('active');
                $("#update_form").attr('action', submit);
                Materialize.updateTextFields();
                $("#" + target).modal('open');
            });
            // 删除
            $(".delete-a").click(function () {
                var target = $(this).data('target');
                var submit = $(this).data('submit');
                var name = $(this).data('name');
                var count = $(this).data('count');
                var id = $(this).data("id");
                $("#delete_tag_id").val(id);
                $("#delete_tag_name").text(name);
                $("#delete_tag_count").text(count);
                $("#delete_form").attr('action', submit);
                $("#" + target).modal('open');
            });
        };

        deleteMultiple = function() {
            $("#apply_option").click(function () {

                var option_obj = getOption();
                var target = option_obj.data('target');
                var option_value = option_obj.val();
                if (option_value == 1) {
                    var select_ids = getSelectIds();
                    $("#delete_multiple_tag_count").text(select_ids.length);
                    $("#delete_multiple_tag_ids").val(select_ids.join(','));
                    $("#" + target).modal('open');
                } else {
                    console.log("没有对应选项的操作");
                }
            });
//                        点击删除按钮
            $("#delete_multiple_tag_input").click(function () {
                $.post($("#delete_multiple_form").attr('action'), {
                        ids: getSelectIds().join(','),
                        _token: $("#token_id").val()
                    }, function (data, status) {
                        console.log(data);
                        console.log(status);
                        if (status == 'success') {
                            promptDeleteMultipleResult(data);
                        } else {
                            alert('ajax update error');
                        }
                    },
                    'json');
            });
        };

        //        获取应用批量删除操作的下拉选项选中的对象
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
            return opt_value_obj;
        };

        //        获取表格中选中的行id数组
        getSelectIds = function () {
            var select_ids = new Array();
            $(".delete-checkbox").each(function() {
                if ($(this).is(":checked")) {
                    select_ids.push($(this).val());
                }
            });
            return select_ids;
        };

        $(document).ready(function () {

            setCurrentSide("side_tags_manage");
            allSelectColumn();
            rowOption();
            deleteMultiple();

            $("#update_tag_input").click(function () {
                $("#update_form").submit();
            });
            $("#delete_tag_input").click(function () {
                $("#delete_form").submit();
            });
        });
    </script>

@endsection