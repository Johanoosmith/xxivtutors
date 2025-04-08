@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
		<div class="row"> 
			@include('layouts.student_tabs')
			<div class="col dashboard-content">
				@include('elements.alert_message')
				<div class="title-with-link-wrapper">
					<h2>Edit Subject</h2>
				</div>
				<form class="edit-form" action="{{ route('customer.subjects.update', $subject->id) }}" method="POST">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-6 form-field">
							<label class="form-label">Course</label> 
							<select name="course_id" id="DSCourse" class="form-control" disabled required>
								<option value="">Choose Course</option>
								@foreach ($courses as $id => $title)
									<option value="{{ $id }}" @selected(old('course_id', $subject->course_id) == $id)>
										{{ $title }}
									</option>
								@endforeach
							</select>
						</div>
						<div class="col-6 form-field" >
							<label class="form-label">Subject</label> 
							<select name="subject_id" id="SubjectByCourse" class="form-control" disabled required>
								<option value="">Choose Subject</option>
								@if(!empty($subjects))
									@foreach ($subjects as $id => $title)
										<option value="{{ $id }}" @selected(old('subject_id', $subject->subject_id) == $id)>
											{{ $title }}
										</option>
									@endforeach
								@endif
							</select>
						</div>
						
						<div class="col-12 form-field" >
							<label class="form-label">Level</label> 
							<select name="level_id" class="form-control" required>
								<option value="">Choose Level</option>
								@if(!empty($levels))
									@foreach ($levels as $levels_id => $level_title)
										<option value="{{ $levels_id }}" @selected(old('level_id', $subject->level_id) == $levels_id)>
											{{ $level_title }}
										</option>
									@endforeach
								@endif
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
		var actionURLS = "{{ route('customer.subjects.get_subject_by_course') }}";
		
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
		
		
		
	}
</script>
@endsection