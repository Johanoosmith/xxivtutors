
@php 
	$currentRoute = Route::currentRouteName(); 
@endphp
<div class="col dashboard-menu">
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavbarNavigation" aria-controls="dashboardNavbarNavigation" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"><svg class="icon">
				<use xlink:href="#dashboard"></use>
			</svg>
		</span> Menu
	</button> 
	<ul class="dashboard-navigation" id="dashboardNavbarNavigation">
		<li class="nav-link {{ request()->routeIs('tutor.dashboard') ? 'active' : '' }}">
			<a  href="{{ route('tutor.dashboard', ['tab' => 'dashboard']) }}">
				<svg class="icon">
					<use xlink:href="#house"></use>
				</svg> 
				Dashboard
			</a>
		</li>
		<li class="nav-link {{ request()->routeIs('tutor.verification') ? 'active' : '' }}">
		<a  href="{{ route('tutor.verification')}}">
			<svg class="icon">
				<use xlink:href="#paper"></use>
			</svg>
			Verification</a>
		</li>
		<li class="nav-link {{ request()->routeIs('tutor.profile.view') ? 'active' : '' }}">   
		<a  href="{{ route('tutor.profile.view', ['tab' => 'profile']) }}">
			<svg class="icon">
				<use xlink:href="#writing"></use>
			</svg>
			My Profile</a>
		</li>
		<li class="nav-link {{ request()->routeIs('tutor.enquiries.enquiries') ? 'active' : '' }}">
			<a href="{{ route('tutor.enquiries.enquiries')}}">
			<svg class="icon">
				<use xlink:href="#chat"></use>
			</svg>
			My Enquiries</a>
		</li>
		@php 
			
			$booking_routes = ['tutor.booking.index','tutor.booking.create','tutor.booking.edit','tutor.booking.help','tutor.booking.payment_history','tutor.booking.online_lesson']; 
			
		@endphp
		<li class="nav-link {{ in_array($currentRoute,$booking_routes) ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.index') }}">
			<svg class="icon">
				<use xlink:href="#bookings"></use>
			</svg>
			Bookings</a>
		</li>
			
		@php 
			$subject_routes = ['tutor.subjects.index','tutor.subjects.create','tutor.subjects.edit']; 
		@endphp	
		<li class="nav-link {{ in_array($currentRoute,$subject_routes) ? 'active' : '' }}">
			<a href="{{ route('tutor.subjects.index') }}">
			<svg class="icon">
				<use xlink:href="#graduation"></use>
			</svg>
			My Subjects</a>
		</li>
		<li class="nav-link {{ request()->routeIs('tutor.personalinfo') ? 'active' : '' }}">
			<a href="{{ route('tutor.personalinfo')}}">
			<svg class="icon">
				<use xlink:href="#user"></use>
			</svg>
			Account</a>
		</li>

		<li>
			<li class="nav-link {{ request()->routeIs('suggested-students') ? 'active' : '' }}">
			<a href="{{ route('suggested-students')}}">
			<svg class="icon">
				<use xlink:href="#article"></use>
			</svg>
			My Suggested Students</a></li>
		</li>
		<li class="nav-link {{ request()->routeIs('tutor.photo.upload') ? 'active' : '' }}">
			<a href="{{ route('tutor.photo.upload')}}">
			<svg class="icon">
				<use xlink:href="#camera"></use>
			</svg>
			Profile Photo</a></li>
		<li class="nav-link {{ request()->routeIs('tutor.articles.index') ? 'active' : '' }}">
			<a href="{{ route('tutor.articles.index')}}">
			<svg class="icon">
				<use xlink:href="#article"></use>
			</svg>
			Articles</a></li>
		<li class="{{ request()->routeIs('tutor.tag.index') ? 'active' : '' }}">
			<a href="{{ route('tutor.tag.index')}}">
			<svg class="icon">
				<use xlink:href="#tags"></use>
			</svg>
			Tags</a></li>
		<li class="{{ request()->routeIs('tutor.history') ? 'active' : '' }}">
			<a href="{{ route('tutor.history')}}">
			<svg class="icon">
				<use xlink:href="#history"></use>
			</svg>
			History</a></li>
			
			<li class="nav-link {{ request()->routeIs('tutor.feedback') ? 'active' : '' }}">
			<a href="{{ route('tutor.feedback')}}">
			<svg class="icon">
				<use xlink:href="#feedback"></use>
			</svg>
			Feedback</a></li>
		<li><a href="#">
			<svg class="icon">
				<use xlink:href="#enter"></use>
			</svg>
			Log Out</a></li>
	</ul>
</div>