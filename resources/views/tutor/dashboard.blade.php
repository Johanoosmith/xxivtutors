@extends('layouts.cms')
@section('content')
<main>
    <section class="page-banner text-center text-white">
        <div class="banner-img">
            <img src="assets/images/banner.jpg" alt="">
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
            @if (request('tab') == 'profile' || !request('tab'))
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            <div class="col dashboard-content">
                    <h2>Your Personal Information</h2>
                    <div class="profile-tabs">
                        <ul>
                            <li class="active"><a href="#">Edit Profile</a></li>
                        </ul>
                    </div>
                    <form method="post" action="{{ route('customer.profile.update') }}" name="signupform" id="signupform" class="edit-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Please complete the following information to help us build your profile so students can learn more about you.</p>
                            </div>
                            <div class="col-12 form-field">
                                <input type="hidden" name="section" value="profile">
                                <input type="hidden" name="openaccount" id="openaccount" value="yes">
                                <label class="form-label" for="edit-bio">Comments About Tuition You Are Looking For</label>
                                <textarea value="{{ request('comments_about_tuition') }}" class="form-control"  rows="30" cols="11" id="comments" maxlength="6500" name="comments_about_tuition" style="height:210px;">
                                {{ old('comments_about_tuition', $customer->comments_about_tuition ?? '') }}
                                </textarea>
                            </div>
                            <div class="col-12 form-field">
                                <label class="form-label" for="edit-availability">Your Availability</label>
                                <textarea value="{{ request('availability') }}"  name="availability"  class="form-control" id="edit-availability"> {{ old('availability', $customer->availability ?? '') }}
                                </textarea>
                            </div>

                            <div class="col-md-6 form-field">
                                <label class="form-label" for="language">Distance Willing to Travel </label>
                                <div class="select-field">
                                <select name="distance" id="distance" class="form-select">
                                        @foreach([0 => 'Home Only', 1 => '1 mile', 2 => '2 miles', 3 => '3 miles', 4 => '4 miles', 
                                                5 => '5 miles', 8 => '8 miles', 10 => '10 miles', 12 => '12 miles', 15 => '15 miles', 
                                                20 => '20 miles', 30 => '30 miles', 50 => '50 miles'] as $key => $value)
                                            <option value="{{ $key }}" 
                                                {{ (old('distance', $customer->distance ?? 10) == $key) ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg>
                                        <use xlink:href="#caretDown"></use>
                                    </svg>
                                </div>
                            </div>
                            <p><b>
                            *Field not required. </b>
                            <br><br>
                            <button type="submit" class="btn btn-green">Save</button>
                            </p>
                        </div>
                    </form>
                    <div class="title-with-link-wrapper">
                        <h3>Who's Found Me?</h3>
                    </div>
                    <p>Here you can view <a href="/users/1092682158946/">your profile</a> 
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
            @elseif (request('tab') == 'dashboard')
            <div class="dashboard-overview">
                <div class="row">
                    <div class="col-md-4">
                    <h2>Tutor Account</h2>
                        <p class="small">Last Logged in: 29th Jan 2025 11:21
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Profile is Online</h4>
                        <p><a href="#">Switch Offline</a></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Profile Link:</h4>
                        <p>
                            <a href="{{ route('tutor', ['id' => $user->id]) }}" class="text-truncate" target="_blank">
                                www.example.com/tutor/{{ $user->id }}
                            </a>
                        </p>
                    </div>
                </div>
                @php
                    $views = getUserViewCounts(auth()->id());
                @endphp
                <div class="row text-center">
                    <div class="col-6 col-lg-3 dashboard-box">
                        <div class="inner-box bg-info bg-opacity-10">
                            <span class="counting text-info">{{$views['all_views'] }}</span>
                            <p>All Time Views</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 dashboard-box">
                        <div class="inner-box bg-success bg-opacity-10">
                            <span class="counting text-success">{{ $views['last_7_days'] }}</span>
                            <p>Last 7 Days</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 dashboard-box">
                        <div class="inner-box bg-primary bg-opacity-10">
                            <span class="counting text-primary">{{ $views['current_month'] }}</span>
                            <p>This Month</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 dashboard-box">
                        <div class="inner-box bg-danger bg-opacity-10">
                            <span class="counting text-danger">{{ $views['last_2_months'] }}</span>
                            <p>Last Month</p>
                        </div>
                    </div>
                </div>
            </div>        
            @elseif (request('tab') == 'personalinfo')
            <p>personalinfo</p>

            @endif

        </div>
        </div>
    </div>
    </section>
    
</main>

@endsection
