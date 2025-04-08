@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>Your Personal Information</h2>
                    <div class="profile-tabs">
                        <ul>
                            <li class="{{ Request::routeIs('student.personalinfo') ? 'active' : '' }}"><a href="{{ route('student.personalinfo') }}">Personal Info</a></li>
                            <li class="{{ Request::routeIs('student.password') ? 'active' : '' }}"><a href="{{ route('student.password') }}">Password</a></li>
                            <li  class="{{ Request::routeIs('student.myclients') ? 'active' : '' }}"><a href="{{ route('student.myclients') }}">My Clients</a></li>
                            <li  class="{{ Request::routeIs('student.privacy') ? 'active' : '' }}"><a href="{{ route('student.privacy') }}">Privacy</a></li>
                        </ul>
                    </div>
                    <p>Here you can set your privacy settings. This section lets you edit how your profile page can be seen by other student Hunt users. 
                    The <em>Profile Contents</em> section allows you to set what kind of personal information is displayed on your profile. </p>
                </div>
            </div>
        </div>
</section>
@endsection
