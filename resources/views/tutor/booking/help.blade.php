@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('tutor.booking.booking_tabs')
                    
					<p>
						Once your profile is live, students will be able to locate and send a message to you directly through Tutor Hunt. We will send you a SMS and email as soon as you receive any new enquiries from students.
					</p>
					
					{!! $page->description !!}
				</div>
            </div>
        </div>
</section>
@endsection
