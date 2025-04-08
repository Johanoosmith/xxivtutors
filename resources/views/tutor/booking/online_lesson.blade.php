@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('tutor.booking.booking_tabs')
                    
					<p>To schedule an online lesson, create a new booking and select online as the location for the lesson. We leave the choice of platform of online lessons up to you.</p>

					<h4>My Online Experience</h4>

					<p>Please tell us about your online teaching experience, and we will promote your profile on our online directory pages.</p>

					
					<form class="edit-form" action="{{ route('tutor.booking.online_lesson') }}" method="POST">
						@csrf
						@method('POST')
						<div class="row">
							<div class="col-12 form-field">
								<label class="form-label">Your online teaching experience. </label> 
								<textarea name="teaching_experience" class="form-control">{{ old('teaching_experience',$tutor->teaching_experience); }}</textarea>
							</div>
							<div class="col-12 form-field" >
								<label class="form-label">Benefits of learning online </label> 
								<textarea name="learning_online" class="form-control">{{ old('learning_online',$tutor->learning_online); }}</textarea>
							</div>
							
							<div class="col-12 form-field">
								<label class="form-label">Additional comments.</label>
								<textarea name="additional_comments" class="form-control">{{ old('additional_comments',$tutor->additional_comments); }}</textarea>
							</div>
						</div> 
						
						<div class="row">
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
