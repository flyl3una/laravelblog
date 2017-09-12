@extends('admin.index')

@section('content')

    <div class="container">
        <h5>页面列表</h5>
        <div class="row">
            <ul class="select-status">
                <li><a class="active" href="#">全部 （3）</a>
                </li>
                <li>|</li>
                <li><a href="#">已发布 ( 3 )</a></li>
                <li>|</li>
                <li><a href="#">草稿 ( 2 )</a></li>
            </ul>
        </div>
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
                        <a href="">查看</a>
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

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            setCurrentSide("side_page_list");
        });
    </script>
@endsection