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
			<h5>Edit Subject</h5>
		</div>
       <div class="card-body">
       <form class="validatedForm" action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ old('title', $subject->title) }}"  required>
                    </div>
                </div>
				<!-- Select Subject Field -->
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="subject">Course</label>
						<select name="course_id" class="form-control" required>
							<option value="">Choose Course</option>
							@foreach ($courses as $id => $title)
								<option value="{{ $id }}" @selected(old('id', $subject->course_id) == $id)>
									{{ $title }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group row">
				<label for="level_type">Cities</label>
					@if(!empty($cities)) 
						@foreach($cities as $val)   
								@php 									
									$checked = '';
								 
								@endphp
								@if(!empty($subject->cities))			
								  
									@if (in_array($val->id, $subject->cities))
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
				
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="subject">Status</label>
						<input
							type="checkbox"
							name="status"
							@checked(old('status', 1))
						/>
					</div>
				</div>
				
			
            <!-- Buttons: Back and Submit -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                    <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Update Subject</button>      
                </div>
            </div>
        </form>
       </div>
    </div>
</div>

@endsection

