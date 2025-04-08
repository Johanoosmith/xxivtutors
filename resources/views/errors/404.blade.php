@extends('layouts.cms')
@section('meta_title') 404 page @endsection
@section('meta_desc') 404 page  @endsection
@section('content')

<section class="section error-page bg-sec">
  <div class="container">
    <div class="error-content text-center">
    <img src="{{url('front/assets/images/404.png')}}" alt="404 error">
    <p>Nothing found for the requested page. Try a search instead?</p>
    <a href="{{ url('home')}}" class="btn btn-green"><span>Back To Home</span></a>
    </div>
  </div>
</section>

@endsection