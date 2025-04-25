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
						@include('includes/front/tutor_search')
					</div>
                </div>
            </div>
            <div class="wave-shape">
                <svg width="1920" height="220" viewBox="0 0 1920 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1053.24 189.748C299.711 239.656 -19.6444 -62.5258 -36.6941 11.843C-53.7438 86.2118 -184.684 219.5 23.302 219.5H1947.18C1955.34 29.326 1966.78 172.932 1947.18 154.744C1922.83 132.15 1808.19 139.743 1067.11 188.829L1053.24 189.748Z" fill="#F5F5F7"></path>
                </svg>
            </div>
        </section>
      
        <section class="tutor-listing">
            <div class="container">
                <div class="row">
                    <div class="col-3 py-3 align-self-center">
                        @if(!empty($type) && $type == 'student')
                            
                        @else    
                            <h4 class="filter-collapsable-link">Filters</h4>
                        @endif
                    </div>
                    <div class="col-9 py-3 d-flex align-items-center justify-content-end sortby" style="margin-top:-60px;">
                        <form id="sortForm" method="GET" action="{{ route('tutors.tutorFilter') }}">
                            
                                <label for="sort_by" class="me-2">Sort By</label>
                                <div class="select-field position-relative">
                                    <select name="sort_by" class="select form-select" onchange="document.getElementById('sortForm').submit();">
                                        <option value="">Select</option>
                                        <option value="distance" {{ request('sort_by') == 'distance' ? 'selected' : '' }}>Distance</option>
                                    </select>
                                    <svg class="position-absolute end-0 me-2 top-50 translate-middle-y" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                            
                        
                            {{-- Optional: include other hidden filter inputs if needed --}}
                            {{-- Example: --}}
                            {{-- <input type="hidden" name="subject_id" value="{{ request('subject_id') }}"> --}}
                        </form>
                    </div>
                    
                    @if(!empty($type) && $type == 'student')
                        @include('front/listing/student_list')
                    @else    
                        @include('front/listing/tutor_list')
                    @endif

                    <nav class="pagination-block" aria-label="Tutor Pagination">
                        <ul class="pagination justify-content-center">
                            {{ $users->withQueryString()->links() }}

                        </ul>
                    </nav>
                </div>
            </div>
        </section>
@endsection



@section('inline-js')  
<!-- Add this to your <head> section -->

    <!-- <script>
        $(function () {
            const minPrice = parseInt($('#minPrice').val()) || 0;
            const maxPrice = parseInt($('#maxPrice').val()) || 500;
        
            $("#priceSlider").slider({
                range: true,
                min: 0,
                max: 500,
                values: [minPrice, maxPrice],
                slide: function (event, ui) {
                    $("#priceDisplay").text(ui.values[0] + " - " + ui.values[1]);
                    $("#minPrice").val(ui.values[0]);
                    $("#maxPrice").val(ui.values[1]);
                }
            });
        
            // Set initial text
            $("#priceDisplay").text($("#priceSlider").slider("values", 0) +
                " - " + $("#priceSlider").slider("values", 1));
        });
        </script>       -->
    
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
        document.getElementById('priceDisplay').innerText = `${values[0]} - ${values[1]}`;
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