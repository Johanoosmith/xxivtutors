
<div class="form-group row">
	<div class="col-sm-4">
			<label class="form-label">Title<span class="required">*</span></label> 
			{{ html()->text('title')->class('form-control form-control-user required') }}
			@if ($errors->has('title'))
				<span class="error" role="alert">{{ $errors->first('title') }}</span>
			@endif
	</div>

	<div class="col-sm-4">
			<label class="form-label">Slug <span class="required">*</span></label>    
			{{ html()->text('page_url')->class('form-control form-control-user required') }}					
			@if ($errors->has('page_url'))
				<span class="error" role="alert">{{ $errors->first('page_url') }}</span>
			@endif
	</div>
</div>
<div class="form-group row d-none">
	<div class="col-sm-8">
			<label class="form-label">Short Description</label>    
			{{ html()->textarea('short_description')->class('form-control form-control-user short_description') }}
	</div>
</div>

@if($page->template != 'homepage' &&  $page->template != 'order_transport')

	<div class="form-group row">
		<div class="col-sm-10">
				<label class="form-label">Description</label>    
				{{ html()->textarea('description')->class('form-control  summernote')->id("") }}	
		</div>
	</div>
@endif

<div class="form-group row d-none">
    <div class="col-sm-4">
            <label class="form-label">Image</label> 
            <input type="file" name="image" class="form-control" accept="image/*">     
    </div>  
	@if(isset($page) && (file_exists(public_path($page->image)) && isset($page->image)))
		<div class="col-sm-4 mt-3">
			<img src="{{url($page->image)}}" width="100px">
			<a href="{{ Route('admin.delete-page-image', $page->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
				<i class="fa fa-remove  red-color">X</i>
			</a>
		</div>
	@endif   
</div>
	@if (Request::old())											
		@include('includes.admin.ajax.pages.pages_form', ['page'=>'','page_template'=>Request::old('template')])
	@elseif (isset($page) && $page == true)
		
		@include('includes.admin.ajax.pages.pages_form', ['page'=>$page,'page_template'=>$page->template])
	@endif



	<div class="form-group row">
	<div class="col-sm-4">
			<label class="form-label">Status <span class="required">*</span></label>    
			@php $status = Config::get('constants.STATUS'); @endphp
			{{ html()->select('status', $status)->class('form-control required')->id('status')  }}									
			@if ($errors->has('status'))
				<span class="error" role="alert">{{ $errors->first('status') }}</span>
			@endif
	</div>
</div>


	<h5 class="mt-5">Manage SEO</h5>
	<hr>
<div class="form-group row">
	<div class="col-sm-4">
			<label class="form-label">Meta title</label>    
			{{ html()->text('meta_title')->class('form-control form-control-user') }}	
	</div>
</div>

<div class="form-group row mb-5">
	<div class="col-sm-10">
			<label class="form-label">Meta Description</label>    
			{{ html()->textarea('meta_description')->class('form-control form-control-user short_description') }}	
	</div>
</div>

<div class="form-group row">
	<div class="col-sm-4">
		<a href="{{route('admin.pages.index')}}"  class="btn btn-dark btn-md">Back</a>&nbsp;&nbsp;
		<button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
	</div>
</div>





