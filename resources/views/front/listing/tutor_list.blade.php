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
        <div class="form-group">
            <label for="price_range">Price Range:</label><br>
            <strong id="priceDisplay">{{ request('min_price', 0) }} - {{ request('max_price', 500) }}</strong>
            <div id="priceSlider" style="margin-top: 10px;"></div>
            <input type="hidden" id="minPrice" name="min_price" value="{{ request('min_price', 0) }}">
            <input type="hidden" id="maxPrice" name="max_price" value="{{ request('max_price', 500) }}">
        </div>
        
        <div class="form-group d-flex">
        <label for="ratingSelect">Tutor Rating:</label><br>
        <select id="ratingSelect" class="form-control m-2 mt-0" name="min_rating" class="m-2" style="width: 150px;">
            <option value="" >Rating</option>
            <option value="1" {{ request('min_rating', 0) == 1 ? 'selected' : '' }}>1+</option>
            <option value="2" {{ request('min_rating', 0) == 2 ? 'selected' : '' }}>2+</option>
            <option value="3" {{ request('min_rating', 0) == 3 ? 'selected' : '' }}>3+</option>
            <option value="4" {{ request('min_rating', 0) == 4 ? 'selected' : '' }}>4+</option>
            <option value="5" {{ request('min_rating', 0) == 5 ? 'selected' : '' }}>5</option>
        </select>
    </div>

        <label for="distance">Online Tutor Proximity</label>
        <input type="text" name="postcode" id="postcode" value="{{ request()->postcode }}" placeholder="Enter Postcode">

        <label for="distance">Show Tutors Travels in Miles:</label>
        <input type="number" name="distance" id="distance" value="{{ request('distance') }}">
        <label for="distance">Keyword:</label>
        <input type="text" name="keyword" id="keyword" placeholder="Enter Keyword" value="{{ request('keyword') }}">

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
        <a href="{{route('tutors.tutorFilter')}}" class="btn btn-secondary">Clear Filter</a>
    </form>
