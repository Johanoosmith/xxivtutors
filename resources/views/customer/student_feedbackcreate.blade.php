@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                <div class="col dashboard-content">
                    <h2>Submit Feedback for {{ $tutor->name }}</h2>
                    @include('elements.alert_message')
                    <form class="edit-form" action="{{ route('student.feedback.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">

                        <div class="row">
                        <div class="col-md-12 form-field">
                            <label class="form-label">Tutor Name</label>
                            <input type="text" class="form-control" value="{{ $tutor->username }}" readonly>
                        </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label">Site Rating (1-5)</label>
                                <select name="site_rating" class="form-control" required>
                                    <option value="">Select Rating</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label">Tutor Rating (1-5)</label>
                                <select name="tutor_rating" class="form-control" required>
                                    <option value="">Select Rating</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label">Your Feedback</label>
                                <textarea name="content" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">Submit Feedback</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
