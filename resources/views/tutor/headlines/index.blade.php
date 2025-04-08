@extends('layouts.cms')
@section('content')
<main>
    <section class="page-banner text-center text-white">
        <div class="banner-img">
            <img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                    <h2>Your Personal Information</h2>
                    <div class="profile-tabs">
                        <ul>
                            <li class="{{ Request::routeIs('tutor.profile.view') ? 'active' : '' }}"><a href="{{ route('tutor.profile.view') }}">Edit Profile</a></li>
                            <li class="{{ Request::routeIs('tutor.qualification') ? 'active' : '' }}"><a href="{{ route('tutor.qualification') }}">Qualifications</a></li>
                            <li  class="{{ Request::routeIs('tutor.myavailability') ? 'active' : '' }}"><a href="{{route('tutor.myavailability')}}">My Availability</a></li>
                            <li  class="{{ Request::routeIs('tutor.headlines') ? 'active' : '' }}"><a href="{{route('tutor.headlines')}}">Headlines</a></li>
                            <li  class="{{ Request::routeIs('tutor.foundme') ? 'active' : '' }}"><a href="{{route('tutor.foundme')}}">Who's Found Me?</a></li>
                        </ul>
                    </div>
                    <form action="{{ route('tutor.headlines.update', $tutor->id) }}" name="signupform" id="signupform" class="edit-form">
                        @csrf
                        @method('PUT')
                        @include('elements.user.alert_message')

                        <div class="row">
                            <div class="col-12">
                            <p>A headline is shown to students in the search results before they click onto your profile. 
                        By default, we display the first 140 characters of your "comments about me" text. By completing a headline below it allows customisable and longer text (up to 200 characters long) to entice our students to click your profile.</p>
                            </div>
                            <div class="col-12 form-field">
                                <input type="hidden" name="section" value="profile">
                                <input type="hidden" name="openaccount" id="openaccount" value="yes">
                                <label class="form-label" for="edit-bio">Headline 1</label>
                                <textarea class="form-control" id="headline" name="headline_text" rows="4">{{ old('headline_text', $headline->headline_text ?? '') }}</textarea>
                            </div>
                            <p><b>
                            <br><br>
                            <button type="submit" class="btn btn-green">Save</button>
                            </p>
                        </div>
                    </form>
        </div>
        </div>
    </div>
    </section>
</main>

@endsection
