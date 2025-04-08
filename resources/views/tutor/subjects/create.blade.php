@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.user.alert_message')
                    
					<div class="title-with-link-wrapper">
						<h2>Add a Subject</h2>
					</div>
					
					<p>Here you can add a subject, these will be viewable in your profile. It is important that you add each subject you wish to teach otherwise students will not be able to find you while searching.</p>
					
					<p class="instruction bg-success text-white">Please do not enter email addresses/urls/websites/home addresses (or any other information that can allow contact) within your profile. Users who do so will immediately be removed from {{ config('constants.SITE.TITLE') }}.</p>
					
					
					<form class="edit-form" action="{{ route('tutor.subjects.store') }}" method="POST">
						@csrf
						@method('POST')
						<div class="row">
							<div class="col-6 form-field">
								<label class="form-label">Course</label> 
								<select name="course_id" id="DSCourse" class="form-control" required>
									<option value="">Choose Course</option>
									@foreach ($courses as $id => $title)
										<option value="{{ $id }}" @selected(old('course_id') == $id)>
											{{ $title }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-6 form-field" >
								<label class="form-label">Subject</label> 
								<select name="subject_id" id="SubjectByCourse" class="form-control" required>
									<option value="">Choose Subject</option>
									@if(!empty($subjects))
										@foreach ($subjects as $id => $title)
											<option value="{{ $id }}" @selected(old('subject_id') == $id)>
												{{ $title }}
											</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-12 form-field">
								<label class="form-label">Subject Area (optional)</label> 
								<input class="form-control form-control-user required" type="text" name="tags" id="tags" value="{{ old('tags') }}" >
								<span class="help-text">Comma seperated values</span>
							</div>
							<div class="col-12 form-field">
								<label for="subject">Also Teach Online</label>
								<input
									type="checkbox"
									name="teach_online"
									@checked(old('teach_online', 1))
								/>
							</div>
						</div> 
						
						<div class="row" id="FieldsContainer">
							@if($course_level_type == 'single')
								<div class="col-12 form-field">
									<select name="level_id" class="form-control" required>
										<option value="">Choose Level</option>
										@foreach ($levels as $level_id => $level_title)
											<option value="{{ $level_id }}" @selected(old('level_id') == $level_id)>
												{{ $level_title }}
											</option>
										@endforeach
									</select>
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }})</label> 
									<input type="text" name="hourly_rate" value="{{ old('hourly_rate') }}" class="form-control level-hourly-rate numeric" data-key="1" autocomplete="off" />
								</div>
								<div class="col-12 form-field">
									<label class="form-label">Student Rate ({{ config('constants.CURRENCY_SYMBOL') }})</label> 
									<input type="text" name="lesson_rate" value="{{ old('lesson_rate') }}" class="form-control" id="LevelLessonRate_1" autocomplete="off"  readonly />
								</div>
							@elseif(!empty($levels))
								<div class="col-12">
									<div class="row">
										<div class="col-12">
											<table class="container">
												<thead>
													<tr>
														<th>Level</th>
														<th>Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }}):</th>
														<th>Student Rate ({{ config('constants.CURRENCY_SYMBOL') }}):</th>
													</tr>
												</thead>
												<tbody>
													@php
														$count = 0;
													@endphp
													@foreach ($levels as $level_id => $level_title)
													@php $count++; @endphp
													<tr>
														<td>
															<input
																type="checkbox"
																name="level[{{$count}}][level_id]"
																value="{{ $level_id }}"
																id="{{ 'LevelCheck'.$level_id }}"
																@checked(old('level.'.$count.'.level_id'))
															/>
															<label for="{{ 'LevelCheck'.$level_id }}">{{ $level_title }}</label>
														</td>
														<td>
															 <input
																type="text"
																name="level[{{$count}}][hourly_rate]"
																value="{{old('level.'.$count.'.hourly_rate')}}"
																class="form-control level-hourly-rate numeric"
																data-key="{{$count}}"
																autocomplete="off"
															/>
														</td>
														<td>
															<input
																type="text"
																id="LevelLessonRate_{{$count}}"
																name="level[{{$count}}][lesson_rate]"
																value="{{old('level.'.$count.'.lesson_rate')}}"
																class="form-control"
																autocomplete="off"
																readonly
															/>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							@endif
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

@section('custom-js')
<script>
	let student_rate_percent = {{ config('constants.SITE.STUDENT_RATE') }};
	let student_rate_interger = 1 + student_rate_percent/100;

	

	jQuery(document).ready(function(){
		jQuery(document).on('change', '#DSCourse', function(){
			var course_id = jQuery(this).val();
			if(course_id != ''){
				getFieldsByCourse(course_id);
			}
		});
		
		// jQuery(document).on('change', 'input[type="checkbox"]', function () {
        //     let isChecked = $(this).is(':checked');
        //     let levelId = $(this).val();
        //     let row = $(this).closest('tr');

        //     if (isChecked) {
        //         row.find('input[name$="[lesson_rate]"]').prop('disabled', false).prop('readonly', false);
        //     } else {
        //         row.find('input[name$="[lesson_rate]"]').prop('disabled', true).prop('readonly', true);
        //     }
        // });

	});
	
	function getFieldsByCourse(course_id){
		var actionURLS = "{{ route('tutor.subjects.get_subject_by_course') }}";
		var actionURLF = "{{ route('tutor.subjects.get_fields_by_course') }}";
		
		jQuery.ajax({
			type: 'GET',
			url: actionURLS + '/' + course_id,
			success : function(data)
			{
				jQuery('#SubjectByCourse').html(data);
			},
			error : function(data)
			{
				console.log(JSON.stringify(data));
				alert('Sorry! There is some problem. please check function calling.')
			}
		});
		
		
		jQuery.ajax({
			type: 'GET',
			url: actionURLF + '/' + course_id,
			success : function(data)
			{
				jQuery('#FieldsContainer').html(data);
			},
			error : function(data)
			{
				console.log(JSON.stringify(data));
				alert('Sorry! There is some problem. please check function calling.')
			}
		});
	}
	
	jQuery(document).on('blur', '.level-hourly-rate', function(){
		var level_key			= jQuery(this).data('key');
		var level_hourly_rate	= jQuery(this).val();
		var level_student_rate	= parseInt(level_hourly_rate * student_rate_interger); //increase 25%
		jQuery('#LevelLessonRate_'+level_key).val(level_student_rate);
	});
</script>
@endsection