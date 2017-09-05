@section('left')
    <div class="card z-depth-2 a-article-card">
        <div class="card-content blue-grey darken-2 article-info white-text">
            <h4>
                {{ $article['title'] }}
            </h4>
            <span>{{ $article['user']['name'] }}
                </span>
            <span>/</span>
            <span>
                    {{ $article['cate']['name'] }}
                </span>
            <span>/</span>
            <span>{{ $article['updated_at'] }}</span>
        </div>
        <div id="article_markdown" hidden data-markdown="{{ $article['markdown'] }}"></div>
        <div id="article_content" class="article_html card-content">
        </div>
        <div class="card-action">
            <div class="row">
                <div class="col m12 s12">
                    @foreach($article['tags'] as $oneTag)
                        <div class="chip grey lighten-2">{{ $oneTag['name'] }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent

    <script src="/vendors/editor.md/lib/marked.min.js"></script>
    <script src="/vendors/editor.md/lib/prettify.min.js"></script>

    <script src="/vendors/editor.md/lib/raphael.min.js"></script>
    <script src="/vendors/editor.md/lib/underscore.min.js"></script>
    <script src="/vendors/editor.md/lib/sequence-diagram.min.js"></script>
    <script src="/vendors/editor.md/lib/flowchart.min.js"></script>
    <script src="/vendors/editor.md/lib/jquery.flowchart.min.js"></script>
    <script src="/vendors/editor.md/editormd.min.js"></script>
    <script type="text/javascript">
        var text = $("#article_markdown").data('markdown');
//        $("#append-test").html(text);
        var testEditormdView = editormd.markdownToHTML("article_content", {
            markdown        : text ,//+ "\r\n" + $("#append-test").text(),
            htmlDecode      : "style,script,iframe",  // you can filter tags decode 开启 HTML 标签解析，为了安全性，默认不开启
            //toc             : false,
            tocm            : true,    // Using [TOCM]
            //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
            //gfm             : false,
//            tocDropdown     : true,
//             markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
//        $("#article_content").html(testEditormdView);
    </script>

@endsection