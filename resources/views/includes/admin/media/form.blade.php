<div class="card-body p-0">
<div class="p-5">	
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<div class="form-group row">
		<div class="col-sm-6">
				<label class="form-label">Title <span class="required">*</span></label>    
				{!! Form::text('title',null,['class'=>'form-control required'])!!}										
				@if ($errors->has('title'))
					<span class="error" role="alert">{{ $errors->first('title') }}</span>
				@endif
		</div>
	</div>
	@php $required = 'required';  @endphp
	@if(isset($media) && isset($media->image_path))
		@if(file_exists(public_path($media->image_path)))
				@php $required = '';  @endphp
		@endif
	@endif
	<div class="form-group row">
		<div class="col-sm-6">
				<label class="form-label">Image <span class="required">*</span></label>        			
				<input type="file" name="image" class="form-control {{$required}}" accept="image/png, image/gif, image/jpeg" >
		</div>
		@if(isset($media) && isset($media->image_path))
			@if(file_exists(public_path($media->image_path)))
				<div class="col-sm-6">								
						<img src="{{url($media->image_path)}}" width="100px">
						<a href="{{ Route('admin.delete-media-image', $media->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
							<i class="fa fa-remove  red-color">X</i> </a>
				</div>
			@endif
		@endif
	</div>


<div class="row">
	<div class="col-md-4 pt-4">
		@php 
			$status_options = [
				'1' => 'Active',
				'0' => 'Deactive',						
			];						
		@endphp
		<label class="form-label">Status <span class="required">*</span></label> 
		{{ Form::select('status', $status_options, null, array('class' => 'form-control required')) }}	
	</div>
</div>
 </div>
</div>     

<div class="card-footer">
	<div class="row">
		<div class="col-sm-4">
			<a href="{{route('admin.media.index')}}"  class="btn btn-dark btn-md">Back</a>
			<button type="submit" id="submit_form" class="btn btn-info btn-user btn-md">Submit</button>      
		</div>
	</div>
</div> 