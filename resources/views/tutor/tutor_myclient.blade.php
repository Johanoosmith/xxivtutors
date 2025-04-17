@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Your Personal Information</h2> 
                    <div class="profile-tabs">
                        <ul>
                            <li class="{{ Request::routeIs('tutor.personalinfo') ? 'active' : '' }}"><a href="{{ route('tutor.personalinfo') }}">Personal Info</a></li>
                            <li class="{{ Request::routeIs('tutor.password') ? 'active' : '' }}"><a href="{{ route('tutor.password') }}">Password</a></li>
                            <li  class="{{ Request::routeIs('tutor.myclients') ? 'active' : '' }}"><a href="{{ route('tutor.myclients') }}">My Clients</a></li>
                            <li  class="{{ Request::routeIs('tutor.privacy') ? 'active' : '' }}"><a href="{{ route('tutor.privacy') }}">Privacy</a></li>
                        </ul>
                    </div>
                    <p>Here are all the purchases you have made on your account. The tutors contact details will be sent to you automatically once the status is set to "Payment OK". </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Student</th>
                                    <th class="col-institute">Connected Date</th>
                                    <th class="col-status">Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                                <tr>
                                    <td class="col-qualification"><a href="{{ route('profile',$contract->student->id) }}">{{ $contract->student->full_name }}</a></td>
                                    <td class="col-institute">
                                        {{ ($contract->signed_date) ? date(config('constants.SITE.DATE_FORMAT'), strtotime($contract->signed_date)) : '-' }}
                                    </td>
                                    <td class="col-status">
                                        @if($contract->status == 'signed')
                                            <span class="infookay">Connected</span>
                                        @endif

                                        <a href="{{ route('tutor.enquiries.chat', getEnquiryByContractId($contract->id)) }}">View contact details </a>
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <a href="{{ route('tutor.contract', @$contract->id) }}">View contract </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
