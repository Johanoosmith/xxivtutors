@extends('layouts.admin')

@section('title') Add Notification Template @endsection

@section('inline-css')
@endsection

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Create Notification Template</h5>
		</div>
		<div class="card-body">
			{{ html()->form('POST', route('admin.notification-templates.store'))->class('validatedForm')->id('notificationtemplate_form')->open() }}
				@csrf

				<div class="form-group row">
					<div class="col-sm-6">
						<label class="form-label">Name <span class="required">*</span></label>
						{{ html()->text('name')->class('form-control')->value(old('name')) }}
						@if ($errors->has('name'))
							<span class="error text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>

					<div class="col-sm-6">
						<label class="form-label">Email Subject <span class="required">*</span></label>
						{{ html()->text('subject')->class('form-control')->value(old('subject')) }}
						@if ($errors->has('subject'))
							<span class="error text-danger">{{ $errors->first('subject') }}</span>
						@endif
					</div>
				</div>

				@php
					$siteVars = getSiteVariable();
				@endphp

				<p>{site_name}: {{ $siteVars['site_name'] }}</p>
				<p>{support_email}: {{ $siteVars['support_email'] }}</p>

				<div class="form-group row mt-3">
					<div class="col-sm-12">
						<label class="form-label">Email Body <span class="required">*</span></label>
						{{ html()->textarea('email_body')->class('form-control summernote')->value(old('email_body')) }}
						@if ($errors->has('email_body'))
							<span class="error text-danger">{{ $errors->first('email_body') }}</span>
						@endif
					</div>
				</div>

				<div class="form-group row mt-4">
					<div class="col-sm-4">
						<a href="{{ route('admin.notification-templates.index') }}" class="btn btn-dark">Back</a>
						<button type="submit" class="btn btn-success">Submit</button>
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
