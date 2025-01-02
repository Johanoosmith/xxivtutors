@extends('layouts.admin')
@section('title') General Settings @endsection
@section('inline-css')
@endsection
@section('content')
<div class="pcoded-content">              
	<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Manage Header Logo and Favicon</h5>
				</div>
			@if(session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif
			<div class="card-body">
			<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="validatedForm" id="user_form" novalidate="novalidate">
				@csrf
				@method('PUT')

				<div class="form-group row">
				<div class="col-sm-6">
					<label for="" class="form-label">Header Logo<span class="required" aria-required="true">*</span></label>
					<input type="file" name="" id="" class="form-control form-control-user required">
					@if(!empty($setting['']))
						<img src="{{ asset('storage/' . $setting['']) }}" alt="Header Logo" width="100">
					@endif
					</div>
				</div>

				<div class="form-group row">
				<div class="col-sm-6">
					<label for="favicon" class="form-label">Favicon<span class="required" aria-required="true">*</span></label>
					<input type="file" name="favicon" id="favicon" class="form-control form-control-user required">
					@if(!empty($setting['favicon']))
						<img src="{{ asset('storage/' . $setting['favicon']) }}" alt="Favicon" width="32">
					@endif
					</div>
				</div>
				<div class="form-group row">
                    <div class="col-sm-4">
                        <a href="#" class="btn btn-dark btn-md">Back</a>&nbsp;
                        <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Save Changes</button>      
                    </div>
                </div>
				
			</form>
			</div>
			</div>
	</div>
</div>
@endsection

@section('inline-js')

@endsection