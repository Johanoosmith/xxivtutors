<div class="row">
	<div class="col-12 d-block d-sm-none">
		<h3 class="step-heading">
			<span class="icon-wrapper">
				<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8697 14.1206C18.2896 13.7012 18.5756 13.1667 18.6916 12.5846C18.8077 12.0026 18.7485 11.3992 18.5215 10.8509C18.2945 10.3025 17.91 9.83375 17.4166 9.50396C16.9232 9.17417 16.343 8.99814 15.7495 8.99814C15.156 8.99814 14.5759 9.17417 14.0825 9.50396C13.5891 9.83375 13.2045 10.3025 12.9776 10.8509C12.7506 11.3992 12.6914 12.0026 12.8074 12.5846C12.9234 13.1667 13.2095 13.7012 13.6294 14.1206C12.8407 14.6238 12.2686 15.4036 12.0253 16.3069C11.9741 16.4991 12.0013 16.7037 12.101 16.8759C12.2007 17.048 12.3647 17.1735 12.5569 17.2247C12.6199 17.2413 12.6848 17.2498 12.75 17.25C12.9154 17.2499 13.0761 17.1952 13.2072 17.0943C13.3383 16.9934 13.4323 16.8521 13.4747 16.6922C13.74 15.6956 14.6756 15 15.75 15C16.8244 15 17.76 15.6956 18.0253 16.6922C18.0491 16.789 18.0919 16.8802 18.1513 16.9603C18.2107 17.0404 18.2854 17.1078 18.3712 17.1587C18.457 17.2096 18.552 17.2428 18.6508 17.2565C18.7496 17.2702 18.8501 17.264 18.9464 17.2384C19.0428 17.2128 19.1331 17.1682 19.212 17.1073C19.291 17.0464 19.357 16.9703 19.4061 16.8836C19.4553 16.7968 19.4867 16.7011 19.4985 16.6021C19.5103 16.5031 19.5022 16.4027 19.4747 16.3069C19.2312 15.4034 18.6587 14.6236 17.8697 14.1206ZM15.75 10.5C16.0467 10.5 16.3367 10.588 16.5834 10.7528C16.83 10.9176 17.0223 11.1519 17.1358 11.426C17.2494 11.7001 17.2791 12.0017 17.2212 12.2926C17.1633 12.5836 17.0204 12.8509 16.8107 13.0607C16.6009 13.2704 16.3336 13.4133 16.0426 13.4712C15.7517 13.5291 15.4501 13.4994 15.176 13.3858C14.9019 13.2723 14.6676 13.08 14.5028 12.8334C14.338 12.5867 14.25 12.2967 14.25 12C14.25 11.6022 14.408 11.2206 14.6893 10.9393C14.9706 10.658 15.3522 10.5 15.75 10.5ZM19.5 3.75V6.75C19.5 6.94891 19.421 7.13968 19.2803 7.28033C19.1397 7.42098 18.9489 7.5 18.75 7.5C18.5511 7.5 18.3603 7.42098 18.2197 7.28033C18.079 7.13968 18 6.94891 18 6.75V3.75H10.0003C9.67589 3.7492 9.36033 3.64401 9.10031 3.45L6.49969 1.5H1.5V14.25H9C9.19891 14.25 9.38968 14.329 9.53033 14.4697C9.67098 14.6103 9.75 14.8011 9.75 15C9.75 15.1989 9.67098 15.3897 9.53033 15.5303C9.38968 15.671 9.19891 15.75 9 15.75H1.5C1.10218 15.75 0.720644 15.592 0.43934 15.3107C0.158035 15.0294 0 14.6478 0 14.25V1.5C0 1.10218 0.158035 0.720644 0.43934 0.43934C0.720644 0.158035 1.10218 0 1.5 0H6.49969C6.82411 0.000804693 7.13967 0.105989 7.39969 0.3L10.0003 2.25H18C18.3978 2.25 18.7794 2.40804 19.0607 2.68934C19.342 2.97064 19.5 3.35218 19.5 3.75Z" fill="black"/>
				</svg>                                                
			</span>
			PERSONAL INFORMATION</h3>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="title">Title</label>
		<div class="select-field">
			<select class="form-select" id="title" name="title" required>
				<option value="" disabled selected>Select</option>
				<option value="Mr"{{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
				<option value="Ms"{{ old('title') == 'Ms' ? 'selected' : '' }}>Ms</option>
				<option value="Mrs"{{ old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
			</select>
			<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
			</svg>
		</div>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="gender">Gender</label>
		<div class="select-field">
			<select class="form-select" id="gender" name="gender" required>
				<option value="" disabled selected>Select</option>
				<option value="male"{{ old('gender') == 'male' ? 'selected' : '' }}>male</option>
				<option value="female"{{ old('gender') == 'female' ? 'selected' : '' }}>female</option>
			</select>
			<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
			</svg>
		</div>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="firstName">First Name</label>
		<input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" value="{{ old('firstName') }}" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="lastName">Last Name</label>
		<input class="form-control" type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="address1">Address 1</label>
		<input class="form-control" type="text" id="address1" name="address1" placeholder="Address 1" value="{{ old('address1') }}" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="address2">Address 2</label>
		<input class="form-control" type="text" id="address2" name="address2" placeholder="Address 2" value="{{ old('address2') }}">
	</div>
	<div class="col-lg-3 col-md-6 form-field">
		<label class="form-label" for="town">Town</label>
		<input class="form-control" type="text" id="town" name="town" placeholder="Town" value="{{ old('town') }}" required>
	</div>
	<div class="col-lg-3 col-md-6 form-field">
		<label class="form-label" for="county">County</label>
		<div class="select-field">
			<select class="form-select" id="county" name="county">
				<option value="" disabled selected>Select</option>
				@foreach($countyies as $id => $name)
				<option value="{{ $id }}">{{ $name }}</option>
				@endforeach
			</select>
			<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
			</svg>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 form-field">
		<label class="form-label" for="country">Country</label>
		<div class="select-field">
			<select class="form-select" id="country" name="country">
				<option value="" disabled selected>Select</option>
				@foreach($countries as $id => $name)
				<option value="{{ $id }}">{{ $name }}</option>
				@endforeach
			</select>
			<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
			</svg>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 form-field">
		<label class="form-label" for="postcode">Postcode</label>
		<input class="form-control" type="text" id="postcode" name="postcode" placeholder="Postcode" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="phoneNumber">Phone Number</label>
		<input class="form-control" type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number"value="{{old('phoneNumber')}}" required>
	</div>
	<div class="col-md-12 form-field">
		<label class="form-label" for="dobYear">Date of Birth</label>
		<div class="dob-select">
			<div class="select-field">
				<select class="form-select" id="dobYear" name="dobYear">
					<option value="" disabled selected>Year</option>
				</select>
			</div>
			<div class="select-field">
				<select class="form-select" id="dobMonth" name="dobMonth">
					<option value="" disabled selected>Month</option>
				</select>
			</div>
			<div class="select-field">
				<select class="form-select" id="dobDay" name="dobDay">
					<option value="" disabled selected>Day</option>
				</select>
			</div>
		</div>
	</div>
	<!-- <div class="col-md-12 form-field">
		<label class="form-label" for="dobYear">Date of Birth</label>
		<div class="dob-select">
			<div class="select-field">
				<select class="form-select" id="dobYear" name="dobYear">
					<option value="" disabled selected>Year</option>
				</select>
				<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
				</svg>
			</div>
			<div class="select-field">
				<select class="form-select" id="dobMonth" name="dobMonth">
					<option value="" disabled selected>Month</option>
				</select>
				<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
				</svg>
			</div>
			<div class="select-field">
				<select class="form-select" id="dobDay" name="dobDay">
					<option value="" disabled selected>Day</option>
				</select>
				<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
				</svg>
			</div>
		</div>
	</div> -->
	<div class="col-12 step-submit">
		<a href="{{ route('register.step',$step-1) }}" class="btn btn-yellow">Previous</a>
		<button type="submit" class="btn btn-green">Continue</button>
	</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const yearSelect = document.getElementById('dobYear');
        const monthSelect = document.getElementById('dobMonth');
        const daySelect = document.getElementById('dobDay');

        // Populate Year Dropdown (last 100 years)
        const currentYear = new Date().getFullYear();
        for (let year = currentYear; year >= currentYear - 100; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }

        // Populate Month Dropdown
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index + 1;
            option.textContent = month;
            monthSelect.appendChild(option);
        });

        // Function to update Day Dropdown based on selected Year and Month
        function updateDays() {
            const selectedYear = yearSelect.value;
            const selectedMonth = monthSelect.value;

            if (selectedYear && selectedMonth) {
                const daysInMonth = new Date(selectedYear, selectedMonth, 0).getDate();
                daySelect.innerHTML = '<option value="" disabled selected>Day</option>'; // Reset the Day dropdown
                for (let day = 1; day <= daysInMonth; day++) {
                    const option = document.createElement('option');
                    option.value = day;
                    option.textContent = day;
                    daySelect.appendChild(option);
                }
            }
        }

        // Event listeners to update Day dropdown on Year or Month change
        yearSelect.addEventListener('change', updateDays);
        monthSelect.addEventListener('change', updateDays);
    });
</script>
