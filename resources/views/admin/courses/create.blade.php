@extends('layouts.admin')
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add Course</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.courses.store') }}" id="user_form" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title"  required>
                    </div>
                </div>
				<!-- Select Level Type Field -->
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="level_type">Level Type</label>
						<select name="level_type" id="LevelType" class="form-control" required>
							<option value="single">Single</option>
							<option value="multiple">Multiple</option>
						</select>
					</div>
				</div>
				
				
				<div class="form-group row">
					<label for="level_type">Include course levels</label>
					@if(!empty($levels)) 	
						@foreach($levels as $level_id => $level_title )   
							@php 									
								$checked = '';
							 
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
                    <div class="col-sm-4">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Create Course</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
