
@php
	$tutor_section_title1 = isset($page->tutor_section_title1)? $page->tutor_section_title1 :'';
	$tutor_section_subheading = isset($page->tutor_section_subheading)? $page->tutor_section_subheading :'';	
@endphp

<h5 class="mt-5">Manage Tutor section</h5>
<hr>
<div class="form-group row">
	<div class="col-sm-4">
		<label class="form-label">Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[tutor_section_title1]')->value($tutor_section_title1)->class('form-control form-control-user') }}
	</div>
	<div class="col-sm-4">
		<label class="form-label">Sub Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[tutor_section_subheading]')->value($tutor_section_subheading)->class('form-control form-control-user') }}
	</div>
</div>
<div class="form-group row">
		<div class="col-sm-4">
				<label class="form-label" for="search_img15">Background Image</label>
				<input type="file" name="pagemeta[search_img15]" id="search_img15" class="form-control" accept="image/*">
		</div>
		@php
			$search_img15_alt   = isset($page->search_img15_alt)? $page->search_img15_alt :'';
		@endphp
		<div class="col-sm-4">
				<label class="form-label" for="search_img15_alt">Tutor Image Alt Text</label>
				{{ html()->text('pagemeta[search_img15_alt]')->value($search_img15_alt)->id("search_img15_alt")->class('form-control') }}	     
		</div>
        @if(isset($page) && (file_exists(public_path($page->search_img15)) && isset($page->search_img15)))
			<div class="col-sm-2 mt-3">
				<img src="{{url($page->search_img15)}}" width="50px" alt="">
				<a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'search_img15'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
					<i class="fa fa-remove  red-color">X</i>
				</a>
			</div>
		@endif
</div>



