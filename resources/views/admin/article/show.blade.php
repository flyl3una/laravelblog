@extends("admin.layout")
@extends("admin.header")
@extends("admin.sidebar")
@extends("admin.footer")

@extends("admin.css")
@extends("admin.js")

@section('content')
    <div class="container" style="margin-top: 100px;">
        @include('site.post')
    </div>
@endsection