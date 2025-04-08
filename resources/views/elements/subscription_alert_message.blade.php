@if(Session::has('s_success'))
	
	<div class="alert alert-success alert-dismissible alert-alt fade show">
		<strong>Success</strong> {{ Session::get('s_success') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
	</div>

@elseif(Session::has('s_error'))

	<div class="alert alert-danger alert-dismissible alert-alt fade show">
		<strong>Error</strong> {{ Session::get('s_error') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
	</div>
	
@endif