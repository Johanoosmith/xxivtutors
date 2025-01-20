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
            @include('layouts.student_tabs')
            <div class="col dashboard-content">
            @if (request('tab') == 'profile' || !request('tab'))
            <div class="col dashboard-content">
                            <div class="dashboard-overview">
                    <div class="row">
                        <div class="col-md-4">
                       <h2>Profile Information</h2>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>

                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Edit Profile</h2>
                        </div>
                        <form method="post" action="{{ route('customer.profile.update') }}" name="signupform" id="signupform" class="mobtable">
                        @csrf

                            <input type="hidden" name="section" value="profile">
                            <input type="hidden" name="openaccount" id="openaccount" value="yes">
                            <label for="comments">Comments About Tuition You Are Looking For </label>
                            <textarea value="{{ request('comments_about_tuition') }}" class="forminputtextpad" rows="30" cols="11" id="comments" maxlength="6500" name="comments_about_tuition" style="height:210px;">
                            {{ old('comments_about_tuition', $customer->comments_about_tuition ?? '') }}
                            </textarea>
                            <label for="availability">Your Availability</label>
                            <textarea value="{{ request('availability') }}"  class="forminputtextpad" rows="30" cols="11" id="availability" maxlength="6500" name="availability" style="height:210px;">
                            {{ old('availability', $customer->availability ?? '') }}
                            </textarea>
                            <div class="columnsplit">
                                <div class="columnsplititem">
                                </div>
                                <div class="columnsplititem">
                                    <label for="distance">Distance Willing to Travel </label>
                                    <select name="distance" id="distance" class="forminputtextpad">
                                        @foreach([0 => 'Home Only', 1 => '1 mile', 2 => '2 miles', 3 => '3 miles', 4 => '4 miles', 
                                                5 => '5 miles', 8 => '8 miles', 10 => '10 miles', 12 => '12 miles', 15 => '15 miles', 
                                                20 => '20 miles', 30 => '30 miles', 50 => '50 miles'] as $key => $value)
                                            <option value="{{ $key }}" 
                                                {{ (old('distance', $customer->distance ?? 10) == $key) ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <p><b>
                            *Field not required. </b>
                            <br><br>
                            <button type="submit" class="btn btn-green">Save</button>
                            </p>
                        </form>
                        <div class="col-md-6">
                        <h2>Who's Found Me?</h2>  
                        </div>
                        <div class="who-found">
                            <div class="tabcontent active">
                                <p>Here you can view 
                                    <a href="/users/1092682158946/">your profile</a> 
                                    statistics such as the amount of times you profile has been viewed. 
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="cardheader">
                            <h2 class="cardtitle">Overall Statistics </h2>
                            </div>
                            <div class="cardcontent">
                            <p>
                            Overall statistics show your weekly, monthly and all time profile views. 
                            </p>
                            </div>
                            <div class="cardtable tablewrap">
                                @php
                                    $views = getUserViewCounts(auth()->id());
                                @endphp
                                <table width="650" class="table tablestriped" style="margin-left: 0;">
                                    <tbody><tr>
                                    <th width="31%">
                                    Total Profile Views </th>
                                    <th>
                                    Views </th>
                                    </tr>
                                    <tr>
                                    <td>
                                    All Time </td>
                                    <td>{{$views['all_views'] }}</td>
                                    </tr>
                                    <tr>
                                    <td>
                                    Last 7 Days </td>
                                    <td>{{ $views['last_7_days'] }}</td>
                                    </tr>
                                    <tr>
                                    <td>
                                    This Month </td>
                                    <td>{{ $views['current_month'] }}</td>
                                    </tr>
                                    <tr>
                                    <td>
                                    Last Month </td>
                                    <td>{{ $views['last_2_months'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>	
                            <div class="cardcontent">
                            <p>Your Profile has been tagged <strong>0 times</strong>. </p>
                            </div>   
                        </div>
                        <div class="card">
                            <div class="cardheader">
                            <h2 class="cardtitle">Who's Viewed My Profile</h2>
                            </div>
                            <div class="cardcontent">
                                <p>
                                Below we show the previous 60 member visits to your profile page, you can contact the user by pressing the contact button next to their name. We only display each user once, by displaying their most recent visit date. 
                                </p>
                            </div>
                            <div class="cardtable tablewrap">
                                <table class="table tablestriped">
                                    <tbody>
                                            <tr>
                                            <th>Name </th>
                                            <th>Date </th>
                                            <th width="70" class="mobno"></th>
                                            <th width="70" class="mobno"></th>
                                            </tr>
                                            <!-- <tr style="height: 38px;">
                                                <td>
                                                <img src="/images/icon-user.png" title="*" alt="*" style="position:relative; top: 2px;">&nbsp;<a href="/users/4453119993209/">Stephanie (Mrs)</a>
                                                </td>
                                                <td>26/12/2024</td>
                                                <td class="mobno">
                                                    <div class="infobut" style="position: relative; top: -4px;">
                                                    <a href="/compose.asp?to=4453119993209">contact</a>
                                                    </div>
                                                </td>
                                                <td class="mobno">
                                                    <div class="infobut" style="position: relative; top: -4px;">
                                                        <a href="/users/4453119993209/">profile</a>
                                                    </div>
                                                </td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="cardheader">
                            <h2 class="cardtitle">Last 14 Daily Statistics </h2>
                            </div>
                            <div class="cardcontent">
                              <p>Below are total daily profile views you've had for the past 14 days, this report includes non-logged in users. </p>
                            </div>
                        <div class="cardtable tablewrap">
                            <table width="650" class="table tablestriped" style="margin-left: 0;">
                                <tbody>
                                    <tr>
                                        <th width="200">Date </th>
                                        <th>Views </th>
                                    </tr>
                                    @php
                                        $dailyViews = getlastforteenView(auth()->id());
                                    @endphp
                                    @foreach ($dailyViews as $view)
                                        <tr>
                                            <td>
                                                @if (\Carbon\Carbon::parse($view['date'])->isToday())
                                                    Today
                                                @else
                                                    {{ \Carbon\Carbon::parse($view['date'])->format('m/d/Y') }}
                                                @endif
                                            </td>
                                            <td>{{ $view['total_views'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif (request('tab') == 'dashboard')
            <div class="dashboard-overview">
                <div class="row">
                    <div class="col-md-4">
                    <h2>Student Account</h2>
                        <p class="small">Last Logged in: 12th Nov 2024 7:30</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Profile is Online</h4>
                        <p><a href="#">Switch Offline</a></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Profile Link:</h4>
                        <p><a href="#" class="text-truncate">www.example.com/users/45511215454512152454</a></p>
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
