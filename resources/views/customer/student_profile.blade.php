@extends('layouts.cms')
@section('content')

<section class="page-banner text-center text-white">
            <div class="banner-img">
                <img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
            
        </section>
        <section class="tutor-full-details">
            <div class="container">
                @include('elements.alert_message')
                <div class="row">
                    <div class="col col-tutor-info">
                        <div class="tutor-profile">
                            <div class="profile-avatar">
                                <div class="media">
                                @if($user->profile_image)
                                    <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" class="profile-image">
                                @else
                                    <img src="{{ asset('storage/profile_images/default.png') }}" alt="Default Avatar" class="profile-image">
                                @endif
                                </div>
                            </div>
                            <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>
                            <span>Student</span>
                            <div class="tutor-location">
                                <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 19.5H10.3631C11.142 18.8045 11.8766 18.0608 12.5625 17.2734C15.1359 14.3138 16.5 11.1938 16.5 8.25C16.5 6.06196 15.6308 3.96354 14.0836 2.41637C12.5365 0.869194 10.438 0 8.25 0C6.06196 0 3.96354 0.869194 2.41637 2.41637C0.869194 3.96354 0 6.06196 0 8.25C0 11.1938 1.36031 14.3138 3.9375 17.2734C4.62338 18.0608 5.35795 18.8045 6.13688 19.5H1.5C1.30109 19.5 1.11032 19.579 0.96967 19.7197C0.829018 19.8603 0.75 20.0511 0.75 20.25C0.75 20.4489 0.829018 20.6397 0.96967 20.7803C1.11032 20.921 1.30109 21 1.5 21H15C15.1989 21 15.3897 20.921 15.5303 20.7803C15.671 20.6397 15.75 20.4489 15.75 20.25C15.75 20.0511 15.671 19.8603 15.5303 19.7197C15.3897 19.579 15.1989 19.5 15 19.5ZM1.5 8.25C1.5 6.45979 2.21116 4.7429 3.47703 3.47703C4.7429 2.21116 6.45979 1.5 8.25 1.5C10.0402 1.5 11.7571 2.21116 13.023 3.47703C14.2888 4.7429 15 6.45979 15 8.25C15 13.6153 9.79969 18.0938 8.25 19.3125C6.70031 18.0938 1.5 13.6153 1.5 8.25ZM12 8.25C12 7.50832 11.7801 6.7833 11.368 6.16661C10.956 5.54993 10.3703 5.06928 9.68506 4.78545C8.99984 4.50162 8.24584 4.42736 7.51841 4.57205C6.79098 4.71675 6.1228 5.0739 5.59835 5.59835C5.0739 6.1228 4.71675 6.79098 4.57205 7.51841C4.42736 8.24584 4.50162 8.99984 4.78545 9.68506C5.06928 10.3703 5.54993 10.956 6.16661 11.368C6.7833 11.7801 7.50832 12 8.25 12C9.24456 12 10.1984 11.6049 10.9017 10.9017C11.6049 10.1984 12 9.24456 12 8.25ZM6 8.25C6 7.80499 6.13196 7.36998 6.37919 6.99997C6.62643 6.62996 6.97783 6.34157 7.38896 6.17127C7.8001 6.00097 8.2525 5.95642 8.68895 6.04323C9.12541 6.13005 9.52632 6.34434 9.84099 6.65901C10.1557 6.97368 10.37 7.37459 10.4568 7.81105C10.5436 8.2475 10.499 8.6999 10.3287 9.11104C10.1584 9.52217 9.87004 9.87357 9.50003 10.1208C9.13002 10.368 8.69501 10.5 8.25 10.5C7.65326 10.5 7.08097 10.2629 6.65901 9.84099C6.23705 9.41903 6 8.84674 6 8.25Z" fill="#00CBBA"/>
                                </svg>
                                @php
                                    $countryId = $student->country;
                                    $countryName = \App\Models\Country::find($countryId)?->name ?? 'Country not found';
                                @endphp
                                {{ $student->town }}, {{ $countryName }} 
                            </div>
                            <div class="member-info">
                                <p><strong>Member Since: </strong> {{ $user->created_at->format('d M Y') }}</p>
                                <p><strong>Last Login: </strong> {{ $user->last_login ? $user->last_login->diffForHumans() : 'Never logged in' }}</p>
                                <p><strong>Home Town: </strong>{{ $student->town }}</p>
                            </div>

                           

                            @if (Auth::check() && Auth::user()->id == $user->id)
                            <div class="student-editprofile">
                                <a href="{{ route('customer.personalinfo')}}" class="user-btn">
                                Edit Your Profile
                                    <span class="svg-wrapper">
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="student-updatepro">
                                <a href="{{ route('customer.photo.upload')}}" class="user-btn">
                                Update a Profile Image
                                    <span class="svg-wrapper">
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            @endif
                            
                            <div class="student-updatepro">
                                @php
                                    $tagged = false;
                                    if (Auth::check()) {
                                        $tagged = getUserTagged(Auth::user()->id, $user->id);
                                    }
                                @endphp

                                @if($tagged)
                                    <a href="#" class="user-btn">
                                        Student Tagged
                                        <span class="svg-wrapper">
                                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('tutor.tag.create', $user->id)}}" class="user-btn">
                                        Tag this Student
                                        <span class="svg-wrapper">
                                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </a>
                                @endif
                            </div>
                            
                            <div class="student-updatepro">
                               <a href="{{ route('tutor.enquiries.create', $user->id)}}" class="user-btn">
                                    Contact to the student
                                    <span class="svg-wrapper">
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>


                        </div>
                    </div>
                    <div class="col col-tutor-description">
                        
                        <div class="studnet-info">
                            <h2>Information about {{ $user->firstname }} {{ $user->lastname }} </h2>
                            <p><strong>Willing to travel:</strong> {{ $student->distance }} miles</p>

                            <h5>Subjects</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped default-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            @foreach ($levels as $level)
                                                <th>{{ $level }}</th> <!-- Dynamically adding table headers -->
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedSubjects as $subject)
                                            <tr>
                                                <td>{{ $subject['title'] }}</td>
                                                @foreach ($levels as $level)
                                                    <td>{{ $subject[$level] }}</td> <!-- Display checkmark or '-' dynamically -->
                                                @endforeach
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!--<p><strong>Contact this Student:</strong></p>-->
                            
                        </div>
                        <!--
                        <div class="contact-student card card-body">
                            <div class="button-group">
                                <a href="{{route('customer.personalinfo')}}" class="btn btn-yellow">Edit Your Profile</a>
                                <a href="{{route('customer.noaccess')}}" class="btn btn-green">Contact This Student</a></h3>
                                <a href="{{ route('customer.tag.create', $user->id)}}" class="btn btn-yellow">Tag This Student</a>
                                <a href="" class="btn btn-pink">Report Inappropriate Content </a>
                            </div>                            
                        </div>
                        -->                        
                    </div>
                </div>
            </div>
        </section>
@endsection
