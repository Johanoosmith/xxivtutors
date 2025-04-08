@if(Session::has('success'))
	
		<div class="alert alert-success alert-dismissible alert-alt fade show">
		    <strong>Success</strong> {{ Session::get('success') }}
		    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
		</div>

@elseif(Session::has('info'))
	
		<div class="alert alert-info alert-dismissible alert-alt fade show">
		    <strong>Info</strong> {{ Session::get('info') }}
		    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
		</div>
	
@elseif(Session::has('warning'))
	
		<div class="alert alert-warning alert-dismissible alert-alt fade show">
		    <strong>Warning</strong> {{ Session::get('warning') }}
		    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
		</div>
	
@elseif(Session::has('error'))
	
		<div class="alert alert-danger alert-dismissible alert-alt fade show">
		    <strong>Error</strong> {{ Session::get('error') }}
		    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
		</div>

@elseif(Session::has('s_success'))
	
	<div class="alert alert-success alert-dismissible alert-alt fade show">
		<strong>Success</strong> {{ Session::get('s_success') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
	</div>

@elseif(Session::has('s_error'))

	<div class="alert alert-danger alert-dismissible alert-alt fade show">
		<strong>Error</strong> {{ Session::get('s_error') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
	</div>
	
@elseif($errors->any())
	
		<div class="alert alert-warning alert-dismissible alert-alt fade show">
			<strong>Warning</strong>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
		</div>
	
@endif