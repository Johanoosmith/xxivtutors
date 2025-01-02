
	
	<div class="form-group row">
		<div class="col-sm-6">
				<label class="form-label">Email Subject <span class="required">*</span></label> 
				{{ html()->text('subject')->class('form-control form-control-user required') }}											
				@if ($errors->has('subject'))
					<span class="error" role="alert">{{ $errors->first('subject') }}</span>
				@endif
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-10">
				<label class="form-label">Email Message <span class="required">*</span></label>    
				{{ html()->textarea('message')->class('form-control form-control-user summernote required') }}		            
				@if ($errors->has('message'))
				<span class="error" role="alert">{{ $errors->first('message') }}</span>
				@endif
		</div>
	</div>

<div class="form-group row">
	<div class="col-sm-4">
		<a href="{{route('admin.emailtemplates.index')}}"  class="btn btn-dark btn-md">Back</a>&nbsp;
		<button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
	</div>
</div>


