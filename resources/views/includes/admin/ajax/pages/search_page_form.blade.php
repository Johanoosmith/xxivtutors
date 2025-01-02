
@php
	$search_top_section_title1 = isset($page->search_top_section_title1)? $page->search_top_section_title1 :'';
	$search_top_section_title2 = isset($page->search_top_section_title2)? $page->search_top_section_title2 :'';
    $browse_by_location_title1 = isset($page->browse_by_location_title1)? $page->browse_by_location_title1 :'';
	$browse_by_subject_title1 = isset($page->browse_by_subject_title1)? $page->browse_by_subject_title1 :'';		
    
@endphp

<h5 class="mt-5">Manage Search Page section</h5>
<hr>
<div class="form-group row">
	<div class="col-sm-4">
		<label class="form-label">Top Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[search_top_section_title1]')->value($search_top_section_title1)->class('form-control form-control-user') }}
	</div>
	<div class="col-sm-4">
		<label class="form-label">Sub Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[search_top_section_title2]')->value($search_top_section_title2)->class('form-control form-control-user') }}
	</div>
</div>
<div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label" for="search_img14">Background Image</label>
                <input type="file" name="pagemeta[search_img14]" id="search_img14" class="form-control" accept="image/*">
        </div>
        @php
            $search_img14_alt   = isset($page->search_img14_alt)? $page->search_img14_alt :'';
        @endphp
        <div class="col-sm-4">
                <label class="form-label" for="search_img14_alt">Image Alt Text</label>
                {{ html()->text('pagemeta[search_img14_alt]')->value($search_img14_alt)->id("search_img14_alt")->class('form-control') }}	     
        </div>
        @if(isset($page) && (file_exists(public_path($page->search_img14)) && isset($page->search_img14)))
            <div class="col-sm-2 mt-3">
                <img src="{{url($page->search_img14)}}" width="50px" alt="">
                <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'search_img14'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                    <i class="fa fa-remove  red-color">X</i>
                </a>
            </div>
        @endif
</div>
<h5 class="mt-5">Manage Browse By Location section</h5>
<hr>
<div class="form-group row">
	<div class="col-sm-4">
		<label class="form-label">Title<span class="required">*</span></label>
		{{ html()->text('pagemeta[browse_by_location_title1]')->value($browse_by_location_title1)->class('form-control form-control-user') }}
	</div>
</div>
<h5 class="mt-5">Manage Browse By Subjects section</h5>
<hr>
<div class="form-group row">
<div class="col-sm-4">
		<label class="form-label">Title<span class="required">*</span></label>
		{{ html()->text('pagemeta[browse_by_subject_title1]')->value($browse_by_subject_title1)->class('form-control form-control-user') }}
</div>
</div>