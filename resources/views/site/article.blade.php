@extends("site.layout")
@extends("layouts.header")
@extends("layouts.content")
@extends("layouts.footer")

@extends("layouts.css")
@extends("layouts.js")

@section("content")
    <div class="content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                {{--title--}}
                                {{ $article['title'] }}
                            </div>
                        </div>
                        <div class="panel-body">
                            {{--info--}}
                            {{ $article['desc'] }}
                        </div>
                        <div class="panel-body">
                            {{--body--}}
                            <div class="word-wrap">
                                {{ $article['html_content'] }}
                            </div>
                        </div>
                        <div class="panel-footer">
                            {{--footer--}}
                            {{ $category['name'] }}
                            <ul class="navbar-collapse collapse">
                                @foreach($tags as $tag)
                                <li class="nav navbar">
                                    {{ $tag['name'] }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection