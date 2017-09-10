@extends("admin.index")

@section('content')

    <div class="container">
        <h5>友情链接</h5>
        {{--<div class="cart z-depth-4">--}}
            <table class="table-list bordered highlight">
                <thead class="grey lighten-4">
                <tr>
                    <th class="manage-row">
                        <input type="checkbox" id="all_select">
                        <label for="all_select"></label>
                    </th>
                    <th width="25%">名称</th>
                    <th width="55%">链接</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <td class="select-row">
                            <input type="checkbox" id="{{ $link['id'] }}" class="delete-checkbox" name="linkIds"
                            value="{{ $link['id'] }}">
                            <label for="{{ $link['id'] }}"></label>
                        </td>
                        <td>{{ $link['name'] }}</td>
                        <td><a href="{{$link['url']}}">{{ $link['url'] }}</a></td>
                        <td>
                            <a class="edit-a" href="#edit_modal" data-target="edit_modal"
                               data-id="{{ $link['id'] }}" data-submit="{{ route('link.update', $link['id']) }}"
                               data-name="{{ $link['name'] }}" data-url="{{ $link['url'] }}">编辑
                            </a>
                            {{--模态框提示--}}
                            <a class="delete-a" href="#delete_modal" data-target="delete_modal"
                               data-id="{{ $link['id'] }}" data-submit="{{ route('link.destroy', $link['id']) }}"
                               data-name="{{ $link['name'] }}" data-url="{{ $link['url'] }}">删除</a>
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
                    <option value="1" data-value="删除" data-target="delete_multiple_modal">删除</option>
                </select>
            </div>
            <div class="col m2 s4">
                <button id="apply_option" type="submit" class="waves-effect waves-light btn input-field-button">应用</button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $links->render() !!}
            </div>
        </div>
        <p style="font-weight: bold">添加链接</p>
        <form class="form" method="post" action="{{ route('link.store') }}">
            {{csrf_field()}}
            <div class="row ">
                <div class="input-field col m4 s12">
                    <input id="link_name" type="text" name="linkName">
                    <label for="link_name">链接名称</label>
                </div>
                <div class="input-field col m6 s12">
                    <input id="link_url" type="url" name="linkUrl">
                    <label for="link_url">链接url地址</label>
                </div>
                <div class="col m2 s12">
                    <button type="submit" class="waves-effect waves-green input-field-button btn btn-success right">添加</button>
                </div>
            </div>
        </form>

        <!-- 编辑链接模态框（Modal） -->
        <div id="edit_modal" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h6>链接编辑</h6>
                </div>

                <form id="update_form" class="form" method="POST" target="target_iframe">
                    {{ csrf_field() }}
                    <input hidden name="_method" value="PUT">
                    <input id="edit_link_id" type="number" name="id" hidden>
                    <div class="row input-field">
                        <input id="edit_link_name" name="name" type="text" class="validate">
                        <label for="edit_link_name">链接名称</label>
                    </div>
                    <div class="row input-field">
                        <input id="edit_link_url" name="name" type="text" class="validate">
                        <label for="edit_link_url">链接地址</label>
                    </div>
                    <input id="submit_link_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="update_link_input"
                   class="modal-action modal-close waves-effect waves-green btn btn-success">更改</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除单个链接模态框（Modal） -->
        <div id="delete_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除链接</h5>
                </div>
                <form id="delete_form" class="form" method="POST" target="target_iframe"
                      action="{{ route('link.deleteMultiple') }}">
                    {{--添加csrf认证--}}
                    {{ csrf_field() }}
                    {{--更改隐身提交方法为DELETE--}}
                    {{ method_field('DELETE') }}
                    <input id="delete_link_id" type="number" name="ids[]" hidden>
                    <span>你选中的链接名称是 </span>
                    <span id="delete_link_name"></span>
                    <span>。<br>该链接地址是 </span>
                    <span id="delete_link_url" class="teal-text darken-3"></span>
                    <span> 。<br>删除后该链接无法恢复，确定要删除?</span>
                    <input id="submit_link_btn" type="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_link_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除多个链接模态框（Modal） -->
        <div id="delete_multiple_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除所选链接</h5>
                </div>
                <form id="delete_multiple_form" class="form" method="POST" target="target_iframe" action="{{ route('link.deleteMultiple') }}">
                    {{--添加csrf认证--}}
                    {{--{{ csrf_field() }}--}}
                    <input id="token_id" type="text" name="_token" hidden value="{{ csrf_token() }}">
                    <input id="delete_multiple_link_ids" type="text" name="ids" hidden>
                    <span>你选中了 </span>
                    <span id="delete_multiple_link_count" class="teal-text darken-3"></span>
                    <span> 个链接。<br>删除后该链接无法恢复，确定要删除?</span>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_multiple_link_input" class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
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
                var url = $(this).data('url');
                var id = $(this).data("id");
                $("#edit_link_id").val(id);
                $("#edit_link_name").val(name);
                $("#edit_link_url").val(url);
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
                var url = $(this).data('url');
                var id = $(this).data("id");
                $("#delete_link_id").val(id);
                $("#delete_link_name").text(name);
                $("#delete_link_url").text(url);
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
                    $("#delete_multiple_link_count").text(select_ids.length);
                    $("#delete_multiple_link_ids").val(select_ids.join(','));
                    $("#" + target).modal('open');
                } else {
                    console.log("没有对应选项的操作");
                }
            });
//                        点击删除按钮
            $("#delete_multiple_link_input").click(function () {
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

            setCurrentSide("side_links_index");
            allSelectColumn();

            rowOption();
            deleteMultiple();

            $("#update_link_input").click(function () {
                $("#update_form").submit();
            });
            $("#delete_link_input").click(function () {
                $("#delete_form").submit();
            });
        });
    </script>

@endsection