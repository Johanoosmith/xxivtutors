@extends('layouts.cms')
@section('meta_title') Reset Password @endsection
@section('meta_desc') Reset Password @endsection
@section('content')


<main>
	<section class="page-banner text-center text-white register-page-banner">
		<div class="banner-img">
			<img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Reset Password</h1>
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
				<div class="col-md-12">
					<div class="login-form-page bg-lightgrey">
						@include('elements.alert_message')
						<form method="POST" id="passwordResetForm" action="{{ route('password.store') }}">
							@csrf
							<input type="hidden" name="token" value="{{ $request->route('token') }}">
							<div class="input-group mb-3">
								<div class="mb-1">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror required" name="email" placeholder="Username/Email">
								</div>
								@error('email')								
								<label class="error" role="alert">{{ $message }}</label>
								@enderror
							</div>
							<div class="input-group mb-4">
								<div class="mb-1">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror required" name="password" placeholder="Enter a new password">
								</div>
								@error('password')
								<label class="error" role="alert">{{ $message }}</label>
								@enderror
							</div>
							<div class="input-group mb-4">
								<div class="mb-1">
									<input id="password_confirmation" type="password"
									class="form-control @error('password_confirmation') is-invalid @enderror required" name="password_confirmation" placeholder="Confirm new password">
								</div>
								@error('password_confirmation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="actionBtn col-12 step-submit">
								<button type="submit" class="btn btn-green next-btn greenBtn"> {{ __('Reset Password') }}</button>
							</div>
						</form>						
					</div>
				</div>
			</div>
			
		</div>
	</section>
</main>

@endsection
@section('inline-js')
<script>
	$(document).ready(function () {
		$("#passwordResetForm").validate({			
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 8,
				},
				password_confirmation: {
					required: true,
					minlength: 8,
					equalTo: "#password"
				},

			},
		});
	});
</script>
@endsection