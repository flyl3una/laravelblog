@extends("layouts.layout")

@extends("site.header")
@extends("site.content")

@extends("site.footer")

@extends("layouts.css")
@extends("layouts.js")
@section('left')
    @include('site.post')
@endsection
