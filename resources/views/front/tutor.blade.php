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
					
						<!-- Tutor Filter -->
						@include('includes/front/site_search')
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
                <div class="col-3 py-3 align-self-center">
                        <h4 class="filter-collapsable-link">Filters</h4>
                    </div>
                    <div class="col-9 py-3 d-flex align-items-center justify-content-end sortby">
                        <label>Sort By</label>
                        <div class="select-field">
                            <select class="select">
                                <option>Lessons Taught</option>
                                <option>Lessons Taught</option>
                            </select>
                            <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="col col-filter">
                        <form method="GET" action="{{route('tutors.tutorFilter')}}" id="filterForm">
                            <div class="filter-mobile-heading">
                                <h4>Filter</h4>
                                <button type="button" class="filter-close-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                        <path d="M10.05 23.95a1 1 0 0 0 1.414 0L17 18.414l5.536 5.536a1 1 0 0 0 1.414-1.414L18.414 17l5.536-5.536a1 1 0 0 0-1.414-1.414L17 15.586l-5.536-5.536a1 1 0 0 0-1.414 1.414L15.586 17l-5.536 5.536a1 1 0 0 0 0 1.414z"></path>
                                    </svg>
                                </button>
                            </div>
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
                           <div class="field select-field">
                                <select class="select" name="gender" id="gender">
                                    <option value="">All</option>
                                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                </svg>
                            </div>
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="http://192.168.9.32:8000/tutors" class="btn btn-secondary">Clear Filter</a>
                        </form>
                    </div>
                    <div class="col col-tutor-listing">
                            @if(!empty($tutors) && count($tutors) > 0)
                                @foreach($tutors as $tutor)
                                    @php $tutorcourses = getTutorCourses($tutor->tutor->tutor_specializations); @endphp
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
                                                <div class="tutor-price">£{{ @$tutor->tutor->rate}}/ hr</div>
                                            </div>
                                            <div class="tutor-description">
                                                <p>{{ Str::limit(@$tutor->tutor->short_description, 240, '...') }}</p>
                                            </div>
                                            <div class="tutor-location">
                                                <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 19.5H10.3631C11.142 18.8045 11.8766 18.0608 12.5625 17.2734C15.1359 14.3138 16.5 11.1938 16.5 8.25C16.5 6.06196 15.6308 3.96354 14.0836 2.41637C12.5365 0.869194 10.438 0 8.25 0C6.06196 0 3.96354 0.869194 2.41637 2.41637C0.869194 3.96354 0 6.06196 0 8.25C0 11.1938 1.36031 14.3138 3.9375 17.2734C4.62338 18.0608 5.35795 18.8045 6.13688 19.5H1.5C1.30109 19.5 1.11032 19.579 0.96967 19.7197C0.829018 19.8603 0.75 20.0511 0.75 20.25C0.75 20.4489 0.829018 20.6397 0.96967 20.7803C1.11032 20.921 1.30109 21 1.5 21H15C15.1989 21 15.3897 20.921 15.5303 20.7803C15.671 20.6397 15.75 20.4489 15.75 20.25C15.75 20.0511 15.671 19.8603 15.5303 19.7197C15.3897 19.579 15.1989 19.5 15 19.5ZM1.5 8.25C1.5 6.45979 2.21116 4.7429 3.47703 3.47703C4.7429 2.21116 6.45979 1.5 8.25 1.5C10.0402 1.5 11.7571 2.21116 13.023 3.47703C14.2888 4.7429 15 6.45979 15 8.25C15 13.6153 9.79969 18.0938 8.25 19.3125C6.70031 18.0938 1.5 13.6153 1.5 8.25ZM12 8.25C12 7.50832 11.7801 6.7833 11.368 6.16661C10.956 5.54993 10.3703 5.06928 9.68506 4.78545C8.99984 4.50162 8.24584 4.42736 7.51841 4.57205C6.79098 4.71675 6.1228 5.0739 5.59835 5.59835C5.0739 6.1228 4.71675 6.79098 4.57205 7.51841C4.42736 8.24584 4.50162 8.99984 4.78545 9.68506C5.06928 10.3703 5.54993 10.956 6.16661 11.368C6.7833 11.7801 7.50832 12 8.25 12C9.24456 12 10.1984 11.6049 10.9017 10.9017C11.6049 10.1984 12 9.24456 12 8.25ZM6 8.25C6 7.80499 6.13196 7.36998 6.37919 6.99997C6.62643 6.62996 6.97783 6.34157 7.38896 6.17127C7.8001 6.00097 8.2525 5.95642 8.68895 6.04323C9.12541 6.13005 9.52632 6.34434 9.84099 6.65901C10.1557 6.97368 10.37 7.37459 10.4568 7.81105C10.5436 8.2475 10.499 8.6999 10.3287 9.11104C10.1584 9.52217 9.87004 9.87357 9.50003 10.1208C9.13002 10.368 8.69501 10.5 8.25 10.5C7.65326 10.5 7.08097 10.2629 6.65901 9.84099C6.23705 9.41903 6 8.84674 6 8.25Z" fill="#00CBBA"></path>
                                                </svg>
                                                {{ $tutor->address }}
                                            </div>
                                            <div class="tutoe-meta">
                                                <div class="repeat"><span>{{ @$tutor->tutor->qualification_1 }}</span></div>
                                                <div class="hours"><span>{{ @$tutor->tutor->qualification_2 }}</span></div>
                                                <div class="travels"><span>{{ @$tutor->tutor->qualification_3 }}</span></div>
                                                <div class="response"><span>{{ @$tutor->tutor->qualification_4 }}</span></div>
                                                <div class="member"><span>{{ @$tutor->tutor->experience }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <div class="tutor-block not-found">
                                    <p class="alert" style="margin-top: 50px;">Sorry, we could not find a tutor matching this criteria.</p>
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
@endsection
@section('custom-js')        
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
    document.querySelectorAll('.filter-collapsable-link').forEach(link => {
        link.addEventListener('click', function() {
            const targetDiv = document.querySelector('.col-filter'); // Replace with your target div selector
            if (targetDiv) {
                targetDiv.classList.toggle('active'); // Replace 'your-class' with the class to toggle
            }
        });
    });
    document.querySelectorAll('.filter-close-button').forEach(link => {
        link.addEventListener('click', function() {
            const targetDiv = document.querySelector('.col-filter'); // Replace with your target div selector
            if (targetDiv) {
                targetDiv.classList.remove('active'); // Replace 'your-class' with the class to toggle
            }
        });
    });
    $('.select2').select2();

    jQuery(document).ready(function(){
		// Initialize jQuery Autocomplete
		jQuery("#SubjectSearch").autocomplete({
			source: availableTags,
			select: function(event, ui) {
				// Populate the input with the course title (label)
				jQuery("#SubjectSearch").val(ui.item.label);

				// Optionally populate a hidden input with the course ID (value)
				jQuery("#FilterSubjectValue").val(ui.item.value);

				return false; // Prevent default behavior
			},
			open: function() {
				$(".ui-autocomplete").css({
					"max-height": "300px",
					"overflow-y": "auto",
					"overflow-x": "hidden"
				});
			},
			_renderItem: function(ul, item) {
				return $("<li>")
					.append(item.label)
					.appendTo(ul);
			}
		});
		
		jQuery('#SiteSearchTab li').on('click',function(){
			var teach_type = jQuery(this).data('rel');
			
			jQuery('#SiteSearchTab li').removeClass('active');
			jQuery(this).addClass('active');
			jQuery('[name="teach_type"]').val(teach_type);
			
			if(teach_type == 'in-person'){
				jQuery('#SiteSearchPostcode').show();
			}else if(teach_type == 'online'){
				jQuery('#SiteSearchPostcode').hide();
			}
		});
		
    });
</script>
@endsection