@extends('layouts.cms')

@section('page-css')
<link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css">
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
						<h2>Book a new lesson</h2>
					</div>
					
					<form class="edit-form" action="{{ route('tutor.booking.store') }}" method="POST">
						@csrf
						@method('POST')
						<div class="row">
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Student</label> 
								<select name="student_id" id="DSCourse" class="form-control" required>
									<option value="">Choose Student</option>
									@foreach ($students as $student_id => $student_name)
										<option value="{{ $student_id }}" @selected(old('student_id') == $student_id)>
											{{ $student_name }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 col-md-6 form-field" >
								<label class="form-label">Subject</label> 
								<select name="subject_tutor_id" class="form-control" required>
									<option value="">Choose Subject</option>
									@if(!empty($tutor_subjects))
										@foreach ($tutor_subjects as $key => $tutor_subject)
											
											@php
												$type = ($tutor_subject[0]['type'] == 2) ? '(online)' : '';
											@endphp
											<option data-type="{{ $type }}" data-hourly-rate="{{ $tutor_subject[0]['hourly_rate'] }}" data-student-rate="{{ $tutor_subject[0]['lesson_rate'] }}" value="{{ $tutor_subject[0]['id'] }}" @selected(old('subject_tutor_id') == $tutor_subject[0]['id'])>
												{{ $tutor_subject[0]['subject']['title'] .' '. $tutor_subject[0]['level']['title'] . ' ' . $type }}
											</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Hourly Rate</label> 
								<input class="form-control form-control-user required dsc-hourly-rate" type="text" data-update-container="#StudentRateBox" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate') }}" >
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Teaching Location</label> 
								<select name="teaching_location" class="form-control" required>
									<option value="">Choose Location</option>
									@php $teaching_location = getTeachingLocation() @endphp
									@foreach ($teaching_location as $key => $value)
										<option value="{{ $key }}" @selected(old('teaching_location') == $key)>
											{{ $value }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Start Date</label>
								@php
									$startDate = old('start_date') ? \Carbon\Carbon::parse(old('start_date'))->format('d/m/Y') : '';
								@endphp
								<input class="form-control form-control-user required date-picker" type="text" name="start_date" value="{{ $startDate }}" >
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label" for="start_time">Start Time</label> 
								<!--<input class="form-control form-control-user required" id="start_time" type="time" name="start_time" value="{{ old('start_time') }}" >-->
								<div class="row">
									<div class="col-6 pe-2">
										<select name="start_time_hour" class="form-control" required>
											@php 
												$hours = getHourList(); 
											@endphp
											@foreach ($hours  as $key => $value)
												<option value="{{ $key }}" @selected(old('start_time_hour') == $key)>
													{{ $value }}
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-6 ps-2">
										<select name="start_time_minute" class="form-control" required>
											@php 
												$minutes = ['00'=>'00','15'=>'15','30'=>'30','45'=>'45']; 
											@endphp
											@foreach ($minutes  as $key => $value)
												<option value="{{ $key }}" @selected(old('start_time_minute') == $key)>
													{{ $value }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Duration</label> 
								<select name="duration" class="form-control" required>
									<option value="">Choose Duration</option>
									@php $durations = getBookingDuration() @endphp
									@foreach ($durations  as $key => $value)
										<option value="{{ $key }}" @selected(old('duration') == $key)>
											{{ $value }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 col-md-6 form-field">
								<label class="form-label">Repeat Lesson</label> 
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="lesson_repeat" value="1" id="lesson_repeat1" @checked(old('lesson_repeat') == 1)>
								  <label class="form-check-label" for="lesson_repeat1">
									One Off
								  </label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="lesson_repeat" value="2" id="lesson_repeat2" @checked(old('lesson_repeat') == 2)>
								  <label class="form-check-label" for="lesson_repeat2">
									Weekly
								  </label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="lesson_repeat" value="3" id="lesson_repeat3" @checked(old('lesson_repeat') == 3)>
								  <label class="form-check-label" for="lesson_repeat3">
									Fortnightly
								  </label>
								</div>
							</div>
							
							<div class="col-12 col-md-12 form-field">
								<label class="form-label">Days Of Week</label> 
								@foreach($days as $key => $day)
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="checkbox" name="day[]" value="{{ $key }}" id="day{{ $key }}" @if(is_array(old('day')) && in_array($key, old('day'))) checked @endif>
								  <label class="form-check-label" for="day{{$key}}">
									{{ $day }}
								  </label>
								</div>
								@endforeach
							</div>
							<div class="col-12 text-center" id="RateContainer">
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

@section('page-js')
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js"></script>
@endsection

@section('custom-js')
<script>
	jQuery(document).ready(function(){
		jQuery('[name=subject_tutor_id]').on('load, change', function(){
			var selectedOption = jQuery(this).find(':selected');
			var hourly_rate	   = selectedOption.data('hourly-rate');
			var student_rate   = selectedOption.data('student-rate');
			
			jQuery('[name=hourly_rate]').val(hourly_rate);
			
			/* Display at Bottom */
			var rate_html = '<div class="ratecard"><label>My rate</label><div class="hourly-rate">'+SITE_CURRENCY+'<span id="HourlyRateBox">'+hourly_rate+'</span><span class="unit">/hr</span></div><div class="student-rate">Student pays '+SITE_CURRENCY+'<span id="StudentRateBox">'+student_rate+'</span><span class="unit">/hr</span></div></div>';
			
			jQuery('#RateContainer').html(rate_html);
			
		});
	});
</script>
@endsection