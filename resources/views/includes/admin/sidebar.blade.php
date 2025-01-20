<!-- Sidebar -->
@php $currentRoute = Route::currentRouteName(); @endphp
<nav class="pc-sidebar ">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="javascript:void(0);" class="b-brand"><span>Test</span></a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">               
                <li class="pc-item {{ ($currentRoute === 'admin.dashboard') ? 'active' : '' }} ">
                    <a href="{{route('admin.dashboard')}}" class="pc-link ">
                        <span class="pc-micon"><i class="material-icons-two-tone">home</i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>          
                                
               @php $countryRoutes = ['admin.settings.tab',             
               'admin.emailtemplates.index','admin.emailtemplates.create','admin.emailtemplates.edit',             
               'admin.textsettings.index','admin.textsettings.create','admin.textsettings.edit',

               ]; @endphp

                <li class="pc-item pc-hasmenu {{ in_array($currentRoute,$countryRoutes) ? 'active pc-trigger' : '' }}">
                    <a href="javascript:void(0);" class="pc-link ">
                        <span class="pc-micon"><i class="material-icons-two-tone">settings</i></span>
                        <span class="pc-mtext">Manage Settings</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu ">

                   <!-- <li class="pc-item {{ Request::segment(3) === 'general' ? 'active' : '' }}">
                    <a class="pc-link"  href="{{route('admin.settings.tab','general')}}">General Settings</a></li>
                    -->
                    
                        <li class="pc-item  {{ $currentRoute === 'admin.header.index' ? 'active' : '' }} {{ $currentRoute === 'admin.header.edit' ? 'active' : '' }} {{ $currentRoute === 'admin.header.create' ? 'active' : '' }}">
                        <a class="pc-link " href="{{route('admin.header.index')}}">Header</a></li>

                        <li class="pc-item  {{ $currentRoute === 'admin.footer.index' ? 'active' : '' }} {{ $currentRoute === 'admin.footer.edit' ? 'active' : '' }} {{ $currentRoute === 'admin.footer.create' ? 'active' : '' }}">
                            <a class="pc-link " href="{{route('admin.footer.index')}}">Footer</a></li>


                        <li class="pc-item  {{ $currentRoute === 'admin.emailtemplates.index' ? 'active' : '' }} {{ $currentRoute === 'admin.emailtemplates.edit' ? 'active' : '' }} {{ $currentRoute === 'admin.emailtemplates.create' ? 'active' : '' }}">
                        <a class="pc-link " href="{{route('admin.emailtemplates.index')}}">Email Templates</a></li>


                        <li class="pc-item d-none {{ $currentRoute === 'admin.emaillogs.index' ? 'active' : '' }} ">
                        <a class="pc-link " href="{{route('admin.emaillogs.index')}}">Email Logs</a></li>
                    </ul>
                </li>
                <li class=" nav-item {{ ($currentRoute === 'admin.pages.index' || $currentRoute === 'admin.pages.edit' || $currentRoute === 'admin.pages.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.pages.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Pages</span>
                     </a>
                </li>  
               
                <li class="pc-item pc-hasmenu {{ in_array($currentRoute,$countryRoutes) ? 'active pc-trigger' : '' }}">
                    <a href="javascript:void(0);" class="pc-link ">
                        <span class="pc-micon"><i class="material-icons-two-tone">settings</i></span>
                        <span class="pc-mtext">User Management</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                <ul class="pc-submenu ">
                <li class=" nav-item {{ ($currentRoute === 'admin.student.index' || $currentRoute === 'admin.student.edit' || $currentRoute === 'admin.student.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.student.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Student</span>
                     </a>
                </li>    
                <li class=" nav-item {{ ($currentRoute === 'admin.tutors.index' || $currentRoute === 'admin.tutors.edit' || $currentRoute === 'admin.tutors.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.tutors.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Tutors</span>
                     </a>
                </li>
                </ul>
                </li>  
                <li class=" nav-item {{ ($currentRoute === 'admin.category.index' || $currentRoute === 'admin.category.edit' || $currentRoute === 'admin.category.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.category.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Category</span>
                     </a>
                </li>            
                <li class=" nav-item {{ ($currentRoute === 'admin.course.index' || $currentRoute === 'admin.course.edit' || $currentRoute === 'admin.course.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.course.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Course</span>
                     </a>
                </li> 
                <li class=" nav-item {{ ($currentRoute === 'admin.cities.index' || $currentRoute === 'admin.cities.edit' || $currentRoute === 'admin.cities.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.cities.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Cities</span>
                     </a>
                </li> 
                <li class=" nav-item {{ ($currentRoute === 'admin.contact-us.index' || $currentRoute === 'admin.contact-us.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.contact-us.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Contact Us</span>
                     </a>
                </li> 
                <li class=" nav-item {{ ($currentRoute === 'admin.subscriber.index' || $currentRoute === 'admin.subscriber.create') ? 'active' : '' }} ">
                    <a class="pc-link" href="{{route('admin.subscriber.index')}}">                    
                    <span class="pc-micon"><i class="material-icons-two-tone">folder</i></span>
                        <span class="pc-mtext">Manage Subscriber</span>
                     </a>
                </li> 
            </ul>
        </div>
    </div>
</nav>
<header class="pc-header ">
    <div class="header-wrapper">
        <div class="mr-auto pc-mob-drp">
            <!-- [ breadcrumb ] start -->
            <div class="page-header d-none">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard sale</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item">Dashboard sale</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
        </div>
        <div class="ml-auto">
            <ul class="list-unstyled">                
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{url('/backend/images/profile_icon.png')}}" alt="user-image" class="user-avtar">
                        <span>
                            <span class="user-name">{{auth('admin')->user()->firstname}} {{auth('admin')->user()->lastname}}</span>
                            <span class="user-desc">Administrator</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <a href="{{url('home')}}" target="_blank" class="dropdown-item">
                            <i class="material-icons-two-tone">language</i>
                            <span>View Website</span>
                        </a>
                        <a href="{{route('admin.profile')}}" class="dropdown-item">
                            <i class="material-icons-two-tone">account_circle</i>
                            <span>My Profile</span>
                        </a>
                        <a href="{{route('admin.changepassword')}}" class="dropdown-item">
                            <i class="material-icons-two-tone">lock_open</i>
                            <span>Change Password</span>
                        </a>
                        <a href="{{route('admin.logout')}}" class="dropdown-item">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>

