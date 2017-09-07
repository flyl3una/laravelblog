{{--@extends("admin.layout")--}}
{{--@extends("admin.header")--}}
{{--@extends("admin.sidebar")--}}

{{--@extends("admin.footer")--}}

{{--@extends("admin.css")--}}
{{--@extends("admin.js")--}}
@extends("admin.index")

@section('content')
    <div class="container">
        <h5>文章列表</h5>
        <div class="row">
            {{--<div class="col m12 s12">--}}
                <ul class="select-status">
                <li><a @if ($currentTab == -1) class="active" @endif href="{{ route('article.index') }}">全部 （3）</a>
                </li>
                <li>|</li>
                <li><a @if ($currentTab == 0) class="active" @endif href="{{ route('article.index', 'state=0') }}">已发布 ( 3 )</a></li>
                <li>|</li>
                <li><a @if ($currentTab == 1) class="active" @endif href="{{ route('article.index', 'state=1') }}">草稿 ( 2 )</a></li>
                </ul>
                {{--<ul id="tabs_id" class="tabs grey lighten-5">--}}
                    {{--<li class="tab"><a class="active" href="#">全部 ( 3 ) </a>--}}
                    {{--<li class="tab"><a href="#">已发布 ( 3 )</a></li>--}}
                    {{--<li class="tab"><a href="#">草稿 ( 2 )</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        </div>
        {{--<div class="card z-depth-4">--}}

        <table class="bordered highlight table-list">
            <thead class="grey lighten-4">
            <tr>
                <th class="manage-row">
                    <input type="checkbox" id="all_select">
                    <label for="all_select"></label>
                </th>
                <th width="25%">文章标题</th>
                <th width="10%">文章作者</th>
                <th width="10%">文章分类</th>
                <th width="25%">文章标签</th>
                <th width="10%">赞 / 查看</th>
                <th width="20%">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articleList as $article)
                <tr>
                    <td class="select-row">
                        <input type="checkbox" id="{{ $article['id'] }}" class="delete-checkbox"
                               value="{{ $article['id'] }}">
                        <label for="{{ $article['id'] }}"></label>
                    </td>
                    <td>
                        <a>{{ $article['title'] }}</a>
                    </td>
                    <td><span>{{ $article['user'] }}</span></td>
                    <td><span>{{ $article['cate'] }}</span></td>
                    <td>
                        @foreach($article['tags'] as $tag)
                            <div class="chip-tag chip left">{{ $tag }}</div>
                        @endforeach
                    </td>

                    <td><span>5 / {{ $article['click_count'] }}</span></td>
                    <td>

                        <a href="{{ route('home.show', $article['id']) }}">查看</a>
                        <a href="{{ route('article.edit', $article['id']) }}">编辑</a>
                        <a class="delete-a" href="#delete_modal" data-target="delete_modal"
                           data-id="{{ $article['id'] }}" data-submit="{{ route('article.moveToTrash') }}"
                           data-title="{{ $article['title'] }}">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--</div>--}}
        <div class="row">
            <div class="col m3 s8 input-field">
                <select id="select_option" class="initialized">
                    <option value="" disabled="" selected="">选择操作</option>
                    <option value="1" data-value="删除" data-target="delete_multiple_modal">删除</option>
                </select>
            </div>
            <div class="col m2 s4">
                <button id="apply_option" type="submit" class="waves-effect waves-light btn input-field-button"
                        value="应用">应用
                </button>
            </div>
            <div class="col m7 s12 right right-align">
                {!! $articleAll->render() !!}
            </div>
        </div>

        <!-- 删除单个文章模态框（Modal） -->
        <div id="delete_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除文章</h5>
                </div>
                <form id="delete_form" class="form" method="POST" target="target_iframe"
                      action="{{ route('article.moveToTrash') }}">
                    {{--添加csrf认证--}}
                    {{ csrf_field() }}
                    <input id="delete_id" type="number" name="ids" hidden>
                    <span>你选中的文章是 </span>
                    <span id="delete_title"></span>
                    <span> 。<br>删除后该文章将被移至回收站，可以在回收站找回或者彻底删除。<br>是否删除?</span>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_article_input"
                   class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
        <!-- 删除多个文章模态框（Modal） -->
        <div id="delete_multiple_modal" class="modal" style="width: 400px">
            <div class="modal-content">
                <div class="row">
                    <h5>删除所选文章</h5>
                </div>
                <form id="delete_multiple_form" class="form" method="POST" target="target_iframe"
                      action="{{ route('article.moveToTrash') }}">
                    {{--添加csrf认证--}}
                    {{--{{ csrf_field() }}--}}
                    <input id="token_id" type="text" name="_token" hidden value="{{ csrf_token() }}">
                    <input id="delete_multiple_ids" type="text" name="ids" hidden>
                    <span>你选中了 </span>
                    <span id="delete_multiple_count" class="teal-text darken-3"></span>
                    <span> 篇文章。<br>删除后该文章将被移至回收站，可以在回收站找回或者彻底删除。<br>是否删除?</span>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-light btn grey lighten-2">取消</a>
                <a id="delete_multiple_cate_input"
                   class="modal-action modal-close waves-effect waves-red btn red darken-2">删除</a>
            </div>
        </div>
        <!--（Modal）End -->
    </div>
@endsection


@section("js")
    @parent
    <script>

        promptDeleteResult = function (data) {
            if (data.code == 0) {
                console.log(data.info);
                location.reload();
            } else if (data.code == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };
        promptDeleteMultipleResult = function (data) {
            if (data.code == 0) {
                console.log(data.info);
                location.reload();
            } else if (data.code == 1) {
                alert("删除失败。失败原因：\n" + data.info);
            }
        };

        rowOption = function () {
            $(".delete-a").click(function () {
                var target = $(this).data('target');
                var submit = $(this).data('submit');
                var title = $(this).data('title');
                var id = $(this).data("id");
                $("#delete_id").val(id);
                $("#delete_title").text(title);
                $("#delete_form").attr('action', submit);
                $("#" + target).modal('open');
            });
        };

        //        获取应用批量删除操作的下拉选项选中的对象
        getOption = function () {
            var select_id = $("#select_option").data('select-id');
            var text = $("#select-options-" + select_id + ">.selected>span").text();
            var opt_value = "";
            var opt_value_obj = null;
            $("#select_option>option").each(function () {
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
            $(".delete-checkbox").each(function () {
                if ($(this).is(":checked")) {
                    select_ids.push($(this).val());
                }
            });
            return select_ids;
        };


        deleteMultiple = function () {
            $("#apply_option").click(function () {

                var option_obj = getOption();
                var target = option_obj.data('target');
                var option_value = option_obj.val();
                if (option_value == 1) {
                    var select_ids = getSelectIds();
                    $("#delete_multiple_count").text(select_ids.length);
                    $("#delete_multiple_ids").val(select_ids.join(','));
                    $("#" + target).modal('open');
                } else {
                    console.log("没有对应选项的操作");
                }
            });
//                        点击删除按钮
            $("#delete_multiple_cate_input").click(function () {
                $.post($("#delete_multiple_form").attr('action'), {
                        ids: getSelectIds().join(','),
                        _token: $("#token_id").val(),
                        option_number: 1
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

        selectTab = function(id) {
            $('#select_page>li').removeClass('active');
            $('#'+id).addClass('active');
        };

        $(document).ready(function () {
            setCurrentSide("side_article_list");
            allSelectColumn();
            // 单独删除一行
            rowOption();
            deleteMultiple();

            $("#delete_article_input").click(function () {
                $("#delete_form").submit();
            });



        });
    </script>
@endsection
