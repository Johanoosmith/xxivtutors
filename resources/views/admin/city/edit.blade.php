@extends('layouts.admin')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit City</h5>
		</div>
       <div class="card-body">
            {{ html()->modelForm($city,'PATCH',route('admin.cities.update',$city->id))->class('validatedForm')->open() }}
            {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">City <span class="required" aria-required="true">*</span></label>
                        {{ html()->text('name')->class('form-control form-control-user required') }}
                        @if ($errors->has('name'))
                            <span class="error" role="alert">{{ $errors->first('name') }}</span>
                        @endif
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


