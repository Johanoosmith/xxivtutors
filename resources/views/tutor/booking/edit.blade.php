@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
                    @include('tutor.booking.booking_tabs')
                    
					<div class="title-with-link-wrapper">
						<h2>Edit lesson</h2>
					</div>
					
					<form class="edit-form" action="{{ route('tutor.booking.update', $booking->id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="col-6 form-field">
								<label class="form-label">Hourly Rate</label> 
								<input class="form-control form-control-user required" type="text" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $booking->hourly_rate) }}" >
							</div>
							<div class="col-6 form-field">
								<label class="form-label">Teaching Location</label> 
								<select name="teaching_location" class="form-control" required>
									<option value="">Choose Location</option>
									@php $teaching_location = getTeachingLocation() @endphp
									@foreach ($teaching_location as $key => $value)
										<option value="{{ $key }}" @selected(old('teaching_location', $booking->teaching_location) == $key)>
											{{ $value }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-6 form-field">
								<label class="form-label">Start Date</label> 
								<input class="form-control form-control-user required date-picker" type="text" name="start_date" value="{{ old('start_date', $booking->start_date) }}" >
							</div>
							<div class="col-6 form-field">
								<label class="form-label" for="start_time">Start Time</label> 
								<!--<input class="form-control form-control-user required" id="start_time" type="time" name="start_time" value="{{ old('start_time', $booking->start_time) }}" >-->
								
								<div class="row">
									<div class="col-md-6">
										<select name="start_time_hour" class="form-control" required>
											@php 
												$hours = getHourList(); 
											@endphp
											@foreach ($hours  as $key => $value)
												<option value="{{ $key }}" @selected(old('start_time_hour',$startHour) == $key)>
													{{ $value }}
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<select name="start_time_minute" class="form-control" required>
											@php 
												$minutes = ['00'=>'00','15'=>'15','30'=>'30','45'=>'45']; 
											@endphp
											@foreach ($minutes  as $key => $value)
												<option value="{{ $key }}" @selected(old('start_time_minute',$startMinute) == $key)>
													{{ $value }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								
								
							</div>
							<div class="col-6 form-field">
								<label class="form-label">Duration</label> 
								<select name="duration" class="form-control" required>
									<option value="">Choose Duration</option>
									@php $durations = getBookingDuration() @endphp
									@foreach ($durations  as $key => $value)
										<option value="{{ $key }}" @selected(old('duration', $booking->duration) == $key)>
											{{ $value }}
										</option>
									@endforeach
								</select>
							</div>
						</div> 
						
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-green">Save</button>
							</div>
						</div>
					</form>
					
					
                </div>
            </div>
        </div>
</section>
@endsection
