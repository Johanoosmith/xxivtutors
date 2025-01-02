@extends('layouts.cms')
@section('meta_title') 404 page @endsection
@section('meta_desc') 404 page  @endsection
@section('content')

<section class="error-page bg-sec">
  <div class="container">
    <div class="error-content">
    <img src="{{url('front/assets/images/404.png')}}" alt="404 error">
    <p>Nothing found for the requested page. Try a search instead?</p>
    <a href="{{ url('home')}}" class="red-btn"><span>BACK TO HOME</span> <span class="arrow-btn"><i class="fa fa-angle-right"></i> </span></a>
    </div>
  </div>
</section>

@endsection