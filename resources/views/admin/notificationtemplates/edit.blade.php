@extends('layouts.admin')
@section('title') Edit Notification Template @endsection

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit Notification Template</h5>
		</div>
		<div class="card-body">
			{{ html()->form('PUT', route('admin.notification-templates.update', $notificationTemplate->id))->class('validatedForm')->open() }}
				@csrf

				<div class="form-group row">
					<div class="col-sm-6">
						<label>Name <span class="required">*</span></label>
						{{ html()->text('name', $notificationTemplate->name)->class('form-control') }}
						@error('name') <span class="error">{{ $message }}</span> @enderror
					</div>

					<div class="col-sm-6">
						<label>Email Subject <span class="required">*</span></label>
						{{ html()->text('subject', $notificationTemplate->subject)->class('form-control') }}
						@error('subject') <span class="error">{{ $message }}</span> @enderror
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-12">
						<label>Email Body <span class="required">*</span></label>
						{{ html()->textarea('email_body', $notificationTemplate->email_body)->class('form-control summernote') }}
						@error('email_body') <span class="error">{{ $message }}</span> @enderror
					</div>
				</div>

				<div class="form-group row mt-3">
					<div class="col-sm-4">
						<a href="{{ route('admin.notification-templates.index') }}" class="btn btn-dark">Back</a>
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</div>
			{{ html()->form()->close() }}
		</div>
	</div>
</div>
@endsection

@section('inline-js')
@include('includes.admin.summernote')
@endsection
