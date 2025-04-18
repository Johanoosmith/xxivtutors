@extends('layouts.cms')
@section('meta_title') Login @endsection
@section('meta_desc') Login @endsection
@section('content')

<main>
	<section class="page-banner text-center text-white register-page-banner">
		<div class="banner-img">
			<img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
		</div>
		<div class="container">
			<div class="row">
			@if (session('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
				<div class="col-12">
					<h1>Forgot Password</h1>
					<p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
				</div>
			</div>
		</div>
		<div class="wave-shape">
			<svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#F5F5F7"/>
			</svg>
		</div>
	</section>
	<section class="section pt-0">
		<div class="container">
			<div class="row">
				<!--<x-auth-session-status class="mb-4" :status="session('status')" />-->
				<div class="col-12">
					<div class="login-form-page bg-lightgrey">
					<!--<x-auth-session-status class="mb-4 successMsg" :status="session('status')" />-->
						@include('elements.alert_message')
					    <form method="POST" id="forgotForm" class="mt-3 mt-sm-5" action="{{ route('password.email') }}">
							@csrf
							<div class="row">
								<div class="col-md-12 form-field">
									<label class="form-label" for="email">Username / Email</label>
									<input id="email" type="email" class="form-control inputText @error('email') is-invalid @enderror required" name="email" placeholder="Username/ Email address">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="actionBtn col-12 step-submit">
								    <button type="submit" class="btn btn-green next-btn greenBtn"> {{ __('Email Password Reset Link') }}</button>
								</div>
							</div>
							<p class="mt-5 pt-4 text-center border-top">Don't have an account yet? <a href="{{url('/user/register/1')}}" class="text-link">Sign up</a></p>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</section>
</main>


@endsection
@section('inline-js')


@endsection