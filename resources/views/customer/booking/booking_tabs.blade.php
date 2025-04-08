<div class="profile-tabs">
	<ul>
		<li class="{{ request()->routeIs('customer.booking.index') ? 'active' : '' }}">
			<a href="{{ route('customer.booking.index')}}">My Bookings</a>
		</li>
		<li class="{{ request()->routeIs('customer.booking.payment_details') ? 'active' : '' }}">
			<a href="{{ route('customer.booking.payment_details')}}">Payment Details</a>
		</li>
		<li class="{{ request()->routeIs('customer.booking.payment_history') ? 'active' : '' }}">
			<a href="{{ route('customer.booking.payment_history')}}">Payment On Account</a>
		</li>
		<li class="{{ request()->routeIs('customer.booking.online_lesson') ? 'active' : '' }}">
			<a href="{{ route('customer.booking.online_lesson')}}">Online Lesson</a>
		</li>
	</ul>
</div>