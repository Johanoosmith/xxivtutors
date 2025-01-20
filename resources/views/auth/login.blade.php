@extends('layouts.cms')
@section('meta_title') Login @endsection
@section('meta_desc') Login @endsection
@section('content')

<main>
	<section class="page-banner text-center text-white register-page-banner">
		<div class="banner-img">
			<img src="http://192.168.9.32:8000/storage/tutors/tutor-details-bg.jpg" alt="">
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
					<p>If you are a tutor or student looking to make full use of Tutuition please fill in the form below. <br>
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
					<div class="register-form bg-lightgrey">
						<form method="post" id="loginForm" action="{{ route('login') }}">
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
								<div class="col-12 step-submit">
									<button type="submit" class="btn btn-green next-btn">Login</button>
								</div>
							</div>
						</form>
						<div class="actionBtn">
							@if (Route::has('password.request'))
							<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
								href="{{ route('password.request') }}">
								{{ __('Forgot your password?') }}
							</a>
							@endif
						</div>
						<p class="signup-info mt-5">Don't have an account yet? <a href="{{ route('register') }}" class="signup_link">Sign up</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>


@endsection