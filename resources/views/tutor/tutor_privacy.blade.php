@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
                @else(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
                @endif
                <h2>Your Personal Information</h2>
                <div class="profile-tabs">
                    <ul>
                        <li class="{{ Request::routeIs('tutor.personalinfo') ? 'active' : '' }}"><a href="{{ route('tutor.personalinfo') }}">Personal Info</a></li>
                        <li class="{{ Request::routeIs('tutor.password') ? 'active' : '' }}"><a href="{{ route('tutor.password') }}">Password</a></li>
                        <li class="{{ Request::routeIs('tutor.myclients') ? 'active' : '' }}"><a href="{{ route('tutor.myclients') }}">My Clients</a></li>
                        <li class="{{ Request::routeIs('tutor.privacy') ? 'active' : '' }}"><a href="{{ route('tutor.privacy') }}">Privacy</a></li>
                    </ul>
                </div>
                <p>Here you can set your privacy settings. This section lets you edit how your profile page can be seen by other {{ config('constants.SITE.TITLE') }} users.
                    The <em>Profile Contents</em> section allows you to set what kind of personal information is displayed on your profile. </p>
                <form action="{{ route('tutor.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- List Profile in Directory --}}
                        <div class="form-group col-md-6">
                            <label for="list_profile_directory">List Profile in Directory</label>
                            <select name="list_in_directory" class="form-select">
                                <option value="1" {{ isset($tutor) && $tutor->list_in_directory == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ isset($tutor) && $tutor->list_in_directory == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        {{-- Profile Status --}}
                        <div class="form-group col-md-6">
                            <label for="profile_status">Profile Status</label>
                            <select name="profile_status" class="form-select">
                                <option value="1" {{ isset($tutor) && $tutor->profile_status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ isset($tutor) && $tutor->profile_status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>


                        {{-- Display Postcode --}}
                        <h4 class="mt-4">Profile Contents</h3>
                            <div class="form-group col-md-6 mt-2">
                                <label for="display_postcode">Display Postcode</label>
                                <select name="display_postcode" class="form-select">
                                    <option value="1" {{ ($notification->display_postcode ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->display_postcode ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            {{-- Display Qualification --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="display_qualification">Display Qualification</label>
                                <select name="display_qualification" class="form-select">
                                    <option value="1" {{ ($notification->display_qualification ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->display_qualification ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <h4 class="mt-4"> Email/SMS Communication</h4>

                            {{-- New Enquiry Email --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="new_enquiry_email">New Enquiry Email</label>
                                <select name="new_enquiry_email" class="form-select">
                                    <option value="1" {{ ($notification->new_enquiry_email ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->new_enquiry_email ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            {{-- Email On Profile View --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="email_on_profile_view">Email On Profile View</label>
                                <select name="email_on_profile_view" class="form-select">
                                    <option value="1" {{ ($notification->email_on_profile_view ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->email_on_profile_view ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            {{-- Feedback Email --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="feedback_email">Feedback Email</label>
                                <select name="feedback_email" class="form-select">
                                    <option value="1" {{ ($notification->feedback_email ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->feedback_email ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            {{-- Payment Email --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="payment_email">Payment Email</label>
                                <select name="payment_email" class="form-select">
                                    <option value="1" {{ ($notification->payment_email ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->payment_email ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            {{-- Lesson Reminder Email --}}
                            <div class="form-group col-md-6 mt-2">
                                <label for="lesson_reminder_email" class="form-label">Lesson Reminder Email</label>
                                <select name="lesson_reminder_email" class="form-select">
                                    <option value="1" {{ ($notification->lesson_reminder_email ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($notification->lesson_reminder_email ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>


                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-green">Update</button>
                            </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection