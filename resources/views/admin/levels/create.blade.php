@extends('layouts.admin')
@section('content')

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add Level</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.levels.store') }}" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ old('title') }}"  required>
                    </div>
                </div>
				
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="level">Status</label>
						<input
							type="checkbox"
							name="status"
							@checked(old('status'))
						/>
					</div>
				</div>
				
				<div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.levels.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Create Level</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
