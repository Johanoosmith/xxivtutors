@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit Level</h5>
		</div>
       <div class="card-body">
       <form class="validatedForm" action="{{ route('admin.levels.update', $level->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                        <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ old('title', $level->title) }}"  required>
                    </div>
                </div>
				
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="level">Status</label>
						<input
							type="checkbox"
							name="status"
							@checked(old('status', 1))
						/>
					</div>
				</div>
				
			
            <!-- Buttons: Back and Submit -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.levels.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                    <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Update Level</button>      
                </div>
            </div>
        </form>
       </div>
    </div>
</div>

@endsection

