@extends('layouts.cms')
@section('meta_title') 500 internal server error @endsection
@section('meta_desc') 500 internal server error  @endsection
@section('content')
    <section class="error-page bg-sec">
    <div class="container">
        <div class="error-content">
        <img src="{{url('front/assets/images/505.png')}}" alt="500 internal server error">
        <p>Technical difficulties & resolving them now thanks for your patience.</p>
        <a href="{{ url('home')}}" class="red-btn"><span>BACK TO HOME</span> <span class="arrow-btn"><i class="fa fa-angle-right"></i> </span></a>
        </div>
    </div>
    </section>
@endsection