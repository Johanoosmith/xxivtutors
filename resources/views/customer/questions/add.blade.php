@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>Ask an Academic Question</h2>
                    <p>- Please do not use this form to contact tutors, we will only approve general questions that are acadmic related and not directed to a particular tutor.</p>
                    <p> - We usually approve new questions within 24 hours.</p>
                    <p> - Please do not include any personal or contact information within your question.</p>
                            @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                            @else(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                            @endif
                    <form class="edit-form" action="{{ route('student.questions.store') }}"  method="POST">
                        @csrf
                        @include('elements.alert_message')
                        <div class="row">
                            <div class="col-6 form-field">
								<label class="form-label">Course</label> 
								<select name="course_id" id="DSCourse" class="form-control km-modify-ajax" data-km-link="{{ route('customer.subjects.get_subject_by_course') }}" data-km-result-box="SubjectByCourse" required>
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
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-field">
                                <label class="form-label" for="title">Question Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="col-md-12 form-field">
                                <label class="form-label" for="postcode">Your Question
                                </label>
                                <textarea name="question" class="form-control editor" ></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">Post Your Question</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
