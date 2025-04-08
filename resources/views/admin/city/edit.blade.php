@extends('layouts.admin')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit City</h5>
		</div>
       <div class="card-body">
            <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
                @csrf
                @method('PUT')
               <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">City <span class="required" aria-required="true">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $city->name) }}" required>
                    </div>
                </div>               
                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{route('admin.cities.index')}}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection


