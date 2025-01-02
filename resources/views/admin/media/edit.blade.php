@extends('layouts.admin')
@section('title') Edit Media @endsection
@section('inline-css')
@endsection
@section('content')
<!-- Page Heading -->
<div class="row">
   <div class="col-lg-12">
	   <div class="card o-hidden border-0 shadow-lg">
			<div class="card-header py-3">
				  <h6 class="m-0 font-weight-bold text-primary">Update Media</h6> 
			</div>
						 
					 {!! Form::model($media, ['method' => 'PATCH','route' => ['admin.media.update',$media->id],'class'=>'validatedForm','id'=>'post_form','files' =>true]) !!}
						@include('includes.admin.media.form')
					 {!! Form::close() !!}					
					
		</div>
	</div>
</div>		
@endsection
@section('inline-js')
@include('includes.admin.summernote') 
<script>
    jQuery('.validatedForm').validate();

	function confirmation(e) {
        e.preventDefault();
        var url = e.currentTarget.getAttribute('href');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            text: 'If you delete this, it will be removed forever.',
            showCancelButton: true,
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#a8dab5',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel please!",
            dangerMode: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    }
</script> 
@endsection