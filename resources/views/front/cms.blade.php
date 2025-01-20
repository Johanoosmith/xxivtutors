@extends('layouts.cms')
@section('meta_title'){{ $page->meta_title }}@endsection
@section('meta_desc'){{$page->meta_description}}@endsection
@section('meta_page_url'){{url($page->page_url)}}@endsection
@section('body_class'){{$page->page_url}}@endsection
@section('content')
<section class="page-banner text-center text-white shape-page-banner">
        <div class="banner-img">
            <img src="http://192.168.9.32:8000/uploads/pages/551734095564.jpg" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{$page->title}}</h1>
                </div>
            </div>
        </div>
        <div class="wave-shape">
            <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#F5F5F7"/>
            </svg>
        </div>
    </section>
    <section class="{{$page->slug}} py-5 cms-page-content">
        <div class="container">
            <div class="col-12">
                {!! $page->description !!}
            </div>
        </div>
    </section>

@endsection