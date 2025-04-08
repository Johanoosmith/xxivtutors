
<div class="col-12 form-field">
	<label class="form-label">Subject</label> 
	<select name="subject_id" class="form-control" required>
		<option value="">Choose Subject</option>
		@foreach ($subjects as $id => $title)
			<option value="{{ $id }}" @selected($selected_id == $id)>
				{{ $title }}
			</option>
		@endforeach
	</select>
</div>

@if($course->level_type == 'single')
	<div class="col-12 form-field">
		<label class="form-label">Level</label> 
		<select name="level_id" class="form-control" required>
			<option value="">Choose Level</option>
			@foreach ($levels as $level_id => $level_title)
				<option value="{{ $level_id }}" @selected($selected_id == $level_id)>
					{{ $level_title }}
				</option>
			@endforeach
		</select>
	</div>
@elseif(!empty($levels))
	<div class="col-12 form-field">
		<div class="row">
			<div class="col-12">
				<table class="container">
					<thead>
						<tr>
							<th>Level</th>
						</tr>
					</thead>
					<tbody>
						@php
							$count = 0;
						@endphp
						@foreach ($levels as $level_id => $level_title)
						@php $count++; @endphp
						<tr>
							<td>
								<input
									type="checkbox"
									name="level[{{$count}}][level_id]"
									value="{{ $level_id }}"
									id="{{ 'LevelCheck'.$level_id }}"
								/>
								<label for="{{ 'LevelCheck'.$level_id }}">{{ $level_title }}</label>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endif





