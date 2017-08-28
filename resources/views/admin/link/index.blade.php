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
                            <input type="checkbox" id="{{ $link['id'] }}" name="cateIds">
                            <label for="{{ $link['id'] }}"></label>
                        </td>
                        <td>{{ $link['name'] }}</td>
                        <td><a href="{{$link['url']}}">{{ $link['url'] }}</a></td>
                        <td>
                            <a class="modal-a" href="#modal1" data-target="modal1"
                               data-id="{{ $link['id'] }}" data-url="{{route('link.update', $link['id'])}}"
                               data-name="{{ $link['name'] }}">编辑
                            </a>
                            <a class="delete-a" data-id="{{ $link['id'] }}">删除</a>

                            {{--<div class="col-sm-6">--}}
                                {{--<a class="btn btn-success" href="{{ route('link.edit', $link['id'])}}">编辑</a>--}}
                                {{--<button class="btn btn-success btn-edit" data-toggle="modal"--}}
                                        {{--data-target="#editLinkModal"--}}
                                        {{--id="{{ $link['id'] }}" update-url="{{route('link.update', $link['id'])}}"--}}
                                        {{--name="{{ $link['name'] }}" url="{{ $link['url'] }}">编辑--}}
                                {{--</button>--}}
                            {{--</div>--}}
                            {{--<a class="btn btn-danger" name="{{ route('categories.destroy', $cate['id']) }}">删除</a>--}}
                            <form hidden class="col-sm-6 form-only-button" method="POST"
                                  action="{{ route('link.destroy', $link['id']) }}">
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
        {{--</div>--}}
        {!! $links->render() !!}
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

        <!-- 模态框（Modal） -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h4>目录编辑</h4>
                </div>

                <form class="form" method="POST" action="{{ route('categories.create') }}">
                    {{ csrf_field() }}

                    <div class="row input-field">
                        {{--<div class="input-field col m10 s10">--}}
                        <input id="edit_cate" type="text" class="validate">
                        <label for="edit_cate">目录名称</label>
                        {{--</div>--}}
                        {{--<div class="col m2 s2">--}}

                        {{--</div>--}}
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

            setCurrentSide("side_links_index");
            $('.modal').modal();

            $(".modal-a").click(function () {
                var target = $(this).attr('data-target');
                $("#" + target).modal('open');
            });


            $("#updateSubmit").click(function () {
                $.post($("#editForm").attr('action'), {
                    id: $("#link-id").attr('name'),
                    name: $("#editLinkNameInput").val(),
                    url: $("#editLinkUrlInput").val(),
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