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
            <!-- <div class="col-12 mb-4">
                <div class="important important bg-danger bg-opacity-10 text-danger text-sm">
                    <p>You currently have not selected any Subjects!</p>
                    <p>Without subjects you won't be found in searches. Please <a href="#">Add a Subject</a> to continue.</p>
                </div>
            </div> -->
            <div class="col dashboard-menu">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavbarNavigation" aria-controls="dashboardNavbarNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><svg class="icon">
                            <use xlink:href="#dashboard"></use>
                        </svg></span> Dashboard Menu
                </button>
                <ul class="dashboard-navigation" id="dashboardNavbarNavigation">
                    <li class="active">
                        <a href="#">
                            <svg class="icon">
                                <use xlink:href="#house"></use>
                            </svg> 
                            Dashboard
                        </a>
                    </li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#paper"></use>
                        </svg>
                        Verification</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#writing"></use>
                        </svg>
                        My Profile</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#chat"></use>
                        </svg>
                        My Enquiries</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#bookings"></use>
                        </svg>
                        Bookings</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#graduation"></use>
                        </svg>
                        My Subjects</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#user"></use>
                        </svg>
                        Account</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#feedback"></use>
                        </svg>
                        Feedback</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#study"></use>
                        </svg>
                        My Suggested Students</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#camera"></use>
                        </svg>
                        Profile Photo</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#article"></use>
                        </svg>
                        Articles</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#tags"></use>
                        </svg>
                        Tags</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#history"></use>
                        </svg>
                        History</a></li>
                    <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#enter"></use>
                        </svg>
                        Log Out</a></li>
                </ul>
            </div>
            <div class="col dashboard-content">
                <div class="dashboard-overview">
                    <div class="row">
                        <div class="col-md-4">
                       
                            <p class="small">Last Logged in: 12th Nov 2024 7:30</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Verification Pending</h4>
                            <p><a href="#">View Verification</a></p>
                        </div>
                        <div class="col-md-4">
                            <h4>Your Profile Link:</h4>
                            <p><a href="#" class="text-truncate">www.example.com/users/45511215454512152454</a></p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-6 col-lg-3 dashboard-box">
                            <div class="inner-box bg-info bg-opacity-10">
                                <span class="counting text-info">14</span>
                                <p>All Time Views</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 dashboard-box">
                            <div class="inner-box bg-success bg-opacity-10">
                                <span class="counting text-success">6</span>
                                <p>Last 7 Days</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 dashboard-box">
                            <div class="inner-box bg-primary bg-opacity-10">
                                <span class="counting text-primary">3</span>
                                <p>This Month</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 dashboard-box">
                            <div class="inner-box bg-danger bg-opacity-10">
                                <span class="counting text-danger">5</span>
                                <p>Last Month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-alerts bg-warning bg-opacity-10 mt-4">
                    <h2>Account Alerts</h2>
                    <ul>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#graduation"></use>
                        </svg>You have not provided information about subjects - you can not be found without subjects <a href="#">Add Subjects</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#writing"></use>
                        </svg>You have not uploaded any verification documents and/or references <a href="#">Submit Verification</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#checkmark"></use>
                        </svg>
                            You do not have an up to date Enhanced DBS, you will not be able to send enquiries or book lessons without a DBS <a href="#">Apply for DBS</a><a href="#">Upload DBS</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#writing"></use>
                        </svg>You have not submitted any qualifications <a href="#">Submit Qualifications</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#history"></use>
                        </svg>Your availability has not been updated within the last 7 days, it is important that your availability is updated on a weekly basis <a href="#">Update your Availability</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#camera"></use>
                        </svg>You haven't uploaded a profile photo, profiles with photos receive more interest from students <a href="#">Fix This</a></li>
                        <li><svg class="icon" width="20" height="20">
                            <use xlink:href="#question"></use>
                        </svg>Your postcode was not recognised, you will not be found in searches <a href="#">Fix This</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </section>
    
</main>
@endsection
