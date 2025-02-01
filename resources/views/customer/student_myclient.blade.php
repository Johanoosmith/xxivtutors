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
                            <li class="{{ Request::routeIs('customer.personalinfo') ? 'active' : '' }}"><a href="{{ route('customer.personalinfo') }}">Personal Info</a></li>
                            <li class="{{ Request::routeIs('customer.password') ? 'active' : '' }}"><a href="{{ route('customer.password') }}">Password</a></li>
                            <li  class="{{ Request::routeIs('customer.myclients') ? 'active' : '' }}"><a href="{{ route('customer.myclients') }}">My Clients</a></li>
                            <li  class="{{ Request::routeIs('customer.privacy') ? 'active' : '' }}"><a href="{{ route('customer.privacy') }}">Privacy</a></li>
                        </ul>
                    </div>
                    <p>Here are all the purchases you have made on your account. The tutors contact details will be sent to you automatically once the status is set to "Payment OK". </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Tutor</th>
                                    <th class="col-institute">Transaction Date</th>
                                    <th class="col-grade">Cost</th>
                                    <th class="col-status">Status</th>
                                    <th class="col-action">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-qualification"><a href="#">Rafsan (Mr)</a></td>
                                    <td class="col-institute">12/09/2024</td>
                                    <td class="col-grade">£0</td>
                                    <td class="col-status"><span class="status bg-warning">Payment OK</span></td>
                                    <td class="col-action">
                                        <a href="#" class="icon-btn">
                                            <svg class="icon">
                                                <use xlink:href="#view"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
