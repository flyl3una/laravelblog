@section('left')
    <div id="index_id" class="container-fluid">
        @foreach($articles as $article)
            <div class="card a-article z-depth-2 hoverable">
                <div class="card-content ">
                    <h5>
                        {{ $article['title'] }}
                    </h5>
                    <div class="grey-text">
                <span>{{ $article['user']['name'] }}
                </span>
                        <span>/</span>
                        <span>
                    {{ $article['cate']['name'] }}
                </span>
                        <span>/</span>
                        <span>{{ $article['published_at'] }}</span>
                    </div>
                    <div class="row">
                    </div>

                    <div>
                        <p class="truncate">
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
