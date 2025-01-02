@extends('layouts.admin')
@section('title') Add Page @endsection
@section('inline-css')
@endsection
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Create Page</h5>
		</div>
		<div class="card-body">
			{{ html()->form('POST', route('admin.pages.store'))->class('validatedForm')->id('user_form')->open() }}
				{{ csrf_field() }}
				@include('includes.admin.page.form')
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