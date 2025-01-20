<div class="row">
	<div class="col-12 d-block d-sm-none">
		<h3 class="step-heading">
			<span class="icon-wrapper">
				<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.4082 17.6276C17.9803 15.1591 15.78 13.3891 13.2122 12.5501C14.4824 11.7939 15.4692 10.6417 16.0212 9.27048C16.5731 7.89922 16.6597 6.38468 16.2676 4.95945C15.8755 3.53422 15.0264 2.27711 13.8506 1.38117C12.6749 0.485228 11.2376 0 9.75941 0C8.28122 0 6.84391 0.485228 5.66818 1.38117C4.49246 2.27711 3.64334 3.53422 3.25123 4.95945C2.85911 6.38468 2.94569 7.89922 3.49765 9.27048C4.04961 10.6417 5.03644 11.7939 6.3066 12.5501C3.73878 13.3882 1.53847 15.1582 0.110659 17.6276C0.0582987 17.7129 0.0235684 17.8079 0.00851736 17.9069C-0.00653367 18.006 -0.00160057 18.107 0.0230256 18.2041C0.0476518 18.3011 0.0914723 18.3923 0.151901 18.4722C0.212331 18.552 0.288144 18.619 0.37487 18.6691C0.461595 18.7192 0.557476 18.7514 0.656854 18.7638C0.756232 18.7763 0.857095 18.7687 0.953492 18.7415C1.04989 18.7143 1.13987 18.6681 1.21812 18.6056C1.29637 18.5431 1.3613 18.4656 1.4091 18.3776C3.17535 15.3251 6.29722 13.5026 9.75941 13.5026C13.2216 13.5026 16.3435 15.3251 18.1097 18.3776C18.1575 18.4656 18.2225 18.5431 18.3007 18.6056C18.379 18.6681 18.4689 18.7143 18.5653 18.7415C18.6617 18.7687 18.7626 18.7763 18.862 18.7638C18.9613 18.7514 19.0572 18.7192 19.1439 18.6691C19.2307 18.619 19.3065 18.552 19.3669 18.4722C19.4273 18.3923 19.4712 18.3011 19.4958 18.2041C19.5204 18.107 19.5254 18.006 19.5103 17.9069C19.4952 17.8079 19.4605 17.7129 19.4082 17.6276ZM4.50941 6.75255C4.50941 5.7142 4.81732 4.69917 5.39419 3.83581C5.97107 2.97245 6.79101 2.29954 7.75032 1.90218C8.70963 1.50482 9.76523 1.40086 10.7836 1.60343C11.802 1.806 12.7375 2.30601 13.4717 3.04024C14.2059 3.77447 14.706 4.70993 14.9085 5.72833C15.1111 6.74673 15.0071 7.80233 14.6098 8.76164C14.2124 9.72095 13.5395 10.5409 12.6762 11.1178C11.8128 11.6946 10.7978 12.0026 9.75941 12.0026C8.36748 12.0011 7.03299 11.4475 6.04874 10.4632C5.0645 9.47897 4.5109 8.14448 4.50941 6.75255Z" fill="black"/>
				</svg>
			</span>
			ACCOUNT INFORMATION</h3>
</div>
	<div class="col-12 form-field">
		<label class="form-label" for="accountType">Account Type</label>
		<div class="select-field">
		<select class="form-select" id="accountType" name="role" required>
			<option value="" disabled selected>Please Select Role</option>
			<option value="Tutor" {{ old('role') == 'Tutor' ? 'selected' : '' }}>Tutor</option>
			<option value="Student" {{ old('role') == 'Student' ? 'selected' : '' }}>Student</option>
		</select>
			<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.88003 0.711412L4.78941 4.87781C4.75142 4.91654 4.70631 4.94727 4.65665 4.96824C4.60699 4.98921 4.55376 5 4.5 5C4.44624 5 4.39301 4.98921 4.34335 4.96824C4.29369 4.94727 4.24858 4.91654 4.21059 4.87781L0.119973 0.711412C0.0626994 0.653143 0.0236882 0.578875 0.00787782 0.498012C-0.00793257 0.417149 0.000168735 0.333325 0.0311562 0.257154C0.0621436 0.180983 0.114624 0.115889 0.181953 0.0701121C0.249282 0.0243356 0.328432 -6.47572e-05 0.409384 1.29075e-07H8.59062C8.67157 -6.47572e-05 8.75072 0.0243356 8.81805 0.0701121C8.88538 0.115889 8.93786 0.180983 8.96884 0.257154C8.99983 0.333325 9.00793 0.417149 8.99212 0.498012C8.97631 0.578875 8.9373 0.653143 8.88003 0.711412Z" fill="currentColor"/>
			</svg>
		</div>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="username">Username</label>
		<input class="form-control" type="text" id="username" name="username" placeholder="Name" required value="{{ old('username') }}">
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="email">Email Address</label>
		<input class="form-control" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="password">Password</label>
		<input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
	</div>
	<div class="col-md-6 form-field">
		<label class="form-label" for="confirmPassword">Confirm Password</label>
		<input class="form-control" type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
	</div>
	<div class="col-12 step-submit">
		<button type="submit" class="btn btn-green next-btn">Continue</button>
	</div>
</div>