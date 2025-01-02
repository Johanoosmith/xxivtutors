<div class="card-body p-0">
	<div class="p-5">
		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">First Name <span class="required">*</span></label>				
				{{ html()->text('firstname')->class('form-control form-control-user required') }}
				@if ($errors->has('firstname'))
				<span class="error" role="alert">{{ $errors->first('firstname') }}</span>
				@endif
			</div>
			<div class="col-md-4 pt-4">
				<label class="form-label">Last Name</label>
				{{ html()->text('lastname')->class('form-control form-control-user required') }}
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Username / Email <span class="required">*</span></label>				
				{{ html()->text('email')->class('form-control form-control-user required') }}
				@if ($errors->has('email'))
				<span class="error" role="alert">{{ $errors->first('email') }}</span>
				@endif
			</div>

			<div class="col-md-4 pt-4">
				<label class="form-label">Date of Birth <span class="required">*</span></label>
				{{ html()->text('birthday')->class('form-control form-control-user required')->id('birthday') }}
				@if ($errors->has('birthday'))
				<span class="error" role="alert">{{ $errors->first('birthday') }}</span>
				@endif
			</div>
		</div>


		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Address</label>			
				{{ html()->text('address')->class('form-control form-control-user required') }}
			</div>

			<div class="col-md-4 pt-4">
				<label class="form-label">Phone</label>
				{{ html()->text('mobile')->class('form-control form-control-user required') }}
				
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Website URL</label>
				{{ html()->text('weburl')->class('form-control form-control-user required') }}
				
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 pt-4">
				<label class="form-label">About Profile (Max length 250 characters)</label>				
				{{ html()->textarea('about')->class('form-control form-control-user required') }}
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Profile Image</label>
				<input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
			</div>
			@if(isset($user) && isset($user->image))
			@if(file_exists(public_path($user->image)))
			<div class="col-md-4 pt-5">
				<img src="{{url($user->image)}}" width="60px">
				<a href="{{ Route('admin.delete-user-image', $user->id ) }}" onclick="confirmation(event)"
					class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
					<i class="fa fa-remove  red-color">X</i> </a>
			</div>
			@endif
			@endif
		</div>

		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Banner Image</label>
				<input type="file" name="banner_image" class="form-control" accept="image/png, image/gif, image/jpeg">
			</div>
			@if(isset($user) && isset($user->banner_image))
			@if(file_exists(public_path($user->banner_image)))
			<div class="col-md-4 pt-5">
				<img src="{{url($user->banner_image)}}" width="100px" height="50px">
				<a href="{{ Route('admin.delete-user-banner-image', $user->id ) }}" onclick="confirmation(event)"
					class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
					<i class="fa fa-remove  red-color">X</i> </a>
			</div>
			@endif
			@endif
		</div>

		@if(!empty($user))
		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Password </label>
				<input id="password" type="password" class="form-control" name="password">

			</div>
		</div>
		@else
		<div class="row">
			<div class="col-md-4 pt-4">
				<label class="form-label">Password <span class="required">*</span></label>				
				{{ html()->text('password')->class('form-control form-control-user required') }}
				@if ($errors->has('password'))
				<span class="error" role="alert">{{ $errors->first('password') }}</span>
				@endif
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-md-4 pt-4">
				@php
				$status_options = [
				'1' => 'Active',
				'0' => 'Deactive',
				];
				@endphp
				<label class="form-label">Status <span class="required">*</span></label>
			
				{{ html()->select('status', $status_options)->class('form-control required')->id('status')  }}	
			</div>
		</div>

	</div>
</div>
<div class="card-footer">
	<div class="row">
		<div class="col-sm-4">
			<a href="{{route('admin.users.index')}}" class="btn btn-dark btn-md">Back</a>
			<button type="submit" id="submit_form" class="btn btn-info btn-user btn-md">Submit</button>
		</div>
	</div>
</div>

@section('inline-js')
<script>
	$(function () {
		$("#birthday").datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate: 0
		});
	});
</script>
@endsection