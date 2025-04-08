<div class="profile-tabs">
	<ul>
		<li class="{{ request()->routeIs('tutor.booking.index') ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.index')}}">My Bookings</a>
		</li>
		<li class="{{ request()->routeIs('tutor.booking.create') ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.create')}}">New Booking</a>
		</li>
		<li class="{{ request()->routeIs('tutor.booking.help') ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.help')}}">Help</a>
		</li>
		<li class="{{ request()->routeIs('tutor.booking.payment_history') ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.payment_history')}}">Payment</a>
		</li>
		<li class="{{ request()->routeIs('tutor.booking.online_lesson') ? 'active' : '' }}">
			<a href="{{ route('tutor.booking.online_lesson')}}">Online Lessons</a>
		</li>
	</ul>
</div>