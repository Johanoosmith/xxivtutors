@extends('layouts.admin')
@section('title') Edit News @endsection
@section('inline-css')
@endsection
@section('content')

<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Edit Text</h5>
			</div>
			<div class="card-body">
				
			{{ html()->modelForm($textsetting,'PATCH',route('admin.textsettings.update',$textsetting->id))->class('validatedForm')->id('news_form')->attribute('enctype', 'multipart/form-data')->open() }}
				{{ csrf_field() }}
				@include('includes.admin.textsetting.form')
			{{ html()->form()->close() }}
		</div>
	</div>
@endsection
@section('inline-js')
<script>
    jQuery('.validatedForm').validate();
</script> 
@endsection