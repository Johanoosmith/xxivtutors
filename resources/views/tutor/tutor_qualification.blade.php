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
                            <li class="{{ Request::routeIs('tutor.profile.view') ? 'active' : '' }}"><a href="{{ route('tutor.profile.view') }}">Edit Profile</a></li>
                            <li class="{{ Request::routeIs('tutor.qualification') ? 'active' : '' }}"><a href="{{ route('tutor.qualification') }}">Qualifications</a></li>
                            <li  class="{{ Request::routeIs('tutor.myavailability') ? 'active' : '' }}"><a href="{{route('tutor.myavailability')}}">My Availability</a></li>
                            <li  class="{{ Request::routeIs('tutor.headlines') ? 'active' : '' }}"><a href="{{route('tutor.headlines')}}">Headlines</a></li>
                            <li  class="{{ Request::routeIs('tutor.foundme') ? 'active' : '' }}"><a href="{{route('tutor.foundme')}}">Who's Found Me?</a></li>
                        </ul>
                    </div>
                    <p>Here you can add your qualifications you hold. They will show within your profile (but not the certificate), 
                        you also have the option to verify any qualification with us by uploading the certificate. Once approved we will mark it as verified.</p>
                        <h2 style="clear: both; ">Qualifications  &nbsp;&nbsp;&nbsp;
                            <span style="font-size: 12px;">
                              <a href="{{ route('tutor.add.qualification') }}" class="btn btn-yellow btn-small" >Add a Qualification</a>
                            </span>
                        </h2>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Qualification</th>
                                    <th class="col-institute">Institute</th>
                                    <th class="col-grade">Grade</th>
                                    <th class="col-status">Date</th>
                                    <th class="col-action">Status</th>
                                    <th class="col-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($userQualifications as $userQualification)
                                <tr>
                                    <td class="col-qualification">{{ $userQualification->qualification->qualification }}</td>
                                    <td class="col-institute">{{ $userQualification->institute_name }}</td>
                                    <td class="col-grade">{{ $userQualification->grade }}</td>
                                    <td class="col-status">{{ $userQualification->qyear }}</td>
                                    <td class="col-status">
                                    @if ($userQualification->status == 1)
                                    <span class="status bg-success text-white">Approved</span>
                                    @elseif ($userQualification->status == 2)
                                    <span class="status bg-warning">Awaiting Approval</span>
                                    @else
                                    <span class="status bg-danger text-white">Rejected</span>
                                    @endif
                                    </td>
                                    <td class="col-action">
                                    <a href="{{ route('tutor.qualification.edit', $userQualification->id) }}" class="icon-btn">
                                            <svg class="icon">
                                                <use xlink:href="#view"></use>
                                            </svg>
                                        </a>
                                        <form action="{{ route('tutor.qualification.delete', $userQualification->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn">
                                            <svg class="icon">
                                             <use xlink:href="#delete"></use>
                                            </svg>
                                            </button>
                                        </form>
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
