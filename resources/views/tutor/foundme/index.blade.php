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
                    <p>Here you can view <a href="{{ route('tutor', ['id' => $user->id]) }}">your profile</a> 
                    statistics such as the amount of times you profile has been viewed. </p>

                    <div class="title-with-link-wrapper">
                        <h3>Overall Statistics</h3>
                    </div>
                    <p>Overall statistics show your weekly, monthly and all time profile views.</p>

                    <div class="table-responsive">
                                @php
                                    $views = getUserViewCounts(auth()->id());
                                @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Total Profile Views</th>
                                    <th class="col-institute">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-qualification"> All Time </td>
                                    <td class="col-institute">{{$views['all_views'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-qualification"> Last 7 Days </td>
                                    <td class="col-institute">{{ $views['last_7_days'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-qualification"> This Month  </td>
                                    <td class="col-institute">{{ $views['current_month'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-qualification">Last Month</td>
                                    <td class="col-institute">{{ $views['last_2_months'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Your Profile has been tagged <strong>0 times</strong>. </p>
                    </div>

                    <div class="title-with-link-wrapper">
                        <h3>Last 14 Daily Statistics</h3>
                    </div>
                    <p>Below are total daily profile views you've had for the past 14 days, this report includes non-logged in users.</p>

                    <div class="table-responsive">
                                @php
                                    $views = getUserViewCounts(auth()->id());
                                @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Date</th>
                                    <th class="col-institute">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $dailyViews = getlastforteenView(auth()->id());
                                    @endphp
                                    @foreach ($dailyViews as $view)
                                        <tr>
                                            <td  class="col-qualification">
                                                @if (\Carbon\Carbon::parse($view['date'])->isToday())
                                                    Today
                                                @else
                                                    {{ \Carbon\Carbon::parse($view['date'])->format('m/d/Y') }}
                                                @endif
                                            </td>
                                            <td class="col-institute">{{ $view['total_views'] }}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>  
                    
                    <div class="title-with-link-wrapper">
                        <h3>Who's Viewed My Profile</h3>
                    </div>
                    <p>Below we show the previous 60 member visits to your profile page, you can contact the user by pressing the contact button next to their name. We only display each user once, by displaying their most recent visit date.</p>

                    <div class="table-responsive">
                                @php
                                    $views = getUserViewCounts(auth()->id());
                                @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Name</th>
                                    <th class="col-institute">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($user_views as $view)
                                    <tr style="height: 38px;">
                                        <td>
                                            <a href="{{ route('profile', $view->viewer_id) }}">{{ $view->viewer->firstname ?? 'N/A' }} {{ $view->viewer->lastname ?? 'N/A' }}</a>
                                        </td>
                                        <td>{{ optional($view->viewer)->created_at ? $view->viewer->created_at->format('d-m-Y') : 'N/A' }}</td>
                                        <td class="mobno">
                                            <div class="infobut" style="position: relative; top: -4px;">
                                                <a href="{{ route('profile', $view->viewer_id) }}">contact</a>
                                        </div>
                                        </td>
                                        <td class="mobno">
                                            <div class="infobut" style="position: relative; top: -4px;">
                                                <a href="{{ route('profile', $view->viewer_id) }}">profile</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- @foreach ($dailyViews as $view)
                                        <tr>
                                            <td  class="col-qualification">
                                                @if (\Carbon\Carbon::parse($view['date'])->isToday())
                                                    Today
                                                @else
                                                    {{ \Carbon\Carbon::parse($view['date'])->format('m/d/Y') }}
                                                @endif
                                            </td>
                                            <td class="col-institute">{{ $view['total_views'] }}</td>
                                        </tr>
                                    @endforeach -->
                            </tbody>
                        </table>
                    </div>  
        </div>
        </div>
    </div>
    </section>
    
</main>

@endsection
