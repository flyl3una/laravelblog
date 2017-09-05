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
            <div id="{{ $year }}_id" class="container-fluid archive-container">

                @foreach($archive_month as $month => $archive)
                    <h5><span class="month-flag"></span>{{ $year }} - {{ $month }}</h5>
                    @foreach($archive['articles'] as $article)
                        {{ $article['title'] }}<br>
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            selectTab('archive_page_id');
//            $('ul.tabs').tabs();
        });
    </script>
@endsection