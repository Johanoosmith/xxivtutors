
	<div class="form-group row">
		<div class="col-sm-5">
				<label class="form-label">Text Category <span class="required">*</span></label> 
				{{ html()->select('key_text', $textcatlist)->class('form-control  required')->id('key_text')->disabled("true")  }}			
				@if ($errors->has('key_text'))
					<span class="error" role="alert">{{ $errors->first('key_text') }}</span>
				@endif
		</div>
	</div>
	<div class="form-group row">
	<div class="form-group row">
				<div class="col-sm-10">
						<label class="form-label">Value <span class="required">*</span></label>
							{{ html()->textarea('value')->class('form-control form-control-user short_desc required') }}	
							@if($errors->has("value"))
								<span class="error">{{ $errors->first("value")}}</span>
							@endif          
					</div>
			</div>
	</div>



<div class="form-group row">
	<div class="col-sm-4">
		<a href="{{route('admin.textsettings.index')}}"  class="btn btn-dark btn-md">Back</a>&nbsp;
		<button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
	</div>
</div>

