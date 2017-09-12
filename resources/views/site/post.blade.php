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
            <span>{{ $article['published_at'] }}</span>
        </div>
        <div id="article_markdown" hidden data-markdown="{{ $article['markdown'] }}"></div>
        <div id="article_html" hidden data-html="{{ $article['html'] }}"></div>
        <div id="article_content" class="markdown-body editormd-preview-container editormd-html-preview">
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
    <script src="/vendors/editor.md/lib/prettify.min.js"></script>
    <script src="/vendors/editor.md/lib/codemirror/codemirror.min.js"></script>
    <script src="/vendors/editor.md/lib/raphael.min.js"></script>
    <script src="/vendors/editor.md/lib/underscore.min.js"></script>
    <script src="/vendors/editor.md/lib/sequence-diagram.min.js"></script>
    <script src="/vendors/editor.md/lib/flowchart.min.js"></script>
    <script src="/vendors/editor.md/lib/jquery.flowchart.min.js"></script>
    <script src="/vendors/editor.md/lib/marked.min.js"></script>
    <script src="https://cdn.bootcss.com/KaTeX/0.8.3/katex.min.js"></script>

    <script src="/vendors/editor.md/editormd.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            var text = $("#article_markdown").data('markdown');

            editormd.kaTeXLoaded = true;
            var testEditormdView = editormd.markdownToHTML("article_content", {
                markdown: text,//+ "\r\n" + $("#append-test").text(),
                path: '/vendors/editor.md/lib/',
                toc: true,
                tocm: true,    // Using [TOCM]
                emoji: true,
                taskList: true,
                autoLoadKaTeX: true,
                autoLoadModules: true,
                gfm: true,
                tex: true,                     // 开启科学公式 TeX 语言支持，默认关闭
                pageBreak: true,
                atLink: true,    // for @link
                emailLink: true,    // for mail address auto link
                codeFold: true,
                searchReplace: true,
                saveHTMLToTextarea: true,    // 保存 HTML 到 Textarea
                htmlDecode: "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                //previewCodeHighlight : false,  // 关闭预览窗口的代码高亮，默认开启
                flowChart: true,
                sequenceDiagram: true,         // 同上
                onload: function () {
                    console.log("onload =>", this, this.id, this.settings);
                }
            });

        });
    </script>

@endsection