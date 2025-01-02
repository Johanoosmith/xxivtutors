
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">First Name <span class="required">*</span></label>				
				{{ html()->text('firstname')->class('form-control form-control-user required') }}
				@if ($errors->has('firstname'))
				<span class="error" role="alert">{{ $errors->first('firstname') }}</span>
				@endif
			</div>
			<div class="col-sm-4">
				<label class="form-label">Last Name</label>
				{{ html()->text('lastname')->class('form-control form-control-user required') }}
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Username / Email <span class="required">*</span></label>				
				{{ html()->text('email')->class('form-control form-control-user required') }}
				@if ($errors->has('email'))
				<span class="error" role="alert">{{ $errors->first('email') }}</span>
				@endif
			</div>
			<div class="col-sm-4">
				<label class="form-label">Date of Birth <span class="required">*</span></label>
				{{ html()->text('birthday')->class('form-control form-control-user required')->id('birthday')}}
				@if ($errors->has('birthday'))
				<span class="error" role="alert">{{ $errors->first('birthday')}}</span>
				@endif
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Address</label>			
				{{ html()->text('address')->class('form-control form-control-user required')}}
			</div>
			<div class="col-sm-4">
				<label class="form-label">Phone</label>
				{{ html()->text('mobile')->class('form-control form-control-user required')}}
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Qualification 1</label>
				{{ html()->text('tutor_qualification_1')->class('form-control form-control-user required')->value('tutor_qualification_1')}}
			</div>
			<div class="col-sm-4">
				<label class="form-label">Qualification 2</label>
				{{ html()->text('tutor_qualification_2')->class('form-control form-control-user required')->value('tutor_qualification_2')}}
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Qualification 3</label>
				{{ html()->text('tutor_qualification_3')->class('form-control form-control-user required')->value('tutor_qualification_3')}}
			</div>
			<div class="col-sm-4">
				<label class="form-label">Qualification 4</label>
				{{ html()->text('tutor_qualification_4')->class('form-control form-control-user required')->value('tutor_qualification_4')}}	
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-8 pt-4">
				<label class="form-label">About Profile (Max length 250 characters)</label>				
				{{ html()->textarea('about')->class('form-control form-control-user required')}}
			</div>
		</div>
		<div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label">Experience<span class="required">*</span></label>
                    {{ html()->text('tutor_experience')->class('form-control form-control-user')}} 
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Rate<span class="required">*</span><h8>(hr)</h8></label>   
                    {{ html()->text('tutor_rate')->class('form-control form-control-user')}}  
                </div>
        </div>
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Profile Image</label>
				<input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
			</div>
			@if(isset($user) && isset($user->image))
			@if(file_exists(public_path($user->image)))
			<div class="col-md-4 pt-5">
				<img src="{{url($user->image)}}" width="60px">
				<a href="{{ Route('admin.delete-user-image', $user->id ) }}" onclick="confirmation(event)"
					class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
					<i class="fa fa-remove  red-color">X</i> 
				</a>
			</div>
			@endif
			@endif
		</div>
		@if(!empty($user))
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Password </label>
				<input id="password" type="password" class="form-control" name="password">
			</div>
		</div>
		@else
		<div class="form-group row">
			<div class="col-sm-4">
				<label class="form-label">Password <span class="required">*</span></label>				
				{{ html()->text('password')->class('form-control form-control-user required')}}
				@if ($errors->has('password'))
				<span class="error" role="alert">{{ $errors->first('password')}}</span>
				@endif
			</div>
		</div>
		@endif
		<div class="form-group row">
			<div class="col-sm-4">
				@php
				$status_options = [
				'1' => 'Active',
				'0' => 'Deactive',
				];
				@endphp
				<label class="form-label">Status <span class="required">*</span></label>
				{{ html()->select('status', $status_options)->class('form-control required')->id('status')}}	
			</div>
			<div class="col-sm-4">
				<label for="specialization" class="form-label">Select Specializations (Courses):</label>
				<div id="specialization">
					@foreach($courses as $course)
						<div class="form-check">
							<input 
								type="checkbox" 
								name="specialization[]" 
								value="{{ $course->id }}" 
								id="course_{{ $course->id }}" 
								class="form-check-input"
								@if(isset($tutor) && $tutor->specialization->contains($course->id)) checked @endif>
							<label for="course_{{ $course->id }}" class="form-check-label">
								{{ $course->title }}
							</label>
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="card-footer">
			<div class="form-group row">
				<div class="col-sm-4">
					<a href="{{route('admin.users.index')}}" class="btn btn-dark btn-md">Back</a>
					<button type="submit" id="submit_form" class="btn btn-info btn-user btn-md">Submit</button>
				</div>
			</div>
		</div>

		@section('inline-js')
		<script>
			    $(document).ready(function() {
				$("#birthday").datepicker({
					changeMonth: true,
					changeYear: true,
					maxDate: 0
				});
			});
		</script>
		@endsection