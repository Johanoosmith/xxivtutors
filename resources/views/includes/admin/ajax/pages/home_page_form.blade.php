
@php
	$home_top_section_title1 = isset($page->home_top_section_title1)? $page->home_top_section_title1 :'';
	$home_top_section_title2 = isset($page->home_top_section_title2)? $page->home_top_section_title2 :'';	
    $home_top_section_title3 = isset($page->home_top_section_title3)? $page->home_top_section_title3 :'';	
    $home_key_features_section_title = isset($page->home_key_features_section_title)? $page->home_key_features_section_title :'';
    $first_key_features_section_heading = isset($page->first_key_features_section_heading)? $page->first_key_features_section_heading :'';
    $first_key_features_section_subheading = isset($page->first_key_features_section_subheading)? $page->first_key_features_section_subheading :'';	
    $second_key_features_section_heading = isset($page->second_key_features_section_heading)? $page->second_key_features_section_heading :'';
    $second_key_features_section_subheading = isset($page->second_key_features_section_subheading)? $page->second_key_features_section_subheading :'';
    $third_key_features_section_heading = isset($page->third_key_features_section_heading)? $page->third_key_features_section_heading :'';
    $third_key_features_section_subheading = isset($page->third_key_features_section_subheading)? $page->third_key_features_section_subheading :'';
    $search_tutors_section_heading = isset($page->search_tutors_section_heading)? $page->search_tutors_section_heading :'';
    $search_tutors_section_subheading = isset($page->search_tutors_section_subheading)? $page->search_tutors_section_subheading :'';
    $browse_subject_section_title = isset($page->browse_subject_section_title)? $page->browse_subject_section_title :'';
    $first_browse_subject_section_heading = isset($page->first_browse_subject_section_heading)? $page->first_browse_subject_section_heading :'';
    $second_browse_subject_section_heading = isset($page->second_browse_subject_section_heading)? $page->second_browse_subject_section_heading :'';
    $third_browse_subject_section_heading = isset($page->third_browse_subject_section_heading)? $page->third_browse_subject_section_heading :'';
    $tutuition_difference_section_title = isset($page->tutuition_difference_section_title)? $page->tutuition_difference_section_title :'';
    $first_tutuition_difference_section_heading = isset($page->first_tutuition_difference_section_heading)? $page->first_tutuition_difference_section_heading :'';
    $first_tutuition_difference_section_subheading = isset($page->first_tutuition_difference_section_subheading)? $page->first_tutuition_difference_section_subheading :'';
    $second_tutuition_difference_section_heading = isset($page->second_tutuition_difference_section_heading)? $page->second_tutuition_difference_section_heading :'';
    $second_tutuition_difference_section_subheading = isset($page->second_tutuition_difference_section_subheading)? $page->second_tutuition_difference_section_subheading :'';
    $third_tutuition_difference_section_heading = isset($page->third_tutuition_difference_section_heading)? $page->third_tutuition_difference_section_heading :'';
    $third_tutuition_difference_section_subheading = isset($page->third_tutuition_difference_section_subheading)? $page->third_tutuition_difference_section_subheading :'';
    $fourth_tutuition_difference_section_heading = isset($page->fourth_tutuition_difference_section_heading)? $page->fourth_tutuition_difference_section_heading :'';
    $fourth_tutuition_difference_section_subheading = isset($page->fourth_tutuition_difference_section_subheading)? $page->fourth_tutuition_difference_section_subheading :'';
    $explore_tutuition_section_title = isset($page->explore_tutuition_section_title)? $page->explore_tutuition_section_title :'';
    $student_explore_tutuition_section_heading = isset($page->student_explore_tutuition_section_heading)? $page->student_explore_tutuition_section_heading :'';
    $student_explore_tutuition_section_subheading = isset($page->student_explore_tutuition_section_subheading)? $page->student_explore_tutuition_section_subheading :'';
    $tutor_explore_tutuition_section_heading = isset($page->tutor_explore_tutuition_section_heading)? $page->tutor_explore_tutuition_section_heading :'';
    $tutor_explore_tutuition_section_subheading = isset($page->tutor_explore_tutuition_section_subheading)? $page->tutor_explore_tutuition_section_subheading :'';
    $tutor_explore_tutuition_section_description = isset($page->tutor_explore_tutuition_section_description)? $page->tutor_explore_tutuition_section_description :'';
    $student_explore_tutuition_section_description = isset($page->student_explore_tutuition_section_description)? $page->student_explore_tutuition_section_description :'';
    $search_tutors_section_description = isset($page->search_tutors_section_description)? $page->search_tutors_section_description :'';
    $explore_your_city_section_title = isset($page->explore_your_city_section_title)? $page->explore_your_city_section_title :'';
