@extends("layouts.layout")

@extends("site.header")
@extends("site.content")
@extends('site.list')
@extends("site.footer")

@extends("layouts.css")
@extends("layouts.js")

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            selectTab('category_page_id');
        });
    </script>
@endsection