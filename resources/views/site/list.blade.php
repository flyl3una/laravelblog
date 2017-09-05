@section('left')
    <div id="index_id" class="container-fluid">
    @foreach($articles as $article)
        <div class="card a-article z-depth-2 hoverable">
            <div class="card-content ">
                <h4>
                    {{ $article['title'] }}
                </h4>
            {{--</div>--}}
            {{--<div class="card-content article-info">--}}
                <div class="grey-text">
                <span>{{ $article['user']['name'] }}
                </span>
                    <span>/</span>
                    <span>
                    {{ $article['cate']['name'] }}
                </span>
                    <span>/</span>
                    <span>{{ $article['updated_at'] }}</span>
                </div>
                <div class="row">
                    {{--<div class="divider"></div>--}}
                </div>

                <div>
                <p class="truncate" style="font-size: 1.3em;">
                    {{ $article['description'] }}
                </p>
                </div>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col m12 s12">
                @foreach($article['tags'] as $oneTag)
                    <div class="chip grey lighten-2">{{ $oneTag['name'] }}</div>
                @endforeach

                <a class="right btn" href="{{ route('home.show', $article['id']) }}">Read</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
        {!! $articles->render() !!}
    </div>

@endsection
