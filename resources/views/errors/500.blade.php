@extends('layouts.cms')
@section('meta_title') 500 internal server error @endsection
@section('meta_desc') 500 internal server error  @endsection
@section('content')
    <section class="section error-page bg-sec">
    <div class="container">
        <div class="error-content text-center">
        <img src="{{url('front/assets/images/505.png')}}" alt="500 internal server error">
        <p>Technical difficulties & resolving them now thanks for your patience.</p>
        <a href="{{ url('home')}}" class="btn btn-green"><span>Back To Home</span></a>
        </div>
    </div>
    </section>
@endsection