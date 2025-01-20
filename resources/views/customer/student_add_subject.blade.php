@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col dashboard-content">
                    <div class="title-with-link-wrapper">
                        <h2>Add a Subject</h2>
                        <a href="{{ route('customer.student_subject')}}" class="btn btn-yellow btn-small">Back</a>
                    </div>
                    <p>Here you can add a subject, these will be viewable in your profile. It is important that you add each subject you wish to teach otherwise students will not be able to find you while searching.</p>
                    <p class="instruction bg-success text-white">Please do not enter email addresses/urls/websites/home addresses (or any other information that can allow contact) within your profile. Users who do so will immediately be removed from Tutuition.</p>
                    <form class="edit-form" method="POST" action="{{ route('customer.student_add_subject') }}">
                     @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label" for="subject">Subject</label>
                            </div>
                            <div class="col-md-6 form-field">
                                <div class="select-field">
                                    <select class="form-select" id="subject" name="subject">
                                    @foreach ($courses_list as $id => $title)
                                        <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                    </select>
                                    <svg>
                                        <use xlink:href="#caretDown"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-md-6 form-field">
                                <div class="select-field">
                                    <select class="form-select" id="qualification-date" name="qualification-date">
                                    @foreach ($courses_list_level as $id => $level)
                                        <option value="{{ $id }}">{{ $level }}</option>
                                    @endforeach
                                    </select>
                                    <svg>
                                        <use xlink:href="#caretDown"></use>
                                    </svg>
                                </div>
                            </div>
                            <!-- <div class="col-12 form-field">
                                <label class="form-label" for="hourly-rate">Hourly Rate (£):</label>
                                <input type="text" class="form-control" id="hourly-rate" value="">
                            </div>
                            <div class="col-12 form-field">
                                <label class="form-label" for="profile-rate">Profile Rate: (£)</label>
                                <input type="text" class="form-control" id="profile-rate" value="">
                            </div> -->
                            <div class="col-12 form-field">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="overseas-qualification">
                                    <label class="form-check-label" for="overseas-qualification">
                                        Also Teach Online <small>(using online whiteboard)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">Add Subject</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
