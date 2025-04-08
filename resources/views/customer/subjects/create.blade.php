@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    @include('elements.user.alert_message')
                    
					<div class="title-with-link-wrapper">
						<h2>Add a Subject</h2>
					</div>
					
					<p>Here you can add a subject, these will be viewable in your profile. It is important that you add each subject you want to learn otherwise tutors will not be able to find you while searching.</p>
					
					<p class="instruction bg-success text-white">Please do not enter email addresses/urls/websites/home addresses (or any other information that can allow contact) within your profile. Users who do so will immediately be removed from {{ config('constants.SITE.TITLE') }}.</p>
				
				
					
					<form class="edit-form" action="{{ route('customer.subjects.store') }}" method="POST">
						@csrf
						@method('POST')
						<div class="row">
							<div class="col-12 form-field">
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
						</div> 
						
						<div class="row" id="FieldsContainer">
							<div class="col-12 form-field" >
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
							
							@if(!empty($levels))
								<div class="col-12">
									<div class="row">
										<div class="col-12">
											<table class="container">
												<thead>
													<tr>
														<th>Level</th>
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

@section('inline-js')
<script>
	jQuery(document).ready(function(){
		jQuery(document).on('change', '#DSCourse', function(){
			var course_id = jQuery(this).val();
			console.log(course_id);
			if(course_id != ''){
				getFieldsByCourse(course_id);
			}
		});
	});
	
	function getFieldsByCourse(course_id){
		var actionURLF = "{{ route('customer.subjects.get_fields_by_course') }}";
		
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
</script>
@endsection