</div>
<div class="col col-tutor-listing">
        @if(!empty($users) && count($users) > 0)
            @foreach($users as $user)

                <div class="tutor-block">
                    @if(!empty($user->profile_image) && file_exists(public_path('storage/'.$user->profile_image)))
                    <div class="tutor-img">
                            <a href="{{route('tutor', $user->id)}}" class="media">
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->firstname }}">
                            </a>
                    </div>
                    @else
                    <div class="tutor-img">
                        <a href="{{route('tutor', $user->id)}}" class="media">
                        <img src="{{ asset('storage/tutors/businessman-avatar-ilustration-free-vector.jpg') }}" alt="{{ $user->firstname }}">
                        </a>
                    </div>
                    @endif
                    <div class="tutor-block-content">
                        <div class="tutor-title">
                            <h3><a href="{{route('tutor', $user->id)}}">{{ $user->full_name }}</a></h3>

                            @if(!empty($user->tutor->tutor_subjects) && $user->tutor->tutor_subjects->isNotEmpty())
                                @php
                                    $rates   = $user->tutor->tutor_subjects->pluck('hourly_rate');
                                    $minRate = getAmount($rates->min());
                                    $maxRate = getAmount($rates->max());
                                @endphp

                                <div class="tutor-price">{{$minRate}} - {{$maxRate}}/ hr</div>
                            @endif
                        </div>
                        <div class="tutor-description">
                            <p>{{ Str::limit(@$user->tutor->short_description, 240, '...') }}</p>
                        </div>
                        
                        @if(!empty($user->address))
                        <div class="tutor-location">
                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 19.5H10.3631C11.142 18.8045 11.8766 18.0608 12.5625 17.2734C15.1359 14.3138 16.5 11.1938 16.5 8.25C16.5 6.06196 15.6308 3.96354 14.0836 2.41637C12.5365 0.869194 10.438 0 8.25 0C6.06196 0 3.96354 0.869194 2.41637 2.41637C0.869194 3.96354 0 6.06196 0 8.25C0 11.1938 1.36031 14.3138 3.9375 17.2734C4.62338 18.0608 5.35795 18.8045 6.13688 19.5H1.5C1.30109 19.5 1.11032 19.579 0.96967 19.7197C0.829018 19.8603 0.75 20.0511 0.75 20.25C0.75 20.4489 0.829018 20.6397 0.96967 20.7803C1.11032 20.921 1.30109 21 1.5 21H15C15.1989 21 15.3897 20.921 15.5303 20.7803C15.671 20.6397 15.75 20.4489 15.75 20.25C15.75 20.0511 15.671 19.8603 15.5303 19.7197C15.3897 19.579 15.1989 19.5 15 19.5ZM1.5 8.25C1.5 6.45979 2.21116 4.7429 3.47703 3.47703C4.7429 2.21116 6.45979 1.5 8.25 1.5C10.0402 1.5 11.7571 2.21116 13.023 3.47703C14.2888 4.7429 15 6.45979 15 8.25C15 13.6153 9.79969 18.0938 8.25 19.3125C6.70031 18.0938 1.5 13.6153 1.5 8.25ZM12 8.25C12 7.50832 11.7801 6.7833 11.368 6.16661C10.956 5.54993 10.3703 5.06928 9.68506 4.78545C8.99984 4.50162 8.24584 4.42736 7.51841 4.57205C6.79098 4.71675 6.1228 5.0739 5.59835 5.59835C5.0739 6.1228 4.71675 6.79098 4.57205 7.51841C4.42736 8.24584 4.50162 8.99984 4.78545 9.68506C5.06928 10.3703 5.54993 10.956 6.16661 11.368C6.7833 11.7801 7.50832 12 8.25 12C9.24456 12 10.1984 11.6049 10.9017 10.9017C11.6049 10.1984 12 9.24456 12 8.25ZM6 8.25C6 7.80499 6.13196 7.36998 6.37919 6.99997C6.62643 6.62996 6.97783 6.34157 7.38896 6.17127C7.8001 6.00097 8.2525 5.95642 8.68895 6.04323C9.12541 6.13005 9.52632 6.34434 9.84099 6.65901C10.1557 6.97368 10.37 7.37459 10.4568 7.81105C10.5436 8.2475 10.499 8.6999 10.3287 9.11104C10.1584 9.52217 9.87004 9.87357 9.50003 10.1208C9.13002 10.368 8.69501 10.5 8.25 10.5C7.65326 10.5 7.08097 10.2629 6.65901 9.84099C6.23705 9.41903 6 8.84674 6 8.25Z" fill="#00CBBA"></path>
                            </svg>
                            {{ $user->address }}
                        </div>
                        @endif

                        <div class="tutoe-meta">
                            @php 
                                $lessonData = getUserLessonData($user->id);
                            @endphp
                            @if(!empty($lessonData['repeated_lessons']))
                                <div class="repeat"><span>{{ $lessonData['repeated_lessons'] .' Repeat Lessons' }}</span></div>
                            @else
                                <div class="repeat"><span>{{ 'No Repeat Lessons' }}</span></div>
                            @endif
                            
                            @if(!empty($lessonData['total_hours']))
                                <div class="hours"><span>{{ $lessonData['total_hours'] . ' Hours Taught' }}</span></div>
                            @else
                                <div class="hours"><span>{{ 'No Lessons Taught' }}</span></div>    
                            @endif

                            
                            <div class="response"><span>{{ @$user->tutor->qualification_4 }}</span></div>
                            

                            @if($user->tutor->distance)
                                <div class="travels"><span>Travel {{ @$user->tutor->distance }} Miles</span></div>
                            @else
                                <div class="travels"><span>Travel Miles</span></div>
                            @endif

                            @if($user->member_since)
                            <div class="member"><span>Member for {{ @$user->member_since }}</span></div>
                            @endif
                           
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
                    