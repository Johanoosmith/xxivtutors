  <!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <!-- Author -->
    <meta name="author" content="Dotsquares">
    <!-- description -->
    <meta name="description" content="">
    <!-- keywords -->
    <meta name="keywords" content="">
    <!-- Page Title -->
    <title></title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
    <!-- <link rel="icon" href="{{asset('front/assets/images/favicon.ico')}}"> -->
    <!-- Bundle -->
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css') }}">
    <!-- Style Sheet -->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
</head>
<body>
    <header class="site-header">
        <div class="container d-flex align-items-center">
            <div class="col-lg-2 brand-logo">
                <a href="#">
                <img src="{{ asset(config('settings.header_logo', 'uploads/logos/header_log.png')) }}" alt="Logo">
                </a>
            </div>
            <div class="col-lg-7">
                <nav class="main-menu">
                    <ul class="main-navigation"> 
                    <?php foreach ($navigation as $navItem): ?>
                        <li>
                            <a href="<?php echo app('url')->to($navItem->slug); ?>">
                                <?php echo $navItem->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 right-menu d-flex align-items-center justify-content-end">
                <a href="#" class="user-btn">Login
                    <span class="svg-wrapper">
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                        </svg>
                    </span>
                </a>
                <a href="#" class="user-btn">Sign up
                    <span class="svg-wrapper">
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </header>
    <main>
        <section class="main-banner">
            <div class="icon-5">
                <img src="{{asset('front/assets/images/icon-2.svg')}}" alt="">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col content-block">
                        <h3>Unleash Your Inner Genius</h3>
                        <h2>Find the Perfect Tutor</h2>
                        <p>Tutuition connects students with Home Tutors and Online Tutors</p>
                        <form class="search-form">
                            <ul class="search-tabs">
                                <li class="active">In-person</li>
                                <li>Online</li>
                            </ul>
                            <div class="search-field-group">
                                <div class="field">
                                    <input type="text" placeholder="Enter a subject" class="input">
                                </div>
                                <div class="field select-field">
                                    <select class="select">
                                        <option>All Levels</option>
                                        <option>Trainee</option>
                                    </select>
                                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="field postcode">
                                    <input type="number" placeholder="Postcode" class="input">
                                </div>
                                <div class="btn-field">
                                    <button type="submit" class="search-btn">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.3013 18.2401L14.6073 13.547C15.9678 11.9136 16.6462 9.81853 16.5014 7.69766C16.3566 5.5768 15.3998 3.5934 13.8299 2.16007C12.26 0.726741 10.1979 -0.0461652 8.07263 0.0021347C5.94738 0.0504346 3.92256 0.916222 2.41939 2.41939C0.916222 3.92256 0.0504346 5.94738 0.0021347 8.07263C-0.0461652 10.1979 0.726741 12.26 2.16007 13.8299C3.5934 15.3998 5.5768 16.3566 7.69766 16.5014C9.81853 16.6462 11.9136 15.9678 13.547 14.6073L18.2401 19.3013C18.3098 19.371 18.3925 19.4263 18.4836 19.464C18.5746 19.5017 18.6722 19.5211 18.7707 19.5211C18.8693 19.5211 18.9669 19.5017 19.0579 19.464C19.1489 19.4263 19.2317 19.371 19.3013 19.3013C19.371 19.2317 19.4263 19.1489 19.464 19.0579C19.5017 18.9669 19.5211 18.8693 19.5211 18.7707C19.5211 18.6722 19.5017 18.5746 19.464 18.4836C19.4263 18.3925 19.371 18.3098 19.3013 18.2401ZM1.52072 8.27072C1.52072 6.9357 1.9166 5.63065 2.6583 4.52062C3.4 3.41059 4.45421 2.54543 5.68761 2.03454C6.92101 1.52364 8.27821 1.38997 9.58758 1.65042C10.897 1.91087 12.0997 2.55375 13.0437 3.49775C13.9877 4.44176 14.6306 5.64449 14.891 6.95386C15.1515 8.26323 15.0178 9.62043 14.5069 10.8538C13.996 12.0872 13.1309 13.1414 12.0208 13.8831C10.9108 14.6248 9.60575 15.0207 8.27072 15.0207C6.48112 15.0187 4.76538 14.3069 3.49994 13.0415C2.2345 11.7761 1.52271 10.0603 1.52072 8.27072Z" fill="currentColor"/>
                                            </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col img-block">
                        <div class="animation-image-wrapper">
                            <div class="shape-img shape-1">
                                <img src="{{asset('front/assets/images/shape-1.png')}}" alt="">
                            </div>
                            <div class="shape-img shape-2">
                                <img src="{{asset('front/assets/images/shape-2.png')}}" alt="">
                            </div>
                            <div class="icon-img icon-1">
                                <img src="{{asset('front/assets/images/icon-1.svg')}}" alt="">
                            </div>
                            <div class="icon-img icon-2">
                                <img src="{{asset('front/assets/images/icon-5.svg')}}" alt="">
                            </div>
                            <div class="icon-img icon-3">
                                <img src="{{asset('front/assets/images/icon-3.svg')}}" alt="">
                            </div>
                            <div class="icon-img icon-4">
                                <img src="{{asset('front/assets/images/icon-4.svg')}}" alt="">
                            </div>
                            <img class="img" src="{{asset('front/assets/images/banner-img.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#1B7AB5"/>
                </svg>
            </div>
        </section>
        
        <section class="section bg-blue text-white text-center">
            <div class="dot-animation">
                <img src="{{asset('front/assets/images/dot-circle.png')}}" alt="">
            </div>
            <div class="container small-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-heading">Key Features</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-1.png')}}" alt="">
                            </span>
                            <h3>Online Lessons</h3>
                            <p>Experience live interactive tuition lessons from your home.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-2.png')}}" alt="">
                            </span>
                            <h3>DBS Checked Tutors</h3>
                            <p>All our tutors have an Enhanced DBS, are referenced and ID checked, and have passed our onboarding process.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-3.png')}}" alt="">
                            </span>
                            <h3>Manage Your Lessons</h3>
                            <p>Manage your lessons through Tutuition using our simple scheduler</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section py-0 img-with-text img-first">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="img-wrapper">
                            <div class="media">
                                <img class="img-fluid" src="{{asset('front/assets/images/img-2.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 py-100">
                        <h2 class="section-heading">Search for Online Tutors</h2>
                        <p>At Tutuition, we understand finding a tutor is not always an easy task. Whether searching for primary, GCSE, A-Level, or an adult learner, we strive to make the process as simple as possible—listing all personal and private tutors closest to you.</p>
                        <div class="button-group">
                            <a href="#" class="btn btn-green">Find a Tutor</a>
                            <a href="#" class="btn btn-yellow">Become a Tutor</a>
                            <a href="#" class="btn btn-pink">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-lightgrey text-center browse-category">
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#112132"/>
                </svg>
            </div>
            <div class="container small-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-heading">Browse by Subject</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-1.png')}}" alt="">
                            </span>
                            <h4>Academic</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-2.png')}}" alt="">
                            </span>
                            <h4>Languages</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-3.png')}}" alt="">
                            </span>
                            <h4>IT</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-navyblue text-white">
            <div class="container">
                <div class="row">
                    <div class="col map-block">
                        <div class="map-wrapper">
                            <img class="img-fluid" src="{{asset('front/assets/images/map.png')}}" alt="map">
                        </div>
                    </div>
                    <div class="col listing-block">
                        <h2 class="section-heading">Explore Your City</h2>
                        <ul class="city-list">
                            <li>Liverpool
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Sheffield
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Edinburgh
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Leeds
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Manchester
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Bradford
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Bristol
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Coventry
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Belfast
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Cardiff
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Online
                                <ul>
                                    <li><a href="#">Maths</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <li>Browse All
                                <ul>
                                    <li><a href="#">By Country</a></li>
                                    <li><a href="#">All Maths</a></li>
                                    <li><a href="#">All English</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-lightgrey text-center ups-section">
            <div class="container small-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-heading">The Tutuition Difference</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-7.png')}}" alt="">
                            </span>
                            <h4>Search Tutors Online or In-person</h4>
                            <p>Search and compare online & local tutors by subject and level.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-8.png')}}" alt="">
                            </span>
                            <h4>View Tutors' Qualifications</h4>
                            <p>Compare qualifications, hourly rates, and reviews to find the right expert for you</p>
                        </div>
                    </div>
                    <div class="col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-9.png')}}" alt="">
                            </span>
                            <h4>Contact as Many Tutors as You Like</h4>
                            <p>Collaborate with as many tutors in our free messaging system.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-10.png')}}" alt="">
                            </span>
                            <h4>Select Your Perfect Tutor</h4>
                            <p>Only pay for the time you need. No subscriptions, no upfront payments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section explore-section">
            <div class="bg-img">
                <img src="{{asset('front/assets/images/bg.jpg')}}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h2 class="section-heading">Explore Tutuition</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col plan-option">
                        <div class="join-plan green-color">
                            <h5 class="text-center">Join as a</h5>
                            <h3 class="text-center">Student</h3>
                            <ul>
                                <li>No extra fees for students.</li>
                                <li>Search for online and local tutors.</li>
                                <li>All our tutors are verified and DBS checked.</li>
                                <li>Manage your lessons through our bookings system.</li>
                            </ul>
                            <div class="button-wrapper">
                                <a href="#" class="btn">REGISTER</a>
                            </div>
                        </div>
                    </div>
                    <div class="col plan-option">
                        <div class="join-plan blue-color">
                            <h5 class="text-center">Join as a</h5>
                            <h3 class="text-center">Tutor</h3>
                            <ul>
                                <li>Our site is completely free for tutors.</li>
                                <li>Create your own profile and advertise your services.</li>
                                <li>Tutor both face-to-face or online.</li>
                                <li>Search for tuition jobs using our search.</li>
                            </ul>
                            <div class="button-wrapper">
                                <a href="#" class="btn">REGISTER</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section newsletter-sec">
            <div class="container small-container">
                <div class="row">
                    <div class="col-lg-5">
                        <h2 class="section-heading">Don’t miss out! Subscribe to our newsletter</h2>
                    </div>
                    <div class="col-lg-7">
                        <form class="newsletter-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="field">
                                        <input type="text" class="input" placeholder="First Name" name="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field">
                                        <input type="email" class="input" placeholder="Email" name="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field select-field">
                                        <select class="select">
                                            <option>Who are you</option>
                                        </select>
                                        <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-green">Subscribe Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="site-footer bg-navyblue">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <span class="footer-block-heading">
                        Search
                    </span>
                    <ul class="search-menu">
                        <li><a href="#">Find a Tutor</a></li>
                        <li><a href="#">Search for Students</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <span class="footer-block-heading">
                        Subjects
                    </span>
                    <ul class="footer-links">
                        <li><a href="#">Maths</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">English</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Biology</a></li>
                        <li><a href="#">Geography</a></li>
                        <li><a href="#">Chemistry</a></li>
                        <li><a href="#">Physics</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <span class="footer-block-heading">
                        Locations
                    </span>
                    <ul class="footer-links">
                        <li><a href="#">London</a></li>
                        <li><a href="#">Leeds</a></li>
                        <li><a href="#">Birmingham</a></li>
                        <li><a href="#">Manchester</a></li>
                        <li><a href="#">Glasgow</a></li>
                        <li><a href="#">Bradford</a></li>
                        <li><a href="#">Liverpool</a></li>
                        <li><a href="#">Bristol</a></li>
                        <li><a href="#">Sheffield</a></li>
                        <li><a href="#">Coventry</a></li>
                        <li><a href="#">Edinburgh</a></li>
                    </ul> 
                </div>
                <div class="col-lg-3">
                    <span class="footer-block-heading">
                        Follow us
                    </span>
                    <ul class="social-links">
                        <li>
                            <a href="#" target="_blank">
                                <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.85661 8.33809H4.86223V14.2946H2.20305V8.33809H0.0491113V5.86505H2.20305V4.00362C2.20305 2.93995 2.49556 2.12447 3.08058 1.55718C3.6656 0.972158 4.44562 0.679649 5.42065 0.679649C5.7043 0.679649 6.00567 0.697377 6.32478 0.732832C6.64388 0.75056 6.89207 0.777152 7.06935 0.812608L7.33526 0.839199V2.93995H6.27159C5.77521 2.93995 5.41179 3.07291 5.18133 3.33883C4.96859 3.58702 4.86223 3.89726 4.86223 4.26954V5.86505H7.2289L6.85661 8.33809Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.9517 3.73283C12.9695 3.80374 12.9783 3.91897 12.9783 4.07853C12.9783 5.0181 12.801 5.95768 12.4465 6.89726C12.0919 7.8191 11.5867 8.67004 10.9308 9.45007C10.2925 10.2124 9.45934 10.8328 8.43112 11.3115C7.40291 11.7901 6.26832 12.0295 5.02737 12.0295C3.46732 12.0295 2.04023 11.6129 0.746094 10.7797C0.9411 10.7974 1.1627 10.8063 1.41089 10.8063C2.70502 10.8063 3.8662 10.4074 4.89441 9.60962C4.27394 9.60962 3.72437 9.43234 3.24572 9.07778C2.7848 8.7055 2.4657 8.24457 2.28842 7.69501C2.4657 7.71274 2.63411 7.7216 2.79366 7.7216C3.04185 7.7216 3.29004 7.69501 3.53823 7.64183C2.90003 7.5 2.36819 7.17204 1.94272 6.65793C1.51726 6.14382 1.30452 5.5588 1.30452 4.90287V4.84969C1.69453 5.08015 2.11114 5.20424 2.55434 5.22197C1.72113 4.65468 1.30452 3.87466 1.30452 2.88189C1.30452 2.38551 1.43748 1.91573 1.7034 1.47253C2.39479 2.34119 3.23686 3.03258 4.22962 3.54669C5.24011 4.0608 6.31264 4.34444 7.44723 4.39763C7.41177 4.18489 7.39404 3.97216 7.39404 3.75942C7.39404 2.99713 7.65996 2.34119 8.1918 1.79163C8.74136 1.24207 9.39729 0.967285 10.1596 0.967285C10.9751 0.967285 11.6576 1.2598 12.2072 1.84481C12.8454 1.72072 13.4392 1.49912 13.9888 1.18002C13.7761 1.83595 13.3683 2.35006 12.7656 2.72234C13.2974 2.65143 13.8293 2.50075 14.3611 2.27028C13.9711 2.83758 13.5013 3.32509 12.9517 3.73283Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.72647 4.23988C5.3317 3.63465 6.06153 3.33204 6.91597 3.33204C7.7704 3.33204 8.49134 3.63465 9.07876 4.23988C9.68399 4.8273 9.9866 5.54823 9.9866 6.40267C9.9866 7.25711 9.68399 7.98694 9.07876 8.59217C8.49134 9.17959 7.7704 9.47331 6.91597 9.47331C6.06153 9.47331 5.3317 9.17959 4.72647 8.59217C4.13904 7.98694 3.84533 7.25711 3.84533 6.40267C3.84533 5.54823 4.13904 4.8273 4.72647 4.23988ZM5.5008 7.81783C5.89242 8.20945 6.36414 8.40526 6.91597 8.40526C7.46779 8.40526 7.93951 8.20945 8.33113 7.81783C8.72275 7.42622 8.91855 6.9545 8.91855 6.40267C8.91855 5.85085 8.72275 5.37913 8.33113 4.98751C7.93951 4.59589 7.46779 4.40008 6.91597 4.40008C6.36414 4.40008 5.89242 4.59589 5.5008 4.98751C5.10919 5.37913 4.91338 5.85085 4.91338 6.40267C4.91338 6.9545 5.10919 7.42622 5.5008 7.81783ZM10.6007 2.71791C10.7431 2.84252 10.8143 3.00272 10.8143 3.19853C10.8143 3.39434 10.7431 3.56345 10.6007 3.70585C10.4761 3.84826 10.3159 3.91946 10.1201 3.91946C9.9243 3.91946 9.75519 3.84826 9.61278 3.70585C9.47038 3.56345 9.39918 3.39434 9.39918 3.19853C9.39918 3.00272 9.47038 2.84252 9.61278 2.71791C9.75519 2.5755 9.9243 2.5043 10.1201 2.5043C10.3159 2.5043 10.4761 2.5755 10.6007 2.71791ZM12.8703 3.94616C12.8881 4.42679 12.897 5.24562 12.897 6.40267C12.897 7.55972 12.8881 8.37856 12.8703 8.85918C12.8169 9.94503 12.4876 10.7906 11.8824 11.3958C11.295 11.9832 10.4583 12.2947 9.37247 12.3303C8.89185 12.3659 8.07302 12.3837 6.91597 12.3837C5.75892 12.3837 4.94008 12.3659 4.45946 12.3303C3.37361 12.2769 2.52807 11.9565 1.92285 11.3691C1.33542 10.7817 1.02391 9.94503 0.988307 8.85918C0.952705 8.37856 0.934904 7.55972 0.934904 6.40267C0.934904 5.24562 0.952705 4.41789 0.988307 3.91946C1.04171 2.85142 1.36212 2.02368 1.94955 1.43625C2.53697 0.831028 3.37361 0.501713 4.45946 0.448311C4.94008 0.43051 5.75892 0.42161 6.91597 0.42161C8.07302 0.42161 8.89185 0.43051 9.37247 0.448311C10.4583 0.501713 11.295 0.831028 11.8824 1.43625C12.4876 2.02368 12.8169 2.86032 12.8703 3.94616ZM11.5887 9.92723C11.6421 9.78482 11.6866 9.60681 11.7222 9.3932C11.7578 9.16179 11.7845 8.89478 11.8023 8.59217C11.8201 8.27175 11.829 8.01364 11.829 7.81783C11.829 7.62203 11.829 7.34611 11.829 6.9901C11.829 6.63408 11.829 6.43827 11.829 6.40267C11.829 6.34927 11.829 6.15346 11.829 5.81525C11.829 5.45923 11.829 5.18332 11.829 4.98751C11.829 4.7917 11.8201 4.54249 11.8023 4.23988C11.7845 3.91946 11.7578 3.65245 11.7222 3.43884C11.6866 3.20743 11.6421 3.02052 11.5887 2.87812C11.3751 2.32629 10.9923 1.94358 10.4405 1.72997C10.2981 1.67656 10.1112 1.63206 9.8798 1.59646C9.66619 1.56086 9.39918 1.53416 9.07876 1.51636C8.77615 1.49856 8.52694 1.48966 8.33113 1.48966C8.15312 1.48966 7.87721 1.48966 7.50339 1.48966C7.14738 1.48966 6.95157 1.48966 6.91597 1.48966C6.88037 1.48966 6.68456 1.48966 6.32854 1.48966C5.97253 1.48966 5.69661 1.48966 5.5008 1.48966C5.305 1.48966 5.04688 1.49856 4.72647 1.51636C4.42386 1.53416 4.15685 1.56086 3.92544 1.59646C3.71183 1.63206 3.53382 1.67656 3.39141 1.72997C2.83959 1.94358 2.45687 2.32629 2.24326 2.87812C2.18986 3.02052 2.14536 3.20743 2.10976 3.43884C2.07415 3.65245 2.04745 3.91946 2.02965 4.23988C2.01185 4.54249 2.00295 4.7917 2.00295 4.98751C2.00295 5.16552 2.00295 5.44143 2.00295 5.81525C2.00295 6.17126 2.00295 6.36707 2.00295 6.40267C2.00295 6.43827 2.00295 6.63408 2.00295 6.9901C2.00295 7.34611 2.00295 7.62203 2.00295 7.81783C2.00295 8.01364 2.01185 8.27175 2.02965 8.59217C2.04745 8.89478 2.07415 9.16179 2.10976 9.3932C2.14536 9.60681 2.18986 9.78482 2.24326 9.92723C2.47467 10.4791 2.85739 10.8618 3.39141 11.0754C3.53382 11.1288 3.71183 11.1733 3.92544 11.2089C4.15685 11.2445 4.42386 11.2712 4.72647 11.289C5.04688 11.3068 5.2961 11.3157 5.4741 11.3157C5.66991 11.3157 5.94582 11.3157 6.30184 11.3157C6.67566 11.3157 6.88037 11.3157 6.91597 11.3157C6.96937 11.3157 7.16518 11.3157 7.50339 11.3157C7.85941 11.3157 8.13532 11.3157 8.33113 11.3157C8.52694 11.3157 8.77615 11.3068 9.07876 11.289C9.39918 11.2712 9.66619 11.2445 9.8798 11.2089C10.1112 11.1733 10.2981 11.1288 10.4405 11.0754C10.9923 10.844 11.3751 10.4613 11.5887 9.92723Z" fill="currentColor"/>
                                </svg>

                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.5938 1.87812C14.6829 2.21633 14.7452 2.67915 14.7808 3.26658C14.8342 3.854 14.8698 4.36133 14.8876 4.78855V5.40267C14.8876 7.00474 14.7897 8.18849 14.5938 8.95393C14.4158 9.61256 13.9797 10.0398 13.2855 10.2356C12.9473 10.3246 12.3064 10.3958 11.363 10.4492C10.4196 10.4848 9.55623 10.5115 8.77299 10.5293H7.59814C4.55421 10.5293 2.65842 10.4314 1.91079 10.2356C1.21656 10.0398 0.780441 9.61256 0.602434 8.95393C0.51343 8.61571 0.442227 8.15289 0.388824 7.56547C0.353223 6.96024 0.326521 6.45292 0.308721 6.0435V5.40267C0.308721 3.8184 0.406625 2.64355 0.602434 1.87812C0.691437 1.5577 0.851644 1.28179 1.08305 1.05038C1.31446 0.818971 1.59038 0.658764 1.91079 0.56976C2.24901 0.480756 2.88983 0.418453 3.83328 0.382852C4.77672 0.32945 5.64005 0.293848 6.42329 0.276047H7.59814C10.6421 0.276047 12.5379 0.373952 13.2855 0.56976C13.6059 0.658764 13.8818 0.818971 14.1132 1.05038C14.3446 1.28179 14.5048 1.5577 14.5938 1.87812ZM6.10287 7.59217L9.92114 5.40267L6.10287 3.23988V7.59217Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p>2024 yourlogo - All Rights Reserved</p>
                    </div>
                    <div class="col text-md-end">
                        <p>Website Designed & Developed by: <a href="https://www.dotsquares.com/" target="_blank"><img src="{{asset('front/assets/images/dotsquares.png')}}" alt="Dotsquares"> </a></p>
                    </div>
                </div>
            </div>    
        </div>
    </footer>
<!-- JavaScript -->
<script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
    
    
    
    
    
    

   