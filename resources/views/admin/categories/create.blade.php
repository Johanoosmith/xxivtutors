@extends('layouts.admin')
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add Category</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.categories.store') }}" id="user_form" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="name" id="title"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Slug <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="slug" id="title"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
