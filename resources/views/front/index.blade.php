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
                        
						<!-- Tutor Filter -->
						@include('includes/front/site_search')
                    
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
                        <div class="map-wrapper kk">
                            <img class="img-fluid" src="{{asset('front/assets/images/map.png')}}" alt="map">
                        </div>
                    </div>
                    @php
                        $subjects_by_cities = getTutorByCounty();
                        $city_subjects = [];
                        foreach($subjects_by_cities as $key => $city){
                            $city_name = $city->name;
                            $subjects_name = [];
                            
                            if(!empty($city->tutors) ){
                                
                                foreach($city->tutors as $tutor){
                                    if(!empty($tutor->subject_tutors)){
                                        foreach($tutor->subject_tutors as $subject){
                                            $subjects_name[] = $subject->title;
                                        }
                                    }
                                }

                                $subjects_name = array_unique($subjects_name);
                            }

                            $city_subjects[$city_name] = $subjects_name;
                        }

                        $town_subjects = [];
                        $subjects_by_town = getTutorByTown();
                        foreach($subjects_by_town as $key => $row){
                            foreach($row as $tutor){
                                if(!empty($tutor->subject_tutors)){
                                    $tutor_subject_data = [];
                                    foreach($tutor->subject_tutors as $subject){
                                        $tutor_subject_data[$subject->slug] = $subject->title;
                                    }
                                    $tutor_subject_data = array_unique($tutor_subject_data);
                                    $town_subjects[$key] = $tutor_subject_data;
                                }
                            }
                        }

                        /* Using here static content for client view, when data fill, we will comment this line: pre_set  */
                        $town_subjects = getTutorByTownStatic();
                       
                        
                    @endphp

                    <div class="col listing-block">
                        <h2 class="section-heading">{{$page->explore_your_city_section_title}}</h2>
                       <div class="cities">
                            <ul class="city-list">

                                @foreach($town_subjects as $town => $subjects)
                                    
                                    <li>
                                        <a href="{{ route('tutors.tutorFilter', ['town'=>$town]) }}" style="color:var(--primary-color);">
                                            {{ $town }}
                                        </a>
                                        @if(!empty($subjects) && count($subjects)> 0)        
                                            <ul>
                                                @php $count = 0; @endphp                                            
                                                @foreach($subjects as $subject_slug => $subject_title)
                                                    @php if($count >= 3){ break; } @endphp                     
                                                    <li>
                                                        <a href="{{ route('tutors.tutorFilter', ['subject'=>$subject_slug,'town'=>$town]) }}">{{ $subject_title }}</a>
                                                    </li>
                                                    @php $count++; @endphp
                                                @endforeach

                                            </ul>
                                    @endif
                                    </li>
                                    
                                @endforeach

                                <li>
                                    <a href="{{ route('tutors.tutorFilter', ['teach'=>'online']) }}" style="color:var(--primary-color);">
                                    Online
                                    </a>
                                    <ul>                                            
                                        <li><a href="{{ route('tutors.tutorFilter', ['subject'=>'maths','teach'=>'online']) }}">Maths</a></li>
                                        <li><a href="{{ route('tutors.tutorFilter', ['subject'=>'english','teach'=>'online']) }}">English</a></li>
                                        <li><a href="{{ route('tutors.tutorFilter', ['subject'=>'science','teach'=>'online']) }}">Science</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{ route('tutors.tutorFilter', ['town'=>'all']) }}" style="color:var(--primary-color);">
                                        Browse All
                                    </a>
                                    <ul>                                            
                                        <li><a href="{{ route('tutors.tutorFilter', ['town'=>'all']) }}">All County</a></li>
                                        <li><a href="{{ route('tutors.tutorFilter', ['subject'=>'maths','town'=>'all']) }}">All Maths</a></li>
                                        <li><a href="{{ route('tutors.tutorFilter', ['subject'=>'english','town'=>'all']) }}">All English</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--
                    <div class="col listing-block">
                        <h2 class="section-heading">{{$page->explore_your_city_section_title}}</h2>
                        <ul class="city-list">
                        <div class="cities">
                            <ul class="city-list">

                                @foreach($cities as $city)
                                 @php $citycourses = getCitySubjects($city->id) @endphp

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
                    -->
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
                                <a href="{{ route('register.step') }}" class="btn">REGISTER</a>
                            </div>
                        </div>
                    </div>
                    <div class="col plan-option">
                        <div class="join-plan blue-color">
                            <h5 class="text-center">{{$page->tutor_explore_tutuition_section_heading}}</h5>
                            <h3 class="text-center">{{$page->tutor_explore_tutuition_section_subheading}}</h3>
                            {!! $page->tutor_explore_tutuition_section_description !!}
                            <div class="button-wrapper">
                                <a href="{{ route('register.step') }}" class="btn">REGISTER</a>
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
		
	/*	
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
    });*/
</script>    
@endsection
