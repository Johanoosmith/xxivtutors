

	
	{{ html()->hidden('template')->value('cms') }}
	<div class="form-group row">
		<div class="col-sm-6">
				<label class="form-label">Title <span class="required">*</span></label> 
				{{ html()->text('title')->class('form-control form-control-user required') }}
				@if ($errors->has('title'))
					<span class="error" role="alert">{{ $errors->first('title') }}</span>
				@endif
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-6">
				<label class="form-label">Slug <span class="required">*</span></label>    
				{{ html()->text('page_url')->class('form-control form-control-user required') }}					
				@if ($errors->has('page_url'))
					<span class="error" role="alert">{{ $errors->first('page_url') }}</span>
				@endif
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4">
			<a href="{{route('admin.pages.index')}}"  class="btn btn-dark btn-md">Back</a>&nbsp;
			<button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
		</div>
	</div>
