@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>Password</h2>
                    <div class="profile-tabs">
                        <ul>
                            <li class="{{ Request::routeIs('customer.personalinfo') ? 'active' : '' }}"><a href="{{ route('customer.personalinfo') }}">Personal Info</a></li>
                            <li class="{{ Request::routeIs('customer.password') ? 'active' : '' }}"><a href="{{ route('customer.password') }}">Password</a></li>
                            <li  class="{{ Request::routeIs('customer.myclients') ? 'active' : '' }}"><a href="{{ route('customer.myclients') }} ">My purchases </a></li>
                            {{-- <li  class="{{ Request::routeIs('customer.privacy') ? 'active' : '' }}"><a href="{{ route('customer.privacy') }}">Privacy</a></li> --}}
                        </ul>
                    </div>
                        @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                            @else(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif
                    <form class="edit-form" action="{{ route('customer.studpasswordupdate') }}"  method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="row">
                            <div class="col-12 form-field">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" type="text" id="username" name="username" placeholder="Name" value="" required="" >
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <input class="form-control" type="password" id="currentPassword" name="current_password" placeholder="Current Password" required="">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="password">New Password</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="New Password" required="">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <input class="form-control" type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm New Password" required="">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">Save</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
