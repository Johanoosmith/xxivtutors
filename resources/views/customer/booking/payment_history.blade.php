@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('customer.booking.booking_tabs')
                    
					<div class="alert alert-success alert-dismissible alert-alt fade show">
							Your current balance: £ 0
					</div>
					
				
				</div>
            </div>
        </div>
</section>
@endsection
