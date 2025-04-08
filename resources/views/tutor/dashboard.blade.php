@extends('layouts.cms')
@section('content')
<main>
    <section class="page-banner text-center text-white">
        <div class="banner-img">
            <img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="dashboard-with-sidebar">
		<div class="container">
			<div class="row">
				@include('layouts.tutor_tabs')
				<div class="col dashboard-content">
				@if (request('tab') == 'profile')
					
						<h2>Your Personal Information</h2>
						<div class="profile-tabs">
							<ul>
								<li class="{{ Request::routeIs('tutor.profile.view') ? 'active' : '' }}"><a href="{{ route('tutor.profile.view') }}">Edit Profile</a></li>
								<li class="{{ Request::routeIs('tutor.qualification') ? 'active' : '' }}"><a href="{{ route('tutor.qualification') }}">Qualifications</a></li>
								<li  class="{{ Request::routeIs('tutor.myavailability') ? 'active' : '' }}"><a href="{{route('tutor.myavailability')}}">My Availability</a></li>
								 <li  class="{{ Request::routeIs('tutor.headlines') ? 'active' : '' }}"><a href="{{route('tutor.headlines')}}">Headlines</a></li>
								<li  class="{{ Request::routeIs('tutor.foundme') ? 'active' : '' }}"><a href="{{route('tutor.foundme')}}">Who's Found Me?</a></li>
							</ul>
						</div>
						<form method="POST" action="{{ route('tutor.profile.view.update', $user->id) }}" name="signupform" id="signupform" class="edit-form">
							@csrf
							@method('PUT')
							@include('elements.alert_message')

							<div class="row">
								<div class="col-12">
									<p>Please complete the following information to help us build your profile so students can learn more about you.</p>
								</div>
								@foreach ($tutorsdata as $tutor)
									
								@endforeach 
								<div class="col-12 form-field">
									<input type="hidden" name="section" value="profile">
									<input type="hidden" name="openaccount" id="openaccount" value="yes">
									<label class="form-label" for="edit-bio">Your Bio</label>
									<textarea value="{{ request('short_description') }}" class="form-control"  rows="30" cols="11" id="comments" maxlength="6500" name="short_description" style="height:210px;">
									{{ old('short_description', $tutor->short_description ?? '') }}</textarea>
								</div>
								<div class="col-12 form-field">
									<label class="form-label" for="edit-availability">Your Availability</label>
									<textarea value="{{ request('availability') }}"  name="availability"  class="form-control" id="edit-availability"> {{ old('availability', $tutor->availability ?? '') }}</textarea>
								</div>
								<div class="col-12 form-field">
									<label class="form-label" for="edit-availability">Your Experience</label>
									<textarea name="your_experience" class="form-control" id="edit-availability">{{ old('your_experience', $tutor->your_experience ?? '') }}</textarea>
								</div>
								<div class="col-12 form-field">
									<label class="form-label" for="edit-availability">To help us promote your profile to online students, tell us about your online teaching experience</label>
									<textarea name="online_teaching_experience" class="form-control" id="edit-availability">{{ old('online_teaching_experience', $tutor->online_teaching_experience ?? '') }}</textarea>
								</div>
								

								<div class="col-md-6 form-field">
									<label class="form-label" for="language">Native Language </label>
									<div class="select-field">
									<select class="form-select" id="language" name="language">
												@foreach ($languages as $laug_id => $laug_name)
													<option value="{{ $laug_id }}" 
														{{ (isset($tutor->language) && $laug_id == $tutor->language) ? 'selected' : '' }}>
														{{ $laug_name }}
													</option>
												@endforeach
											</select>
										<svg>
											<use xlink:href="#caretDown"></use>
										</svg>
									</div>
								</div>

								<div class="col-md-6 form-field">
									<label class="form-label" for="language">Distance Willing to Travel </label>
									<div class="select-field">
									<select name="distance" id="distance" class="form-select">
											@foreach([0 => 'Home Only', 1 => '1 mile', 2 => '2 miles', 3 => '3 miles', 4 => '4 miles', 
													5 => '5 miles', 8 => '8 miles', 10 => '10 miles', 12 => '12 miles', 15 => '15 miles', 
													20 => '20 miles', 30 => '30 miles', 50 => '50 miles'] as $key => $value)
												<option value="{{ $key }}" 
													{{ (old('distance', $tutor->distance ?? 10) == $key) ? 'selected' : '' }}>
													{{ $value }}
												</option>
											@endforeach
										</select>
										<svg>
											<use xlink:href="#caretDown"></use>
										</svg>
									</div>
								</div>
								<p><b>
								*Field not required. </b>
								<br><br>
								<button type="submit" class="btn btn-green">Save</button>
								</p>
							</div>
						</form>
				@elseif (request('tab') == 'dashboard' || !request('tab'))
					<div class="dashboard-overview">
						<div class="row">
							<div class="col-md-4">
								<h2>Tutor Account</h2>
									<p class="small">Last Logged in: 29th Jan 2025 11:21
									</p>
							</div>
							<div class="col-md-4">
								<h4>Your Profile is Online</h4>
								<p><a href="#">Switch Offline</a></p>
							</div>
							<div class="col-md-4">
								<h4>Your Profile Link:</h4>
								<p>
									<a href="{{ route('tutor', ['id' => $user->id]) }}" class="text-truncate" target="_blank">
									{{ route('tutor', ['id' => $user->id]) }}
									</a>
								</p>
							</div>
						</div>
						@php
							$views = getUserViewCounts(auth()->id());
						@endphp
						<div class="row text-center">
							<div class="col-6 col-lg-3 dashboard-box">
								<div class="inner-box bg-info bg-opacity-10">
									<span class="counting text-info">{{$views['all_views'] }}</span>
									<p>All Time Views</p>
								</div>
							</div>
							<div class="col-6 col-lg-3 dashboard-box">
								<div class="inner-box bg-success bg-opacity-10">
									<span class="counting text-success">{{ $views['last_7_days'] }}</span>
									<p>Last 7 Days</p>
								</div>
							</div>
							<div class="col-6 col-lg-3 dashboard-box">
								<div class="inner-box bg-primary bg-opacity-10">
									<span class="counting text-primary">{{ $views['current_month'] }}</span>
									<p>This Month</p>
								</div>
							</div>
							<div class="col-6 col-lg-3 dashboard-box">
								<div class="inner-box bg-danger bg-opacity-10">
									<span class="counting text-danger">{{ $views['last_2_months'] }}</span>
									<p>Last Month</p>
								</div>
							</div>
						</div>
					</div>        
				@elseif (request('tab') == 'personalinfo')
					<p>personalinfo</p>
				@endif
				</div>
			</div>
		</div>
    </section>
    
</main>

@endsection
