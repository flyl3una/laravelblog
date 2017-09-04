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
//        $(document).ready(function() {
//            selectTab('index_tab_id');
//            $('ul.tabs').tabs();
//        });

    </script>
@endsection