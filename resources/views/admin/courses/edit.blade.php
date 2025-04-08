@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit Course</h5>
		</div>
       <div class="card-body">
       <form class="validatedForm" action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Title Field -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                    <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required>
                </div>
            </div>
			
			<!-- Select Level Type Field -->
			<div class="form-group row">
				<div class="col-sm-4">
					<label for="level_type">Level Type</label>
					<select name="level_type" id="LevelType" class="form-control" required>
						<option value="single" {{ (old('level_type', $course->level_type) == 'single') ? 'selected' : '' }}>Single</option>
						<option value="multiple" {{ (old('level_type', $course->level_type) == 'multiple') ? 'selected' : '' }} >Multiple</option>
					</select>
				</div>
			</div>
			
			<div class="form-group row">
					<label for="level_type">Include course levels</label>
					@if(!empty($levels)) 	
						@foreach($levels as $level_id => $level_title )   
							@php 									
								$checked = '';
								$course_levels = old('course_levels', $course_levels);
							@endphp
							@if(!empty($course_levels))			
							  
								@if (in_array($level_id, $course_levels))
									@php 								
										$checked = 'checked';
									@endphp
								@endif
							@endif
							
							<div class="col-sm-3">					
								<label class="checkbox">		
									<input type="checkbox" class="cities" name="course_levels[]" value="{{$level_id}}" {{$checked}} /> {{$level_title}}
								</label>
							</div>
							
						@endforeach
					@endif
				</div>
			
			<div class="form-group row">
				<label for="level_type">Cities</label>
					@if(!empty($cities)) 
						@foreach($cities as $val)   
								@php 									
									$checked = '';
								 
								@endphp
								@if(!empty($course->cities))			
								  
									@if (in_array($val->id, $course->cities))
										@php 								
											$checked = 'checked';
										@endphp
									@endif
								@endif	
								<div class="col-sm-4">					
									<label class="checkbox">		
										<input type="checkbox" class="cities" name="cities[]" value="{{$val->id}}" {{$checked}} /> {{$val->name}}
									</label>
								</div>
						@endforeach
					@endif
			</div>
			
			
            <!-- Buttons: Back and Submit -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                    <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Update Course</button>      
                </div>
            </div>
        </form>
       </div>
    </div>
</div>

@endsection

