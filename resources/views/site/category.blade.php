@extends("layouts.layout")

@extends("site.header")
@extends("site.content")

@extends("site.footer")

@extends("layouts.css")
@extends("layouts.js")

@section('left')
    <div class="container-fluid">
        <ul id="tabs_id" class="tabs">
            @foreach($archives as $year => $archive_month)
                <li class="tab"><a href="#{{ $year }}_id" class="teal-text">{{ $year }}</a></li>
            @endforeach
        </ul>
        @foreach($archives as $year => $archive_month)
            <div id="{{ $year }}_id" class="container-fluid archive-container">
                @foreach($archive_month as $month => $archive)
                    <div class="archive-month" id="month-{{ $month }}">
                        <span class="month-flag"></span>
                        <h4>{{ $year }} / {{ $month }}</h4>
                        @foreach($archive['articles'] as $article)
                            <a href="{{ route('home.show', $article['id']) }}">
                                <div class="card a-article">
                                    <span class="article-flag"></span>
                                    <div class="card-content">
                                        <h5>{{ $article['title'] }}</h5>
                                        <br>
                                        <span>{{ $article['description'] }}</span>
                                    </div>
                                    <div class="card-action">
                                        <span>{{ $article['updated_at'] }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            selectTab('category_page_id');
        });
    </script>
@endsection