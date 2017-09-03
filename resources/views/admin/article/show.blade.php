@extends("admin.layout")
@extends("admin.header")
@extends("admin.sidebar")
{{--@extends("admin.content")--}}
@extends("admin.footer")

@extends("admin.css")
@extends("admin.js")
{{--@extends('site.post')--}}

@section('content')
    {{--xxx--}}
    <div class="container" style="margin-top: 100px;">
    @include('site.post')
    </div>
@endsection