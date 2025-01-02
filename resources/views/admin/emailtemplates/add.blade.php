@extends('layouts.admin')
@section('title') Add Email Template @endsection
@section('inline-css')
@endsection
@section('content')


<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Create Email Template</h5>
			</div>
			<div class="card-body">
				
				{{ html()->form('POST', route('admin.emailtemplates.store'))->class('validatedForm')->id('emailtemplate_form')->open() }}
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
