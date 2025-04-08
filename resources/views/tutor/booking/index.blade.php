@extends('layouts.cms')

@section('page-css')
<link rel="stylesheet" href="{{asset('front/assets/css/fullcalender.min.css')}}">
@endsection

@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
                    @include('tutor.booking.booking_tabs')
                    <div class="title-with-link-wrapper">
						<div class="heading">
							<h3>Booking</h3>
							<p>Getting paid</p>
						</div>
						<a href="{{ route('tutor.booking.create') }}" class="btn btn-yellow btn-small">Add a Booking</a>
					</div>
					
					<!-- Filter Form -->
                    <form action="{{ route('tutor.booking.index') }}" method="GET" id="filter-form">
                        <div class="row mb-4">
                            <div class="col-md-3">
								<div class="select-field">
									<select name="booking_on" class="form-control">
										@foreach ($booking_on as $key => $value)
											<option value="{{ $key }}" @selected(old('course_id', request()->input('booking_on')) == $key)>
												{{ $value }}
											</option>
										@endforeach
									</select>
									<svg><use xlink:href="#caretDown"></use></svg>
								</div>
                            </div>
                            <div class="col-md-3 fiter-btn-pd">
                                <button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                    </svg>
                                </button>
                                <a href="{{ route('tutor.booking.index') }}" class="btn btn-dark btn-sm reset-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <polyline points="23 20 23 14 17 14"></polyline>
                                    <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                                </svg>
                                </a>
                            </div>
                            
                        </div>
                    </form>
					
					<!-- Calender View -->
					<div id="calendar" class="full-calender"></div>
					<br>
					
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Student</th>
									<th>Lesson</th>
									<th>Subject</th>
									<th>Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }})</th>
									<th>Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($bookings->isEmpty())
									<tr>
										<td colspan="7">No Booking found.</td>
									</tr>
								@else
									@php
										$booking_status = getBookingStatus();
									@endphp
									@foreach($bookings as $booking)
										@php
											$status_class = 'warning';
											$status_label = 'Pending';
											
											if($booking->status == 2){
												$status_class = 'success';
												$status_label = 'Confirmed';
											}else if($booking->status == 3){
												$status_class = 'danger';
												$status_label = 'Cancelled';
											}
										@endphp
									<tr>
										<td>{{ $booking->student->full_name }}</td>
										<td>
											{{ date(config('constants.SITE.DATE_FORMAT'), strtotime($booking->start_date)) .' at '. date('H:i', strtotime($booking->start_time)) }}
											<br>
											{{ $booking->duration . ' Minutes' }}
										</td>
										<td>{{ $booking->subject->title }} <strong>( {{$booking->level->title}} )</strong></td>
										<td>{{ $booking->hourly_rate }}</td>
										<td>
											<span class="badge bg-{{$status_class}}">{{$status_label}}</span>
										</td>
										<td class="noselect text-right">	
											<div class="action-tools">
												@if(@$booking->booking_enquiry->enquiry_id)
												<a href="{{ route('tutor.enquiries.chat', $booking->booking_enquiry->enquiry_id) }}" class="icon-btn" data-toggle="tooltip" title="View" data-original-title="View">
													<svg class="icon">
														<use xlink:href="#view"></use>
													</svg>
												</a>
												@endif

												<a href="{{ route('tutor.booking.edit', $booking) }}" class="icon-btn" data-toggle="tooltip" title="Edit" data-original-title="Edit">
													<svg class="icon">
														<use xlink:href="#edit"></use>
													</svg>
												</a>	
												
												<form id="{{ 'BookingDelete_'.$booking->id }}" action="{{ route('tutor.booking.cancel') }}" method="POST" style="display: inline;" data-toggle="tooltip" onsubmit="confirm('are you sure to cancel the lesson?');" title="" data-original-title="Cancel Booking" >
													@csrf
													@method('POST')
													<input type="hidden" name="booking_id" value="{{ $booking->id }}">
													<button type="submit" class="icon-btn icon-red">
														<svg class="icon">
															<use xlink:href="#cancel"></use>
														</svg>
													</button>
												</form>
												
											</div>                 
										</td>
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
						
						@if (count($bookings))
						{!! $bookings->withQueryString()->links('pagination::bootstrap-5') !!}
						@endif
						
					</div>
				</div>
            </div>
        </div>
</section>
@endsection



@section('page-js')
<script src="{{ asset('front/assets/js/fullcalender.min.js') }}"></script>
@endsection


@section('custom-js')
<script>
	let booking_json  =   @json($booking_json);
	
	function fullCalender(){
	
	/* initialize the external events
		-----------------------------------------------------------------*/
		if($('#external-events').length > 0){
			var containerEl = document.getElementById('external-events');
		
			new FullCalendar.Draggable(containerEl, {
			  itemSelector: '.external-event',
			  eventData: function(eventEl) {
				return {
				  title: eventEl.innerText.trim()
				}
			  }
			 
			});
		}
		/* initialize the calendar
		-----------------------------------------------------------------*/
		if($('#calendar').length > 0){
			var calendarEl = document.getElementById('calendar');

			const today = new Date();
			const initialDate = today.getFullYear() + '-' 
				+ String(today.getMonth() + 1).padStart(2, '0') + '-' 
				+ String(today.getDate()).padStart(2, '0');

			var calendar = new FullCalendar.Calendar(calendarEl, {
								headerToolbar: {
									left: 'prev',
									center: 'title',
									right: 'next'
								},
			  
								selectable: false,
								selectMirror: true,
								displayEventTime:false,
								editable: false,
								droppable: false, // this allows things to be dropped onto the calendar
								initialDate: initialDate,
								weekNumbers: true,
								navLinks: false, // can click day/week names to navigate views
								nowIndicator: true,
								initialView: 'dayGridMonth',
								dateClick: function(info) {
									return false;
								},
								events: booking_json,
								eventDidMount: function(info) {
									// Split title on '@' to separate name and time
									const [name, time] = info.event.title.split(' @ ');

									// Set the HTML manually
									info.el.querySelector('.fc-event-title').innerHTML = `${name}<br><small>${time}</small>`;
								},
								/*
								events: [
									
									{
									title: 'Long Event',
									start: '2021-02-07',
									end: '2021-02-10',
									className: "bg-danger"
									url: 'http://google.com/',
									},
									
								]
								*/
			});
			calendar.render();
		}
}	
	
	
	
	jQuery(window).on('load',function(){
		setTimeout(function(){
			fullCalender();	
		}, 1000);
	});	
</script>
@endsection
