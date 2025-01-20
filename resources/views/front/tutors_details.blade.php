@extends('layouts.cms')
@section('content')


<section class="page-banner text-center text-white">
            <div class="banner-img">
                <img src="http://192.168.9.32:18212/storage/tutors/tutor-details-bg.jpg" alt="">
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
                <div class="row">
                    <div class="col col-tutor-info">
                        <div class="tutor-profile">
                            <div class="profile-avatar">
                                <div class="media">
                                @if($tutor->profile_image)
                                <img src="{{ asset('storage/' . $tutor->profile_image) }}" alt="{{ $tutor->firstname }}" width="200">
                                @else
                                <img src="http://192.168.9.32:18212/storage/tutors/businessman-avatar-ilustration-free-vector.jpg" alt="Default Image" width="200">
                                @endif
                                </div>
                            </div>
                            <h3>{{ $tutor->firstname }} {{ $tutor->lastname }}</h3>
                            <div class="tutor-location">
                                <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 19.5H10.3631C11.142 18.8045 11.8766 18.0608 12.5625 17.2734C15.1359 14.3138 16.5 11.1938 16.5 8.25C16.5 6.06196 15.6308 3.96354 14.0836 2.41637C12.5365 0.869194 10.438 0 8.25 0C6.06196 0 3.96354 0.869194 2.41637 2.41637C0.869194 3.96354 0 6.06196 0 8.25C0 11.1938 1.36031 14.3138 3.9375 17.2734C4.62338 18.0608 5.35795 18.8045 6.13688 19.5H1.5C1.30109 19.5 1.11032 19.579 0.96967 19.7197C0.829018 19.8603 0.75 20.0511 0.75 20.25C0.75 20.4489 0.829018 20.6397 0.96967 20.7803C1.11032 20.921 1.30109 21 1.5 21H15C15.1989 21 15.3897 20.921 15.5303 20.7803C15.671 20.6397 15.75 20.4489 15.75 20.25C15.75 20.0511 15.671 19.8603 15.5303 19.7197C15.3897 19.579 15.1989 19.5 15 19.5ZM1.5 8.25C1.5 6.45979 2.21116 4.7429 3.47703 3.47703C4.7429 2.21116 6.45979 1.5 8.25 1.5C10.0402 1.5 11.7571 2.21116 13.023 3.47703C14.2888 4.7429 15 6.45979 15 8.25C15 13.6153 9.79969 18.0938 8.25 19.3125C6.70031 18.0938 1.5 13.6153 1.5 8.25ZM12 8.25C12 7.50832 11.7801 6.7833 11.368 6.16661C10.956 5.54993 10.3703 5.06928 9.68506 4.78545C8.99984 4.50162 8.24584 4.42736 7.51841 4.57205C6.79098 4.71675 6.1228 5.0739 5.59835 5.59835C5.0739 6.1228 4.71675 6.79098 4.57205 7.51841C4.42736 8.24584 4.50162 8.99984 4.78545 9.68506C5.06928 10.3703 5.54993 10.956 6.16661 11.368C6.7833 11.7801 7.50832 12 8.25 12C9.24456 12 10.1984 11.6049 10.9017 10.9017C11.6049 10.1984 12 9.24456 12 8.25ZM6 8.25C6 7.80499 6.13196 7.36998 6.37919 6.99997C6.62643 6.62996 6.97783 6.34157 7.38896 6.17127C7.8001 6.00097 8.2525 5.95642 8.68895 6.04323C9.12541 6.13005 9.52632 6.34434 9.84099 6.65901C10.1557 6.97368 10.37 7.37459 10.4568 7.81105C10.5436 8.2475 10.499 8.6999 10.3287 9.11104C10.1584 9.52217 9.87004 9.87357 9.50003 10.1208C9.13002 10.368 8.69501 10.5 8.25 10.5C7.65326 10.5 7.08097 10.2629 6.65901 9.84099C6.23705 9.41903 6 8.84674 6 8.25Z" fill="#00CBBA"></path>
                                </svg>
                                {{$tutor->address }}                           
                             </div>
                            <div class="member-info">
                                <p><strong>Member Since:</strong> {{$tutor->created_at }} </p>
                                <p><strong>Response Rate:</strong> 100%</p>
                            </div>
                            <div class="online-info">
                                <a href="#" class="btn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23 7L16 12L23 17V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14 5H3C1.89543 5 1 5.89543 1 7V17C1 18.1046 1.89543 19 3 19H14C15.1046 19 16 18.1046 16 17V7C16 5.89543 15.1046 5 14 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    Online</a>
                            </div>
                            <div class="tutor-qualification">
                                <p><strong>My Qualifications</strong></p>
                                <div class="tutoe-meta">
                                    <div class="repeat"><span>{{ $tutor->qualification_1 }}</span></div>
                                    <div class="hours"><span>{{ $tutor->qualification_2 }}</span></div>
                                    <div class="travels"><span>{{ $tutor->qualification_3 }}</span></div>
                                    <div class="response"><span>{{ $tutor->qualification_4 }}</span></div>
                                    <div class="member"><span>{{ $tutor->experience }}</span></div>
                                </div>
                            </div>
                            <div class="other-information">
                                <div class="info-block">
                                    <h5>Professional</h5>
                                    <h4>City and Guilds of London Institute</h4>
                                    <p>Teaching Qualification Pass (1992)</p>
                                </div>
                                <div class="info-block">
                                    <h5>HND</h5>
                                    <h4>Cambridgeshire College or Arts and Technology</h4>
                                    <p>Maths and Statistics Distinction (1972)</p>
                                </div>
                            </div>
                            <div class="tutor-contact">
                                <a href="http://192.168.9.32:18212/contact-us" class="user-btn">
                                    Contact
                                    <span class="svg-wrapper">
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-tutor-description">
                        <h1>About {{ $tutor->firstname }} {{ $tutor->lastname }}</h1>
                        <p>
                        {{ $tutor->short_description }}
                        </p>
                        <h2>Detailed information about me:</h2>
                        <p>{{ $tutor->full_description }}</p>
                        <h2>About the lesson</h2>
                        <ul class="subject-list">
                            <li class="subject-item">
                                <a href="#" class="item-link">
                                    <span class="item-icon">
                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M23.0767 0.923096H16.8244C14.7321 0.923096 12.8982 2.31386 12.3321 4.32002L8.63977 17.4031C8.34439 18.4369 6.90439 18.4862 6.53516 17.4769L4.09824 10.6954C3.59362 9.28002 2.38747 8.23387 0.922852 7.92617" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4766 10.6216L23.0766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M23.0766 10.6216L17.4766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span>All Levels</span>
                                </a>
                            </li>
                            <li class="subject-item">
                                <a href="#" class="item-link">
                                    <span class="item-icon">
                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M23.0767 0.923096H16.8244C14.7321 0.923096 12.8982 2.31386 12.3321 4.32002L8.63977 17.4031C8.34439 18.4369 6.90439 18.4862 6.53516 17.4769L4.09824 10.6954C3.59362 9.28002 2.38747 8.23387 0.922852 7.92617" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4766 10.6216L23.0766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M23.0766 10.6216L17.4766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span>Maths</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
</section>
@endsection