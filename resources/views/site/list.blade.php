@section('left')
    @foreach($articles as $article)
        <div class="card a-article hoverable z-depth-3">
            <div class="card-content teal lighten-1 article-info white-text">
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
                <span>2017.1.1</span>
            </div>
            <div class="card-content">
                <p class="grey-text">
                    {{ $article['description'] }}
                </p>
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

@endsection