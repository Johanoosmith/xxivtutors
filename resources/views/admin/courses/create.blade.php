@extends('layouts.admin')
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add Course</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.courses.store') }}" id="user_form" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title"  required>
                    </div>
                </div>
                  <!-- Select Level Field -->
                    <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="course">Level</label>
                        <select name="level" id="course" class="form-control" required>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>
                    </div>
                    
                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Create Course</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
