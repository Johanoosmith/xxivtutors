@extends('layouts.admin')
@section('title') Edit Email Template @endsection
@section('inline-css')
@endsection
@section('content')
<!-- Page Heading -->

<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Update Email Template</h5>
			</div>
			<div class="card-body">
				
			{{ html()->modelForm($emailtemplate,'PATCH',route('admin.emailtemplates.update',$emailtemplate->id))->class('validatedForm')->id('emailtemplate_form')->open() }}
				{{ csrf_field() }}
				@include('includes.admin.emailtemplate.form')
			{{ html()->form()->close() }}
		</div>
</div>
@endsection
@section('inline-js')
@include('includes.admin.summernote') 
<script>
    jQuery('.validatedForm').validate();
</script>

@endsection