@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('customer.booking.booking_tabs')
                    
					{!! @$page->description !!}
					
				</div>
            </div>
        </div>
</section>
@endsection
