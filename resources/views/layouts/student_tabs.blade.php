<!DOCTYPE html>
<div class="col dashboard-menu">
                  <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavbarNavigation" aria-controls="dashboardNavbarNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><svg class="icon">
                            <use xlink:href="#dashboard"></use>
                        </svg></span> Dashboard Menu
                </button> -->
                <ul class="dashboard-navigation" id="dashboardNavbarNavigation">
                    <li class="nav-link {{ request('tab') == 'dashboard' ? 'active' : '' }}">
                        <a  href="{{ route('customer.dashboard', ['tab' => 'dashboard']) }}">
                            <svg class="icon">
                                <use xlink:href="#house"></use>
                            </svg> 
                            Dashboard
                        </a>
                    </li>
                    <!-- <li><a href="#">
                        <svg class="icon">
                            <use xlink:href="#paper"></use>
                        </svg>
                        Verification</a>
                    </li> -->
                    <li class="nav-link {{ request('tab') == 'profile' ? 'active' : '' }}">   
                    <a  href="{{ route('customer.profile.view', ['tab' => 'profile']) }}">
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
                    <li class="nav-link {{ request('tab') == 'student_subject' ? 'active' : '' }}">
                        <a href="{{ route('customer.student_subject', ['tab' => 'student_subject']) }}">
                        <svg class="icon">
                            <use xlink:href="#graduation"></use>
                        </svg>
                        My Subjects</a>
                    </li>
                    <li class="nav-link {{ request('tab') == 'personalinfo' ? 'active' : '' }}">
                        <a href="{{ route('customer.personalinfo', ['tab' => 'personalinfo']) }}">
                        <svg class="icon">
                            <use xlink:href="#user"></use>
                        </svg>
                        Account</a>
                    </li>
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