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
					<h1>Login</h1>
					<p>If you are a tutor or student looking to make full use of {{ config('constants.SITE.TITLE') }} please fill in the form below. <br>
						If any student / tutor viewing this site searches for your criteria, we will give them the opportunity to contact you.
					</p>
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
				<x-auth-session-status class="mb-4" :status="session('status')" />
				<div class="col-12">
					<div class="login-form-page bg-lightgrey">
						@include('elements.alert_message')
						<form method="post" id="loginForm" class="mt-3 mt-sm-5" action="{{ route('login') }}">
							@csrf
							<div class="row">
								<div class="col-md-12 form-field">
									<label class="form-label" for="email">Email Address</label>
									<input class="form-control" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
									<x-input-error :messages="$errors->get('email')" class="mt-2" />
								</div>
								<div class="col-md-12 form-field">
									<label class="form-label" for="password">Password</label>
									<input class="form-control" type="password" id="password" name="password" placeholder="Password" alue="{{ old('password') }}" required>
									<x-input-error :messages="$errors->get('password')" class="mt-2" />
								</div>
								<div>
									<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
									<label for="remember">Remember Me</label>
								</div>
								<div class="col-12 step-submit d-flex justify-content-between align-items-center mt-3">
									<button type="submit" class="btn btn-green next-btn">Login</button>
									<div class="actionBtn">
										@if (Route::has('password.request'))
										<a class="text-link"
											href="{{ route('password.request') }}">
											{{ __('Forgot your password?') }}
										</a>
										@endif
									</div>
								</div>
							</div>
							<p class="mt-5 pt-4 text-center border-top">Don't have an account yet? <a class="text-link" href="{{url('/user/register/1')}}" class="signup_link">Sign up</a></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection