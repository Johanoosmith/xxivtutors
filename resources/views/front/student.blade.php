@extends('layouts.cms')
@section('meta_title'){{ $page->meta_title }}@endsection
@section('meta_desc'){{$page->meta_description}}@endsection
@section('meta_page_url'){{url($page->page_url)}}@endsection
@section('body_class'){{$page->page_url}}@endsection
@section('content')

<section class="page-banner text-center text-white with-search">
            <div class="banner-img">
                
                <img src="{{ asset('/storage/tutors/tutor-details-bg.jpg') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="page-title">{{$page->tutor_section_title1}}</h1>
                        <p>{{$page->tutor_section_subheading}}</p>
                        <form class="search-form">
                            <ul class="search-tabs">
                                <li class="active">In-person</li>
                                <li>Online</li>
                            </ul>
                            <div class="search-field-group">
                                <div class="field">                                    
                                    {{ html()->select('course_id', $courses_list)->class('input select2')->id('subjectSearch')->placeholder("Enter a subject")  }}
                                </div>
                                <div class="field select-field">
                                    <select class="select">
                                        <option>All Levels</option>
                                        <option>Trainee</option>
                                    </select>
                                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="field postcode">
                                    <input type="text" placeholder="Postcode" class="input number" maxlength="8">
                                </div>
                                <div class="btn-field">
                                    <button type="submit" class="search-btn">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.3013 18.2401L14.6073 13.547C15.9678 11.9136 16.6462 9.81853 16.5014 7.69766C16.3566 5.5768 15.3998 3.5934 13.8299 2.16007C12.26 0.726741 10.1979 -0.0461652 8.07263 0.0021347C5.94738 0.0504346 3.92256 0.916222 2.41939 2.41939C0.916222 3.92256 0.0504346 5.94738 0.0021347 8.07263C-0.0461652 10.1979 0.726741 12.26 2.16007 13.8299C3.5934 15.3998 5.5768 16.3566 7.69766 16.5014C9.81853 16.6462 11.9136 15.9678 13.547 14.6073L18.2401 19.3013C18.3098 19.371 18.3925 19.4263 18.4836 19.464C18.5746 19.5017 18.6722 19.5211 18.7707 19.5211C18.8693 19.5211 18.9669 19.5017 19.0579 19.464C19.1489 19.4263 19.2317 19.371 19.3013 19.3013C19.371 19.2317 19.4263 19.1489 19.464 19.0579C19.5017 18.9669 19.5211 18.8693 19.5211 18.7707C19.5211 18.6722 19.5017 18.5746 19.464 18.4836C19.4263 18.3925 19.371 18.3098 19.3013 18.2401ZM1.52072 8.27072C1.52072 6.9357 1.9166 5.63065 2.6583 4.52062C3.4 3.41059 4.45421 2.54543 5.68761 2.03454C6.92101 1.52364 8.27821 1.38997 9.58758 1.65042C10.897 1.91087 12.0997 2.55375 13.0437 3.49775C13.9877 4.44176 14.6306 5.64449 14.891 6.95386C15.1515 8.26323 15.0178 9.62043 14.5069 10.8538C13.996 12.0872 13.1309 13.1414 12.0208 13.8831C10.9108 14.6248 9.60575 15.0207 8.27072 15.0207C6.48112 15.0187 4.76538 14.3069 3.49994 13.0415C2.2345 11.7761 1.52271 10.0603 1.52072 8.27072Z" fill="currentColor"></path>
                                            </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#F5F5F7"></path>
                </svg>
            </div>
        </section>
        <section class="subject-listing">
            <div class="container">

                <ul class="subject-list">
                    @foreach($courses as $course)
                    <li class="subject-item @if($course->id == $course_id) active @endif">
                        <a class="item-link" href="{{ route('tutors.filterByCourse', $course->id) }}">
                            <span class="item-icon">
                                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.0767 0.923096H16.8244C14.7321 0.923096 12.8982 2.31386 12.3321 4.32002L8.63977 17.4031C8.34439 18.4369 6.90439 18.4862 6.53516 17.4769L4.09824 10.6954C3.59362 9.28002 2.38747 8.23387 0.922852 7.92617" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M17.4766 10.6216L23.0766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M23.0766 10.6216L17.4766 18.2277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <span>{{$course->title }}</span>
                        </a>
                    </li>
                    @endforeach                  
                </ul>
            </div>
        </section>
        <section class="tutor-listing">
            <div class="container">
                <div class="row">
                    <div class="col col-filter">
                        <form method="GET" action="{{route('tutors.tutorFilter')}}" id="filterForm">
                            <label for="price_range">Price Range:</label><br>
                            <strong id="priceDisplay"></strong>
                            <div id="priceSlider"></div>
                            <input type="hidden" id="minPrice" name="min_price" value="{{ request('min_price', 0) }}">
                            <input type="hidden" id="maxPrice" name="max_price" value="{{ request('max_price', 500) }}">
                            <label for="rating_range">Tutor Rating:</label><br>
                            <strong id="ratingDisplay"></strong>
                            <div id="ratingSlider"></div>
                            <input type="hidden" id="minRating" name="min_rating" value="{{ request('min_rating', 0) }}">
                            <input type="hidden" id="maxRating" name="max_rating" value="{{ request('max_rating', 5) }}">

                            <label for="distance">Online Tutor Proximity</label>
                            <input type="text" name="postcode" id="postcode" value="{{ request()->postcode }}" placeholder="Enter Postcode">

                            <label for="distance">Show Tutors Within 15 Miles:</label>
                            <input type="number" name="distance" id="distance" value="{{ request('distance', 15) }}">

                           <br> <label for="gender">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="">All</option>
                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                             

                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="http://192.168.9.32:18212/tutors" class="btn btn-secondary">Clear Filter</a>

                        </form>
                        
                    </div>
                    <div class="col col-tutor-listing">
                            @if(!empty($tutors) && count($tutors) > 0)
                                @foreach($tutors as $tutor)
                                    @php $tutorcourses = getTutorCourses($tutor->tutor_specializations); @endphp

                                    <div class="tutor-block">
                                        @if(!empty($tutor->profile_image) && file_exists(public_path('storage/'.$tutor->profile_image)))
                                        <div class="tutor-img">
                                                <a href="{{route('tutors.show', $tutor->id)}}" class="media">
                                                    <img src="{{ asset('storage/' . $tutor->profile_image) }}" alt="{{ $tutor->firstname }}">
                                                </a>
                                        </div>
                                        @else
                                        <div class="tutor-img">
                                            <a href="{{route('tutors.show', $tutor->id)}}" class="media">
                                            <img src="{{ asset('storage/tutors/businessman-avatar-ilustration-free-vector.jpg') }}" alt="{{ $tutor->firstname }}">
                                            </a>
                                        </div>
                                        @endif
                                        <div class="tutor-block-content">
                                            <div class="tutor-title">
                                                <h3><a href="{{route('tutors.show', $tutor->id)}}">{{ $tutor->firstname }} {{ $tutor->lastname }}</a></h3>
                                                {!! $tutorcourses !!}
                                                <div class="tutor-price">£{{$tutor->rate}}/ hr</div>
                                            </div>
                                            <div class="tutor-description">
                                                <p>{{ $tutor->short_description }}</p>
                                            </div>
                                            <div class="tutor-location">
                                                <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 19.5H10.3631C11.142 18.8045 11.8766 18.0608 12.5625 17.2734C15.1359 14.3138 16.5 11.1938 16.5 8.25C16.5 6.06196 15.6308 3.96354 14.0836 2.41637C12.5365 0.869194 10.438 0 8.25 0C6.06196 0 3.96354 0.869194 2.41637 2.41637C0.869194 3.96354 0 6.06196 0 8.25C0 11.1938 1.36031 14.3138 3.9375 17.2734C4.62338 18.0608 5.35795 18.8045 6.13688 19.5H1.5C1.30109 19.5 1.11032 19.579 0.96967 19.7197C0.829018 19.8603 0.75 20.0511 0.75 20.25C0.75 20.4489 0.829018 20.6397 0.96967 20.7803C1.11032 20.921 1.30109 21 1.5 21H15C15.1989 21 15.3897 20.921 15.5303 20.7803C15.671 20.6397 15.75 20.4489 15.75 20.25C15.75 20.0511 15.671 19.8603 15.5303 19.7197C15.3897 19.579 15.1989 19.5 15 19.5ZM1.5 8.25C1.5 6.45979 2.21116 4.7429 3.47703 3.47703C4.7429 2.21116 6.45979 1.5 8.25 1.5C10.0402 1.5 11.7571 2.21116 13.023 3.47703C14.2888 4.7429 15 6.45979 15 8.25C15 13.6153 9.79969 18.0938 8.25 19.3125C6.70031 18.0938 1.5 13.6153 1.5 8.25ZM12 8.25C12 7.50832 11.7801 6.7833 11.368 6.16661C10.956 5.54993 10.3703 5.06928 9.68506 4.78545C8.99984 4.50162 8.24584 4.42736 7.51841 4.57205C6.79098 4.71675 6.1228 5.0739 5.59835 5.59835C5.0739 6.1228 4.71675 6.79098 4.57205 7.51841C4.42736 8.24584 4.50162 8.99984 4.78545 9.68506C5.06928 10.3703 5.54993 10.956 6.16661 11.368C6.7833 11.7801 7.50832 12 8.25 12C9.24456 12 10.1984 11.6049 10.9017 10.9017C11.6049 10.1984 12 9.24456 12 8.25ZM6 8.25C6 7.80499 6.13196 7.36998 6.37919 6.99997C6.62643 6.62996 6.97783 6.34157 7.38896 6.17127C7.8001 6.00097 8.2525 5.95642 8.68895 6.04323C9.12541 6.13005 9.52632 6.34434 9.84099 6.65901C10.1557 6.97368 10.37 7.37459 10.4568 7.81105C10.5436 8.2475 10.499 8.6999 10.3287 9.11104C10.1584 9.52217 9.87004 9.87357 9.50003 10.1208C9.13002 10.368 8.69501 10.5 8.25 10.5C7.65326 10.5 7.08097 10.2629 6.65901 9.84099C6.23705 9.41903 6 8.84674 6 8.25Z" fill="#00CBBA"></path>
                                                </svg>
                                                {{ $tutor->address }}
                                            </div>
                                            <div class="tutoe-meta">
                                                <div class="repeat"><span>{{ $tutor->qualification_1 }}</span></div>
                                                <div class="hours"><span>{{ $tutor->qualification_2 }}</span></div>
                                                <div class="travels"><span>{{ $tutor->qualification_3 }}</span></div>
                                                <div class="response"><span>{{ $tutor->qualification_4 }}</span></div>
                                                <div class="member"><span>{{ $tutor->experience }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <div class="tutor-block not-found">
                                    <p>Tutors not found.</p>
                                </div>
                            @endif
                    </div>
                    
                    <nav class="pagination-block" aria-label="Tutor Pagination">
                        <ul class="pagination justify-content-center">
                        {{ $tutors->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js"></script>


<script>
    // Price Range Slider
    const priceSlider = document.getElementById('priceSlider');
    noUiSlider.create(priceSlider, {
        start: [{{ request('min_price', 0) }}, {{ request('max_price', 500) }}],
        connect: true,
        range: {
            'min': 0,
            'max': 500
        },
        format: {
            to: value => parseInt(value),
            from: value => parseInt(value)
        }
    });

    priceSlider.noUiSlider.on('update', function(values) {
        document.getElementById('minPrice').value = values[0];
        document.getElementById('maxPrice').value = values[1];
        document.getElementById('priceDisplay').innerText = `$${values[0]} - $${values[1]}`;
    });

    // // Rating Range Slider
    const ratingSlider = document.getElementById('ratingSlider');
    noUiSlider.create(ratingSlider, {
        start: [{{ request('min_rating', 0) }}, {{ request('max_rating', 5) }}],
        connect: true,
        range: {
            'min': 0,
            'max': 5
        },
        format: {
            to: value => parseFloat(value).toFixed(1),
            from: value => parseFloat(value).toFixed(1)
        }
    });

    ratingSlider.noUiSlider.on('update', function(values) {
        document.getElementById('minRating').value = values[0];
        document.getElementById('maxRating').value = values[1];
        document.getElementById('ratingDisplay').innerText = `${values[0]} - ${values[1]} Stars`;
    });
    $('.select2').select2();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

@endsection