@endphp

<h5 class="mt-5">Manage Home Page Banner section</h5>
<hr>
<div class="form-group row">
	<div class="col-sm-4">
		<label class="form-label">Top Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[home_top_section_title1]')->value($home_top_section_title1)->class('form-control form-control-user') }}
	</div>
	<div class="col-sm-4">
		<label class="form-label">Middle Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[home_top_section_title2]')->value($home_top_section_title2)->class('form-control form-control-user') }}
	</div>
    <div class="col-sm-4">
		<label class="form-label">Bottom Heading<span class="required">*</span></label>
		{{ html()->text('pagemeta[home_top_section_title3]')->value($home_top_section_title3)->class('form-control form-control-user') }}
	</div>

</div>
<div class="form-group row">
		<div class="col-sm-4">
				<label class="form-label" for="home_first_section_img1">Banner Image</label>
				<input type="file" name="pagemeta[home_first_section_img1]" id="home_first_section_img1" class="form-control" accept="image/*">
		</div>
		@php
			$home_first_section_img1_alt   = isset($page->home_first_section_img1_alt)? $page->home_first_section_img1_alt :'';
		@endphp
		<div class="col-sm-4">
				<label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
				{{ html()->text('pagemeta[home_first_section_img1_alt]')->value($home_first_section_img1_alt)->id("home_first_section_img1_alt")->class('form-control') }}	     
		</div>
        @if(isset($page) && (file_exists(public_path($page->home_first_section_img1)) && isset($page->home_first_section_img1)))
			<div class="col-sm-2 mt-3">
				<img src="{{url($page->home_first_section_img1)}}" width="50px" alt="">
				<a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_first_section_img1'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
					<i class="fa fa-remove  red-color">X</i>
				</a>
			</div>
		@endif
</div>

