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
					
					<div class="alert alert-danger alert-dismissible alert-alt fade show">
						We can no longer accept any further payments on account.
					</div>
				</div>
            </div>
        </div>
</section>
@endsection
