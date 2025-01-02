
@php
	$top_section_heading = isset($page->top_section_heading)? $page->top_section_heading :'';
    $top_section_subheading = isset($page->top_section_subheading)? $page->top_section_subheading :'';
    $address_section_heading = isset($page->address_section_heading)? $page->address_section_heading :'';
    $address_section_subheading = isset($page->address_section_subheading)? $page->address_section_subheading :'';
    $address_section_address = isset($page->address_section_address)? $page->address_section_address :'';
    $address_section_phone = isset($page->address_section_phone)? $page->address_section_phone :'';
    $address_section_mail = isset($page->address_section_mail)? $page->address_section_mail :'';
    $address_section_address2 = isset($page->address_section_address2)? $page->address_section_address2 :'';
    
@endphp
<h5 class="mt-5">Manage Top Section</h5>
<hr> 
<div class="form-group row">
	<div class="col-sm-6">
		<label class="form-label">Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[top_section_heading]')->value($top_section_heading)->class('form-control form-control-user') }}
	</div>
    <div class="col-sm-6">
		<label class="form-label">Subheading<span class="required">*</span></label>
		{{ html()->text('pagemeta[top_section_subheading]')->value($top_section_subheading)->class('form-control form-control-user') }}
	</div>
</div>
<div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="address_section_address_img14">Background Image</label>
                        <input type="file" name="pagemeta[address_section_address_img14]" id="address_section_address_img14" class="form-control" accept="image/*">
                </div>
                @php
                    $address_section_address_img14_alt   = isset($page->address_section_address_img14_alt)? $page->address_section_address_img14_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="address_section_address_img14_alt">Image Alt Text</label>
                        {{ html()->text('pagemeta[address_section_address_img14_alt]')->value($address_section_address_img14_alt)->id("address_section_address_img14_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->address_section_address_img14)) && isset($page->address_section_address_img14)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->address_section_address_img14)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'address_section_address_img14'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
<h5 class="mt-5">Manage Contact Information</h5>
<hr> 
<div class="form-group row">
	<div class="col-sm-4">
		<label class="form-label">Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[address_section_heading]')->value($address_section_heading)->class('form-control form-control-user') }}
	</div>
    <div class="col-sm-4">
		<label class="form-label">Subheading<span class="required">*</span></label>
		{{ html()->text('pagemeta[address_section_subheading]')->value($address_section_subheading)->class('form-control form-control-user') }}
	</div>
</div>
   <div class="form-group row">
        <div class="col-sm-4">
            <label class="form-label">Address1<span class="required">*</span></label>
            {{ html()->text('pagemeta[address_section_address]')->value($address_section_address)->class('form-control form-control-user') }}
        </div>
        <div class="col-sm-4">
            <label class="form-label">Address2<span class="required">*</span></label>
            {{ html()->text('pagemeta[address_section_address2]')->value($address_section_address2)->class('form-control form-control-user') }}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label class="form-label">Phone number<span class="required">*</span></label>
            {{ html()->text('pagemeta[address_section_phone]')->value($address_section_phone)->class('form-control form-control-user') }}
        </div>
        <div class="col-sm-4">
                <label class="form-label">Email Address<span class="required">*</span></label>
                {{ html()->text('pagemeta[address_section_mail]')->value($address_section_mail)->class('form-control form-control-user') }}
            </div>
    </div>
 
    <h5 class="mt-5">Manage Right Side Image</h5>
    <hr>
    <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="address_section_address_img13">Image</label>
                        <input type="file" name="pagemeta[address_section_address_img13]" id="address_section_address_img13" class="form-control" accept="image/*">
                </div>
                @php
                    $address_section_address_img13_alt   = isset($page->address_section_address_img13_alt)? $page->address_section_address_img13_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="address_section_address_img13_alt">Image Alt Text</label>
                        {{ html()->text('pagemeta[address_section_address_img13_alt]')->value($address_section_address_img13_alt)->id("address_section_address_img13_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->address_section_address_img13)) && isset($page->address_section_address_img13)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->address_section_address_img13)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'address_section_address_img13'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>