<form class="search-form" action="{{ route('tutors.tutorFilter') }}" method="GET">
						
	@php
		$subjects	= getSubjectList();
		$levels		= getLevelList();
	@endphp
	
	<script>
		// Convert Laravel $subject_list to JavaScript array
		var availableTags = @json($subjects->map(fn($title, $id) => ['label' => $title, 'value' => $id])->values());
	</script>

	<ul class="search-tabs" id="SiteSearchTab">
		<li class="active" data-rel="in-person">In-person</li>
		<li data-rel="online">Online</li>
	</ul>
	<div class="search-field-group" id="SiteSearchTabContent">
		<input type="hidden" name="teach_type" id="in-person">
		
		<div class="field">                                    
    <input type="text" name="subject_title" id="SubjectSearch" class="input" placeholder="Enter a subject" value="{{ old('subject_title', request('subject_title')) }}">
    <input type="hidden" name="subject_id" id="FilterSubjectValue" value="{{ old('subject_id', request('subject_id')) }}">
</div>

<div class="field select-field">
    <select id="level" name="level" class="select">
        <option value="All Levels" {{ old('level', request('level')) == 'All Levels' ? 'selected' : '' }}>All Levels</option>
        @foreach ($levels as $level_id => $level_title)
            <option value="{{ $level_id }}" {{ old('level', request('level')) == $level_id ? 'selected' : '' }}>
                {{ $level_title }}
            </option>
        @endforeach
    </select>
    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"></path>
    </svg>
</div>

<div class="field postcode" id="SiteSearchPostcode">
    <input type="text" name="postcode" placeholder="Postcode" class="input number" maxlength="8" value="{{ old('postcode', request('postcode')) }}">
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


@section('custom-js')        
<script>
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