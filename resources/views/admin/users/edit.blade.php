@extends('layouts.admin')
@section('title') Edit User @endsection
@section('inline-css')
@endsection
@section('content')
<!-- Page Heading -->
	   <div class="col-md-12">
			<div class="card">
                <div class="card-header">
                <h5>Update User</h5>
                </div>
                <div class="card-body"> 
            {{ html()->modelForm($user,'PATCH',route('admin.users.update',$user->id))->class('validatedForm')->id('user_form')->attribute('enctype', 'multipart/form-data')->open() }}
                {{ csrf_field() }}
              
                @if($user->role_id == 2)
                    @include('includes.admin.user.tutor_form')
                @else
                    @include('includes.admin.user.form')
                @endif
            {{ html()->form()->close() }}
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