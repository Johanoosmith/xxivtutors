

@extends('layouts.admin')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Create New Tutor</h5>
        </div> 
    <div class="card-body">   
        <div class="profile">
            <h5>Profile Section</h5>
            <hr> 
           {{ html()->form('POST', route('admin.tutors.store')) ->class('validatedForm')->id('tutor_form')->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label">First Name<span class="required">*</span></label>
                    {{ html()->text('firstname')->class('form-control form-control-user required') }} 
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Last Name<span class="required">*</span></label>
                    {{ html()->text('lastname')->class('form-control form-control-user required') }} 
                </div>
                
            </div>
            <div class="form-group row">
                    <div class="col-sm-4">
                            <label class="form-label" for="address_section_address_img14">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                            <?php /*<input type="file" name="pagemeta[address_section_address_img14]" id="address_section_address_img14" class="form-control" accept="image/*">*/ ?>

                    </div>
                    @php
                        $address_section_address_img14_alt = isset($page->address_section_address_img14_alt)? $page->address_section_address_img14_alt :'';
                    @endphp
                    <div class="col-sm-4">
                        <label class="form-label">Email<span class="required">*</span></label>   
                        {{ html()->text('email')->class('form-control form-control-user required') }}  
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
            <div class="form-group row">
                <div class="col-sm-8">
                    <label class="form-label">Short Description<span class="required">*</span></label>
                    {{ html()->text('short_description')->class('form-control form-control-user short_desc required') }}
                    @if ($errors->has('short-message'))
                    <span class="error" role="alert">{{ $errors->first('short-message') }}</span>
                    @endif
                </div>            
            </div>
            <div class="form-group row">
                <div class="col-sm-8">
                    <label class="form-label">Full Description<span class="required">*</span></label> 
                    {{ html()->text('full_description')->class('form-control form-control-user short_desc required') }}
                    @if ($errors->has('full-message'))
                    <span class="error" role="alert">{{ $errors->first('full-message') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label">Contact<span class="required">*</span></label>
                    {{ html()->text('mobile')->class('form-control form-control-user required') }} 
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Location<span class="required">*</span></label> 
                    {{ html()->text('address')->class('form-control form-control-user required') }} 
    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for ="gender" class="form-label">Gender<span class="required">*</span></label>
                    {{ html()->select('gender', ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])->class('form-control')->value($tutor->gender ?? '') }} 
                </div>
                <div class="col-sm-4">
                    <label class="form-label"  for="postcode">Post code<span class="required">*</span></label> 
                    {{ html()->text('postcode')->class('form-control')->value($tutor->postcode ?? '') }}
                </div>
            </div>
                <div class="form-group row">
                <div class="col-sm-4">
                    <label for="rating">Rating</label>
                    {{ html()->number('rating')->class('form-control')->attribute('step', '0.1')->value($tutor->rating ?? '')->placeholder('e.g., 4.5') }}
                </div>
            </div>
        </div>
            <div class="qualification">
                <h5 class="mt-5">Qualifications Section</h5>
                <hr> 
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label">First<span class="required">*</span></label>
                        {{ html()->text('qualification_1')->class('form-control form-control-user required') }} 
                        </div>
                    <div class="col-sm-4">
                        <label class="form-label">Second<span class="required">*</span></label>   
                        {{ html()->text('qualification_2')->class('form-control form-control-user required') }} 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label">Third<span class="required">*</span></label>
                        {{ html()->text('qualification_3')->class('form-control form-control-user required') }} 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label">Fourth<span class="required">*</span></label>   
                        {{ html()->text('qualification_4')->class('form-control form-control-user required') }} 
                    </div>
                </div>
            </div>
            <div class="other-info">
            <h5 class="mt-5">Other Information</h5>
            <hr>
            <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label">Experience<span class="required">*</span></label>
                        {{ html()->text('experience')->class('form-control form-control-user required') }} 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label">Rate<span class="required">*</span><h8>(hr)</h8></label>   
                        {{ html()->text('rate')->class('form-control form-control-user required') }} 
                    </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-4">
                    <label for="specialization" class="form-label">Select Specializations (Courses):</label>
                    <div id="specialization">
                        @foreach($courses as $course)
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="specialization[]" 
                                    value="{{ $course->id }}" 
                                    id="course_{{ $course->id }}" 
                                    class="form-check-input"
                                    @if(isset($tutor) && $tutor->specialization->contains($course->id)) checked @endif>
                                <label for="course_{{ $course->id }}" class="form-check-label">
                                    {{ $course->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            <div class="col-sm-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ isset($tutor) && $tutor->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ isset($tutor) && $tutor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="password">Password (leave blank to keep current password)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                <a href="{{ route('admin.tutors.index') }}" class="btn btn-dark btn-md">Back</a> 
                <button type="submit" class="btn btn-primary">Register</button>   
                </div>
            </div>
            <br>
        </form>
    </div>
    </div>
@endsection
@section('inline-js')
@include('includes.admin.summernote') 
@endsection