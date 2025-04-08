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
		<li class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
			<a  href="{{ route('customer.dashboard', ['tab' => 'dashboard']) }}">
				<svg class="icon">
					<use xlink:href="#house"></use>
				</svg> 
				Dashboard
			</a>
		</li>
		<li class="nav-link {{ request('tab') == 'profile' ? 'active' : '' }}">   
			<a  href="{{ route('customer.profile.view', ['tab' => 'profile']) }}">
				<svg class="icon">
					<use xlink:href="#writing"></use>
				</svg>
				My Profile
			</a>
		</li>
		<li class="nav-link {{ request()->routeIs('student.enquiries.enquiries') ? 'active' : '' }}">
				<a href="{{ route('student.enquiries.enquiries')}}">
				<svg class="icon">
					<use xlink:href="#chat"></use>
				</svg>
				My Enquiries</a>
		</li>
		@php 
			$booking_routes = ['customer.booking.index',
			'customer.booking.payment_on_account','customer.booking.payment_details','customer.booking.online_lesson'];
		@endphp
		<li class="nav-link {{ in_array($currentRoute,$booking_routes) ? 'active' : '' }}">
			<a href="{{ route('customer.booking.index') }}">
			<svg class="icon">
				<use xlink:href="#bookings"></use>
			</svg>
			Bookings</a>
		</li>
		<li class="nav-link {{ request()->routeIs('customer.subjects.index') ? 'active' : '' }}">
			<a href="{{ route('customer.subjects.index', ['tab' => 'student_subject']) }}">
			<svg class="icon">
				<use xlink:href="#graduation"></use>
			</svg>
			My Subjects</a>
		</li>
		<li class="nav-link {{ request()->routeIs('customer.personalinfo') ? 'active' : '' }}">
			<a href="{{ route('customer.personalinfo')}}">
			<svg class="icon">
				<use xlink:href="#user"></use>
			</svg>
			Account</a>
		</li>
		<li class="{{ request()->routeIs('student.feedback') ? 'active' : '' }}">
		<a href="{{ route('student.feedback')}}">
			<svg class="icon">
				<use xlink:href="#feedback"></use>
			</svg>
			Feedback</a>
		</li>
		<li class="nav-link {{ request()->routeIs('student.suggested') ? 'active' : '' }}">
			<a href="{{ route('student.suggested')}}">
			<svg class="icon">
				<use xlink:href="#camera"></use>
			</svg>
			My Suggested Tutors</a>
		</li>
		<li class="nav-link {{ request()->routeIs('customer.photo.upload') ? 'active' : '' }}">
			<a href="{{ route('customer.photo.upload')}}">
			<svg class="icon">
				<use xlink:href="#camera"></use>
			</svg>
			Profile Photo</a>
		</li>
		<li class="nav-link {{ request()->routeIs('student.myquestion') ? 'active' : '' }}">
				<a href="{{ route('student.myquestion')}}">
				<svg class="icon">
					<use xlink:href="#tags"></use>
				</svg>
				Post a question</a>
		</li>
		<li class="nav-link {{ request()->routeIs('customer.tag.index') ? 'active' : '' }}">
				<a href="{{ route('customer.tag.index')}}">
				<svg class="icon">
					<use xlink:href="#tags"></use>
				</svg>
				Tags</a>
		</li>
		<li class="{{ request()->routeIs('student.history') ? 'active' : '' }}">
				<a href="{{ route('student.history')}}">
				<svg class="icon">
					<use xlink:href="#history"></use>
				</svg>
				History</a>
		</li>
		<li><a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
			<svg class="icon">
				<use xlink:href="#enter"></use>
			</svg>
			Log Out</a>
		</li>
	</ul>
</div>