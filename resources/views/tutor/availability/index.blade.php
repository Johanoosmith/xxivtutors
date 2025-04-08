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
                    <form action="{{ route('tutor.availability.updateAvailability') }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('elements.alert_message')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Morning</th>
                                    <th>Afternoon</th>
                                    <th>After School</th>
                                    <th>Evening</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <tr>
                                <td>{{ $day }}</td>
                                @foreach(['Morning', 'Afternoon', 'After School', 'Evening'] as $slot)
                                <td>
                                    <input type="checkbox" name="availability[{{ $day }}][{{ $slot }}]" value="1"
                                        @if(isset($availabilities[$day][$slot]) && $availabilities[$day][$slot] == true) checked @endif>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-green">Update Availability</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    
</main>

@endsection
