@extends('layouts.admin')
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add Subject</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.subjects.store') }}" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ old('title') }}"  required>
                    </div>
                </div>
				<!-- Select Subject Field -->
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="subject">Course</label>
						<select name="course_id" class="form-control" required>
							<option value="">Choose Course</option>
							@foreach ($courses as $id => $title)
								<option value="{{ $id }}" @selected(old('id') == $id)>
									{{ $title }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3">
						<label for="subject">Status</label>
						<input
							type="checkbox"
							name="status"
							@checked(old('status'))
						/>
					</div>
					<div class="col-sm-3">
						<label for="subject">Featured</label>
						<input
							type="checkbox"
							name="featured"
							@checked(old('featured'))
						/>
					</div>
				</div>
				
				<div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Create Subject</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
