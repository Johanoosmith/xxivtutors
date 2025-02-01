@extends('layouts.cms')
@section('meta_title'){{ $page->meta_title }}@endsection
@section('meta_desc'){{$page->meta_description}}@endsection
@section('meta_page_url'){{url($page->page_url)}}@endsection
@section('body_class'){{$page->page_url}}@endsection
@section('content')
<section class="main-banner">
            <div class="icon-5 d-none d-xl-block">
                <img src="{{asset('front/assets/images/icon-2.svg')}}" alt="">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col content-block py-5">
                        <h3>{{$page->home_top_section_title1}}</h3>
                        <h2>{{$page->home_top_section_title2}}</h2>
                        <p>{{$page->home_top_section_title3}}</p>
                        <form class="search-form">
                            <ul class="search-tabs">
                                <li class="active">In-person</li>
                                <li>Online</li>
                            </ul>
                            <div class="search-field-group">
                                <div class="field">                                    
                                    <input type="text" id="subjectSearch" placeholder="Enter a subject" class="input">
                                    <!-- Hidden Input for Course ID -->
                                    <input type="hidden" id="course_id">
                                    <input type="hidden" name="course_id" id="course_id">

                                </div>
                                <div class="field select-field">
                                    <select id="level" name="level" class="select">
                                    <option value="All Levels">All Levels</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{$level->title}}</option>
                                    @endforeach
                                    </select>
                                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="field postcode">
                                <input type="text" placeholder="Postcode" class="input number" maxlength="8">
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
                    <div class="col img-block d-none d-lg-block">
                        <div class="animation-image-wrapper">
                            <div class="shape-img shape-1 d-none d-lg-block">
                                <img src="{{asset('front/assets/images/shape-1.png')}}" alt="">
                            </div>
                            <div class="shape-img shape-2 d-none d-lg-block">
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
                        <h2 class="section-heading">{{$page->home_key_features_section_title}}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-1.png')}}" alt="">
                            </span>
                            <h3>{{$page->first_key_features_section_heading}}</h3>
                            <p>{{$page->first_key_features_section_subheading}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-2.png')}}" alt="">
                            </span>
                            <h3>{{$page->second_key_features_section_heading}}</h3>
                            <p>{{$page->second_key_features_section_subheading}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-3.png')}}" alt="">
                            </span>
                            <h3>{{$page->third_key_features_section_heading}}</h3>
                            <p>{{$page->third_key_features_section_subheading}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section pt-0 py-lg-0 bg-light-green img-with-text img-first">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="img-wrapper">
                            <div class="media">
                                <img class="img-fluid" src="{{asset('front/assets/images/img-2.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 py-100 align-self-center py-4">
                        <h2 class="section-heading">{{$page->search_tutors_section_heading}}</h2>
                        <p>{!! $page->search_tutors_section_description !!}</p>
                        <div class="button-group">
                            <a href="#" class="btn btn-green">Find a Tutor</a>
                            <a href="#" class="btn btn-yellow">Become a Tutor</a>
                            <a href="#" class="btn btn-pink">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section text-center browse-category">
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#112132"/>
                </svg>
            </div>
            <div class="container small-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-heading">{{$page->browse_subject_section_title}}</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-1.png')}}" alt="">
                            </span>
                            <h4>{{$page->first_browse_subject_section_heading}}</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-2.png')}}" alt="">
                            </span>
                            <h4>{{$page->second_browse_subject_section_heading}}</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 box-content">
                        <div class="icon-with-content bg-box">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-3.png')}}" alt="">
                            </span>
                            <h4>{{$page->third_browse_subject_section_heading}}</h4>
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
                        <h2 class="section-heading">{{$page->explore_your_city_section_title}}</h2>
                        <ul class="city-list">
                        <div class="cities">
                            <ul class="city-list">
                                @foreach($cities as $city)
                                 @php $citycourses = getCityCourses($city->id) @endphp

                                    <li value="{{$city->id}}">{{ $city->name }}
                                        @if(!empty($citycourses) && count($citycourses)> 0)        
                                            <ul>                                            
                                                @foreach($citycourses as $course)                                                
                                                    <li><a href="javascript:void(0);">{{ $course->title }}</a></li>
                                                @endforeach

                                            </ul>
                                        @else
                                             <ul>  <li><a href="javascript:void(0);"> -  </a> </li></ul>   
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section text-center ups-section">
            <div class="container small-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-heading">{{$page->tutuition_difference_section_title}}</h2>
                    </div>
                </div>
                <div class="row">
                     <div class="col-sm-6 col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-7.png')}}" alt="">
                            </span>
                            <h4>{{$page->first_tutuition_difference_section_heading}}</h4>
                            <p>{{$page->first_tutuition_difference_section_subheading}}</p>
                        </div>
                    </div>
                     <div class="col-sm-6 col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-8.png')}}" alt="">
                            </span>
                            <h4>{{$page->second_tutuition_difference_section_heading}}</h4>
                            <p>{{$page->second_tutuition_difference_section_subheading}}</p>
                        </div>
                    </div>
                     <div class="col-sm-6 col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-9.png')}}" alt="">
                            </span>
                            <h4>{{$page->third_tutuition_difference_section_heading}}</h4>
                            <p>{{$page->third_tutuition_difference_section_subheading}}</p>
                        </div>
                    </div>
                     <div class="col-sm-6 col-lg-3 box-content">
                        <div class="icon-with-content">
                            <span class="icon">
                                <img src="{{asset('front/assets/images/icon-10.png')}}" alt="">
                            </span>
                            <h4>{{$page->fourth_tutuition_difference_section_heading}}</h4>
                            <p>{{$page->fourth_tutuition_difference_section_subheading}}</p>
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
                        <h2 class="section-heading">{{$page->explore_tutuition_section_title}}</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col plan-option">
                        <div class="join-plan green-color">
                            <h5 class="text-center">{{$page->student_explore_tutuition_section_heading}}</h5>
                            <h3 class="text-center">{{$page->student_explore_tutuition_section_subheading}}</h3>
                            {!! $page->student_explore_tutuition_section_description !!}
                            <div class="button-wrapper">
                                <a href="#" class="btn">REGISTER</a>
                            </div>
                        </div>
                    </div>
                    <div class="col plan-option">
                        <div class="join-plan blue-color">
                            <h5 class="text-center">{{$page->tutor_explore_tutuition_section_heading}}</h5>
                            <h3 class="text-center">{{$page->tutor_explore_tutuition_section_subheading}}</h3>
                            {!! $page->tutor_explore_tutuition_section_description !!}
                            <div class="button-wrapper">
                                <a href="#" class="btn">REGISTER</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection
        @section('inline-js')
        <!-- <script>
            document.querySelector('.search-btn').addEventListener('click', function (event) {
                event.preventDefault();
                const courseId = document.querySelector('#subjectSearch').value.trim();
                if (courseId) {
                const url = `http://192.168.9.32:8001/tutors/?course_id=${courseId}`;
                window.location.href = url;
                } else {
                    window.location.href;
                }
            });
        </script> -->
        <script>
    // Autocomplete functionality
    const availableTags = @json($courses_list->map(fn($title, $id) => ['label' => $title, 'value' => $id])->values());

    jQuery("#subjectSearch").autocomplete({
        source: availableTags,
        select: function (event, ui) {
            // Populate the subject input with the selected course title
            jQuery("#subjectSearch").val(ui.item.label);

            // Store the course ID in the hidden input
            jQuery("#course_id").val(ui.item.value);

            return false; // Prevent default behavior
        }
    });

    // Handle filter button click
    document.querySelector('.search-btn').addEventListener('click', function (event) {
        event.preventDefault();

        // Get the selected course ID
        const courseId = document.querySelector('#course_id').value.trim();

        // Redirect if a course ID is selected
        if (courseId) {
            const url = `http://192.168.9.32:8001/tutors/?course_id=${courseId}`;
            window.location.href = url;
        } else {
            alert('Please select a subject before filtering.');
        }
    });
</script>    
@endsection
