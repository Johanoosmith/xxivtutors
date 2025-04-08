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
                            <!-- <li  class="{{ Request::routeIs('customer.myclients') ? 'active' : '' }}"><a href="{{ route('customer.myclients') }}">My Clients</a></li>
                            <li  class="{{ Request::routeIs('customer.privacy') ? 'active' : '' }}"><a href="{{ route('customer.privacy') }}">Privacy</a></li> -->
                        </ul>
                    </div>
                         
                    <form class="edit-form" action="{{ route('customer.personalinfoupdate') }}"  method="POST">
                        @csrf
                        @include('elements.alert_message')
                        <div class="row">
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="account-type">Account Type</label>
                                <input type="text" class="form-control" id="account-type" value="Student" readonly="" disabled="">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="name-title">Title </label>
                                <div class="select-field">
                                    <select class="form-select" id="name-title" name="title">
                                        <option value="none" disabled="">Select</option>
                                        <option value="{{ old('title', $student->title ?? '') }}"  {{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                        <option value="Miss" {{ old('title') == 'Miss' ? 'selected' : '' }}>Miss</option>
                                        <option value="Mrs" {{ old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                        <option value="Ms" {{ old('title') == 'Ms' ? 'selected' : '' }}>Ms</option>
                                    </select>
                                    <svg>
                                        <use xlink:href="#caretDown"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="first-name">First Name</label>
                                <input type="text" class="form-control" name="firstname" value="{{ old('firstname', $personalinfo->firstname ?? '') }}" id="first-name" readonly="" disabled="">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="first-name">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="last-name" value="{{ old('lastname', $personalinfo->lastname ?? '') }}">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="email-address">Email Address</label>
                                <input type="text" name="email" class="form-control" id="email-address" value="{{ old('email', $personalinfo->email ?? '') }}">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="mobile-number">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" id="mobile-number" value="{{ old('mobile', $personalinfo->mobile ?? '') }}" >
                            </div>
                            <div class="col-12 form-field">
                                <label class="form-label" for="address-1">Address</label>
                                <input type="text" name="address" class="form-control" id="address-1" value="{{ old('address', $personalinfo->address ?? '') }}">
                                </input>
                            </div>
                            <!-- <div class="col-12 form-field">
                                <label class="form-label" for="address-2">Address 2 <span>*</span></label>
                                <input type="text" class="form-control" id="address-2" value="124585">
                            </div> -->
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="town">Town</label>
                                <input class="form-control" name="town" type="text" id="town" name="town" placeholder="Town" value="{{ old('town', $student->town ?? '') }}" required="">
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="county">County</label>
                                <div class="select-field">
                                <select class="form-select" id="county" name="county">
                                    <option value="" disabled {{ old('county', $student->county ?? '') == '' ? 'selected' : '' }}>Select</option>
                                    @foreach($countyies as $id => $name)
                                        <option value="{{ $id }}" {{ old('county', $student->county ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="country">Country</label>
                                <div class="select-field">
                                    <select class="form-select" id="country" name="country" disabled="">
                                        <option value="" disabled="">Select</option>
                                        <option value="Country1" selected="">United Kingdom</option>
                                        <option value="Country2">United States</option>
                                    </select>
                                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-md-6 form-field">
                                <label class="form-label" for="postcode">Postcode</label>
                                <input class="form-control" type="text" id="postcode" name="postcode" placeholder="Postcode" value="{{ old('postcode', $personalinfo->postcode ?? '') }}" required="">
                            </div>
                            <!-- <div class="col-md-12 form-field">
                                <label class="form-label" for="dobYear">Date of Birth</label>
                                <div class="dob-select">
                                    <div class="select-field">
                                        <select class="form-select" id="dobYear" name="dobYear" disabled="">
                                            <option value="" disabled="" selected="">Year</option>
                                            <option value="" selected="">1993</option>
                                        </select>
                                        <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="select-field">
                                        <select class="form-select" id="dobMonth" name="dobMonth" disabled="">
                                            <option value="" disabled="" selected="">Month</option>
                                            <option value="" selected="">July</option>
                                        </select>
                                        <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="select-field">
                                        <select class="form-select" id="dobDay" name="dobDay" disabled="">
                                            <option value="" disabled="" selected="">Day</option>
                                            <option value="" selected="">16</option>
                                        </select>
                                        <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div> -->
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