<div class="key-featurs">
    <h5 class="mt-5">Manage Home Page Key Features Section</h5>
    <hr>
        <div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label">Title <span class="required">*</span></label>
                {{ html()->text('pagemeta[home_key_features_section_title]')->value($home_key_features_section_title)->class('form-control form-control-user') }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">1st Key Features Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img2">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img2]" id="home_sec_section_img2" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_first_section_img2_alt   = isset($page->home_first_section_img2_alt)? $page->home_first_section_img2_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_first_section_img2_alt]')->value($home_first_section_img2_alt)->id("home_first_section_img2_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img2)) && isset($page->home_sec_section_img2)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img2)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img2'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[first_key_features_section_heading]')->value($first_key_features_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[first_key_features_section_subheading]')->value($first_key_features_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">2st Key Features Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img3">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img3]" id="home_sec_section_img3" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img3_alt   = isset($page->home_sec_section_img3_alt)? $page->home_sec_section_img3_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img3_alt]')->value($home_sec_section_img3_alt)->id("home_sec_section_img3_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img3)) && isset($page->home_sec_section_img3)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img3)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img3'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[second_key_features_section_heading]')->value($second_key_features_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[second_key_features_section_subheading]')->value($second_key_features_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">3st Key Features Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img4">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img4]" id="home_sec_section_img4" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img4_alt   = isset($page->home_sec_section_img4_alt)? $page->home_sec_section_img4_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img4_alt]')->value($home_sec_section_img4_alt)->id("home_sec_section_img4_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img4)) && isset($page->home_sec_section_img4)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img4)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img4'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[third_key_features_section_heading]')->value($third_key_features_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[third_key_features_section_subheading]')->value($third_key_features_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>
</div>

<div class="search-section">
    <h5 class="mt-5">Search for Online Tutors Section</h5>
    <hr>
    <div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label" for="home_sec_section_img5">Image</label>
                <input type="file" name="pagemeta[home_sec_section_img5]" id="home_sec_section_img5" class="form-control" accept="image/*">
        </div>
        @php
            $home_sec_section_img5_alt   = isset($page->home_sec_section_img5_alt)? $page->home_sec_section_img5_alt :'';
        @endphp
        <div class="col-sm-4">
                <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                {{ html()->text('pagemeta[home_sec_section_img5_alt]')->value($home_sec_section_img5_alt)->id("home_sec_section_img5_alt")->class('form-control') }}	     
        </div>
        @if(isset($page) && (file_exists(public_path($page->home_sec_section_img5)) && isset($page->home_sec_section_img5)))
            <div class="col-sm-2 mt-3">
                <img src="{{url($page->home_sec_section_img5)}}" width="50px" alt="">
                <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img5'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                    <i class="fa fa-remove  red-color">X</i>
                </a>
            </div>
        @endif

    </div>
    <div class="form-group row">
    <div class="col-sm-6">
                    <label class="form-label">Heading <span class="required">*</span></label>
                    {{ html()->text('pagemeta[search_tutors_section_heading]')->value($search_tutors_section_heading)->class('form-control form-control-user') }}
        </div>
    </div>
        <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-label">Subheading <span class="required">*</span></label>
            {{ html()->textarea('pagemeta[search_tutors_section_description]')->value($search_tutors_section_description)->class('form-control  summernote')->id("") }} 
        </div>
    </div>
</div>

<div class="browse-subject">
    <h5 class="mt-5">Manage Browse by Subject Section</h5>
    <hr>
        <div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label">Title <span class="required">*</span></label>
                {{ html()->text('pagemeta[browse_subject_section_title]')->value($browse_subject_section_title)->class('form-control form-control-user') }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">1st Browse by Subject Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img6">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img6]" id="home_sec_section_img6" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img6_alt   = isset($page->home_sec_section_img6_alt)? $page->home_sec_section_img6_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img6_alt]')->value($home_sec_section_img6_alt)->id("home_sec_section_img6_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img6)) && isset($page->home_sec_section_img6)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img6)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img6'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[first_browse_subject_section_heading]')->value($first_browse_subject_section_heading)->class('form-control form-control-user') }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">2nd Browse by Subject Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img7">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img7]" id="home_sec_section_img7" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img7_alt   = isset($page->home_sec_section_img7_alt)? $page->home_sec_section_img7_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img7_alt]')->value($home_sec_section_img7_alt)->id("home_sec_section_img7_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img7)) && isset($page->home_sec_section_img7)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img7)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img7'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[second_browse_subject_section_heading]')->value($second_browse_subject_section_heading)->class('form-control form-control-user') }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">3rd Browse by Subject Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img8">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img8]" id="home_sec_section_img8" class="form-control" accept="image/*">
                </div>
                @php
                    $home_sec_section_img8_alt   = isset($page->home_sec_section_img8_alt)? $page->home_sec_section_img8_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img8_alt]')->value($home_sec_section_img8_alt)->id("home_sec_section_img8_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img8)) && isset($page->home_sec_section_img8)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img8)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img8'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[third_browse_subject_section_heading]')->value($third_browse_subject_section_heading)->class('form-control form-control-user') }}
            </div>

        </div>
</div>

<div class="browse-subject">
    <h5 class="mt-5">Manage Explore Your City Section</h5>
    <hr>
        <div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label">Title <span class="required">*</span></label>
                {{ html()->text('pagemeta[explore_your_city_section_title]')->value($explore_your_city_section_title)->class('form-control form-control-user') }}
            </div>
        </div>
</div>
<div class="tutuition-difference">
    <h5 class="mt-5">Manage Tutuition Difference Section</h5>
    <hr>
        <div class="form-group row">
        <div class="col-sm-4">
            <label class="form-label">Title <span class="required">*</span></label>
            {{ html()->text('pagemeta[tutuition_difference_section_title]')->value($tutuition_difference_section_title)->class('form-control form-control-user') }}
        </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">1st Tutuition Difference Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img9">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img9]" id="home_sec_section_img9" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img9_alt   = isset($page->home_sec_section_img9_alt)? $page->home_sec_section_img9_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img9_alt]')->value($home_sec_section_img9_alt)->id("home_sec_section_img9_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img9)) && isset($page->home_sec_section_img9)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img9)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img9'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[first_tutuition_difference_section_heading]')->value($first_tutuition_difference_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[first_tutuition_difference_section_subheading]')->value($first_tutuition_difference_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">2nd Tutuition Difference Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img10">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img10]" id="home_sec_section_img10" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img10_alt   = isset($page->home_sec_section_img10_alt)? $page->home_sec_section_img10_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img10_alt]')->value($home_sec_section_img10_alt)->id("home_sec_section_img10_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img10)) && isset($page->home_sec_section_img10)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img10)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img10'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[second_tutuition_difference_section_heading]')->value($second_tutuition_difference_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[second_tutuition_difference_section_subheading]')->value($second_tutuition_difference_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">3rd Tutuition Difference Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img11">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img11]" id="home_sec_section_img11" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img11_alt   = isset($page->home_sec_section_img11_alt)? $page->home_sec_section_img11_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img11_alt]')->value($home_sec_section_img11_alt)->id("home_sec_section_img11_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img11)) && isset($page->home_sec_section_img11)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img11)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img11'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[third_tutuition_difference_section_heading]')->value($third_tutuition_difference_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[third_tutuition_difference_section_subheading]')->value($third_tutuition_difference_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-12">
            <h6 class="mt-5">4th Tutuition Difference Section</h6>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-sm-4">
                        <label class="form-label" for="home_sec_section_img12">Image</label>
                        <input type="file" name="pagemeta[home_sec_section_img12]" id="home_sec_section_img12" class="form-control" accept="image/*">
                </div>
                
                @php
                    $home_sec_section_img12_alt   = isset($page->home_sec_section_img12_alt)? $page->home_sec_section_img12_alt :'';
                @endphp
                <div class="col-sm-4">
                        <label class="form-label" for="home_first_section_img1_alt">First Image Alt Text</label>
                        {{ html()->text('pagemeta[home_sec_section_img12_alt]')->value($home_sec_section_img12_alt)->id("home_sec_section_img12_alt")->class('form-control') }}	     
                </div>
                @if(isset($page) && (file_exists(public_path($page->home_sec_section_img12)) && isset($page->home_sec_section_img12)))
                    <div class="col-sm-2 mt-3">
                        <img src="{{url($page->home_sec_section_img12)}}" width="50px" alt="">
                        <a href="{{ Route('admin.delete-pagemeta-image', ['id' => $page->id, 'imagename' => 'home_sec_section_img12'] ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                            <i class="fa fa-remove  red-color">X</i>
                        </a>
                    </div>
                @endif
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="form-label">Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[fourth_tutuition_difference_section_heading]')->value($fourth_tutuition_difference_section_heading)->class('form-control form-control-user') }}
            </div>
            <div class="col-sm-6">
                <label class="form-label">Sub Heading <span class="required">*</span></label>
                {{ html()->text('pagemeta[fourth_tutuition_difference_section_subheading]')->value($fourth_tutuition_difference_section_subheading)->class('form-control form-control-user') }}
            </div>

        </div>
</div>
<div class="explore-tutuition">
    <h5 class="mt-5">Manage Explore Tutuition Section</h5>
    <hr>
        <div class="form-group row">
        <div class="col-sm-4">
                <label class="form-label">Title <span class="required">*</span></label>
                {{ html()->text('pagemeta[explore_tutuition_section_title]')->value($explore_tutuition_section_title)->class('form-control form-control-user') }}
            </div>
        </div>
        <div class="student-explore">
            <div class="form-group row">
                <div class="col-sm-12">
                <h6 class="mt-5">Student</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Heading <span class="required">*</span></label>
                    {{ html()->text('pagemeta[student_explore_tutuition_section_heading]')->value($student_explore_tutuition_section_heading)->class('form-control form-control-user') }}
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Sub Heading <span class="required">*</span></label>
                    {{ html()->text('pagemeta[student_explore_tutuition_section_subheading]')->value($student_explore_tutuition_section_subheading)->class('form-control form-control-user') }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class="form-label">Key Point <span class="required">*</span></label>
                    {{ html()->textarea('pagemeta[student_explore_tutuition_section_description]')->value($student_explore_tutuition_section_description)->class('form-control  summernote')->id("") }} 
                </div>
            </div>
        </div>
        <div class="student-explore">
                <div class="form-group row">
                    <div class="col-sm-12">
                    <h6 class="mt-5">Tutor</h6>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label">Heading <span class="required">*</span></label>
                        {{ html()->text('pagemeta[tutor_explore_tutuition_section_heading]')->value($tutor_explore_tutuition_section_heading)->class('form-control form-control-user') }}
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Sub Heading <span class="required">*</span></label>
                        {{ html()->text('pagemeta[tutor_explore_tutuition_section_subheading]')->value($tutor_explore_tutuition_section_subheading)->class('form-control form-control-user') }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="form-label">Key Point <span class="required">*</span></label>
                        {{ html()->textarea('pagemeta[tutor_explore_tutuition_section_description]')->value($tutor_explore_tutuition_section_description)->class('form-control  summernote')->id("") }} 
                    </div>
                </div>
        </div>
   
</div>

