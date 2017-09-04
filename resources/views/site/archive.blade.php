@extends("layouts.layout")

@extends("site.header")
@extends("site.content")

@extends("site.footer")

@extends("layouts.css")
@extends("layouts.js")

@section('left')
    <div class="container">
    <ul id="tabs_id" class="tabs">
        @foreach($archives as $year => $archive_month)
        <li class="tab"><a href="#{{ $year }}_id" class="teal-text">{{ $year }}</a></li>
        @endforeach
    </ul>
        @foreach($archives as $year => $archive_month)
            <div id="{{ $year }}_id" class="container-fluid">
                @foreach($archive_month as $month => $archive)
                    <h5>{{ $year }} - {{ $month }}</h5>
                    @foreach($archive['articles'] as $article)
                        {{ $article['title'] }}
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
@endsection