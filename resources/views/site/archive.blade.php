@extends("layouts.layout")

@extends("site.header")
@extends("site.content")

@extends("site.footer")

@extends("layouts.css")
@extends("layouts.js")

@section('left')
    <div class="container-fluid">
        <div class="row">
            {{--<div class="col m12 s12">--}}
                <ul id="tabs_id" class="tabs">
                    @foreach($archives as $year => $archive_month)
                        @if($select_year != '0' && $select_year==$year)
                            <li class="tab"><a href="#{{ $year }}_id" class="teal-text active">{{ $year }}</a></li>
                        @else
                            <li class="tab"><a href="#{{ $year }}_id" class="teal-text">{{ $year }}</a></li>
                        @endif
                    @endforeach
                </ul>
            {{--</div>--}}
        </div>

        @foreach($archives as $year => $archive_month)
            <div id="{{ $year }}_id" class="container-fluid archive-container" style="display: none">
                @foreach($archive_month as $month => $archive)
                    <div class="archive-month" id="month-{{ $month }}">
                        <span class="month-flag"></span>
                        <h4>{{ $year }} / {{ $month }}</h4>
                        @foreach($archive['articles'] as $article)
                            <a href="{{ route('home.show', $article['id']) }}">
                                <div class="card a-article hoverable">
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
            selectTab('archive_page_id');
            $(".archive-container").show();
            $('ul.tabs').tabs();
        });
    </script>
@endsection