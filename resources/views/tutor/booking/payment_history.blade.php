@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('tutor.booking.booking_tabs')
                    
					<p>You will receive payments to your Stripe Connect account 24 hours after each lesson takes place, this will then be paid out to your bank account within 7 days. Please note that your first payout from your Stripe Connect account can take up 14 days, this is because they carry out a risk accessment. All subsequent payouts to your bank will be within 7 days.</p>
					
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Student</th>
									<th>Payment Transaction ID</th>
									<th>Booking</th>
									<th>Amount ({{ config('constants.CURRENCY_SYMBOL') }})</th>
									<th>Status</th>
									<th>Created</th>
								</tr>
							</thead>
							<tbody>
								@if($payments->isEmpty())
									<tr>
										<td colspan="7">No Payment found.</td>
									</tr>
								@else
									@php
										$payment_status = getPaymentStatus();
									@endphp
									@foreach($payments as $payment)
										@php
											$status_class = 'warning';
											$status_label = $payment_status[$payment->status];
											
											if($payment->status == 'paid'){
												$status_class = 'success';
											}else if($payment->status == 'cancel'){
												$status_class = 'danger';
											}else if($payment->status == 'refund'){
												$status_class = 'info';
											}
											
										@endphp
									<tr>
										<td>{{ $payment->student->full_name }}</td>
										<td><strong>{{ $payment->payment_intent_id }}</strong></td>
										<td>
											{{ date('d/m/Y', strtotime($payment->booking->start_date)) .' at '. date('H:i', strtotime($payment->booking->start_time)) }}
										</td>
										<td>{{ $payment->tutor_amount }}</td>
										<td>
											<span class="badge bg-{{$status_class}}">{{$status_label}}</span>
										</td>
										<td>
											{{ date('d/m/Y', strtotime($payment->created_at)) .' at '. date('H:i', strtotime($payment->created_at)) }}
										</td>
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
						
						@if (count($payments))
						{!! $payments->withQueryString()->links('pagination::bootstrap-5') !!}
						@endif
						
					</div>
					
				</div>
            </div>
        </div>
</section>
@endsection
