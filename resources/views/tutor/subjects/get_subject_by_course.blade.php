<select name="subject_id" class="form-control" required>
	<option value="">Choose Subject</option>
	@foreach ($subjects as $id => $title)
		<option value="{{ $id }}" @selected($selected_id == $id)>
			{{ $title }}
		</option>
	@endforeach
</select>