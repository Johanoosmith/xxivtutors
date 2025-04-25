<div class="col col-tutor-listing">
    @if(!empty($users) && count($users) > 0)
        @foreach($users as $user)
            <div class="tutor-block">
                @if(!empty($user->profile_image) && file_exists(public_path('storage/'.$user->profile_image)))
                <div class="tutor-img">
                        <a href="{{route('profile', $user->id)}}" class="media">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->firstname }}">
                        </a>
                </div>
                @else
                <div class="tutor-img">
                    <a href="{{route('profile', $user->id)}}" class="media">
                    <img src="{{ asset('storage/tutors/businessman-avatar-ilustration-free-vector.jpg') }}" alt="{{ $user->firstname }}">
                    </a>
                </div>
                @endif
                <div class="tutor-block-content">
                    <div class="tutor-title">
                        <h3><a href="{{route('profile', $user->id)}}">{{ $user->full_name }}</a></h3>
                    </div>
                    <div class="tutor-description">
                        <p>{{ Str::limit(@$user->student->short_description, 240, '...') }}</p>
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
                        @if(!empty($user->student->distance))
                        <div class="repeat"><span>Travel {{ @$user->student->distance }} Miles</span></div>
                        @endif

                        @if($user->last_login_human)
                        <div class="hours"><span>Last login {{ @$user->last_login_human }}</span></div>
                        @endif

                        @if($user->member_since)
                        <div class="travels"><span>Member for {{ @$user->member_since }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else 
        <div class="tutor-block not-found">
            <p class="alert" style="margin-top: 50px;">Sorry, we could not find a student matching this criteria.</p>
        </div>
        
    @endif
</div> 