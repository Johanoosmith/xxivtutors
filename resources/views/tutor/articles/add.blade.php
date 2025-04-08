@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Article Content</h2>
                    <p>Here you can use this page to share resources or articles on your profile with other users.
                         You can use our editor to format your article content. This resource can managed from within the members homepage.</p>
                    <form class="edit-form" action="{{ route('tutor.articles.articlesstore') }}"  method="POST">
                        @csrf
                        @include('elements.alert_message')
                        <div class="row">
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="Article Title">Article Title</label>
                                <input type="text" class="form-control" id="title" value="" name="title">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="first-name">Article Description</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description', $personalinfo->description ?? '') }}" id="description">
                            </div>
                            <div class="col-6 form-field">
								<label class="form-label">Course</label> 
								<select name="course_id" id="DSCourse" class="form-control km-modify-ajax" data-km-link="{{ route('tutor.subjects.get_subject_by_course') }}" data-km-result-box="SubjectByCourse" required>
									<option value="">Choose Course</option>
									@foreach ($courses as $id => $title)
										<option value="{{ $id }}" @selected(old('course_id') == $id)>
											{{ $title }}
										</option>
									@endforeach
								</select>
							</div>
                            <div class="col-6 form-field" >
								<label class="form-label">Subject</label> 
								<select name="subject_id" id="SubjectByCourse" class="form-control" required>
									<option value="">Choose Subject</option>
									@if(!empty($subjects))
										@foreach ($subjects as $id => $title)
											<option value="{{ $id }}" @selected(old('subject_id') == $id)>
												{{ $title }}
											</option>
										@endforeach
									@endif
								</select>
							</div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="postcode">Your Article Content
                                </label>
                                <textarea name="content" class="form-control editor"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">Save</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
