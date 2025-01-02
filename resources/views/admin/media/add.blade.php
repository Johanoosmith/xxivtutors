@extends('layouts.admin')
@section('title') Add Media Template @endsection
@section('inline-css')
@endsection
@section('content')
<div class="row">
   <div class="col-lg-12">
	   <div class="card o-hidden border-0 shadow-lg">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Upload Image</h6> 
			</div>
			<div class="card-body p-0">
				<div class="p-1">	
                             {!! Form::open(array('route' => 'admin.media.store','method'=>'POST','class'=>'validatedForm','id'=>'post_form','files'=>true )) !!}
                                @include('includes.admin.media.form')
                            {!! Form::close() !!}
                            <hr>
				</div>
			</div> 
		</div>
	</div>
</div>		

@endsection
@section('inline-js')

<script>
    jQuery('.validatedForm').validate();
</script> 
@endsection
