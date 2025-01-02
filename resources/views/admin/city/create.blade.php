@extends('layouts.admin')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Add City</h5>
		</div>
       <div class="card-body">
            <form class="validatedForm" method="POST" action="{{ route('admin.cities.store') }}" id="user_form" novalidate="novalidate">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">City <span class="required" aria-required="true">*</span></label> 
                        {{ html()->text('name')->class('form-control form-control-user required') }}
                        @if ($errors->has('page_url'))
                            <span class="error" role="alert">{{ $errors->first('page_url') }}</span>
                        @endif
                    </div>
                </div>               
                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
                    </div>
                </div>
            </form>
       </div>
    </div>
</div>
@endsection
