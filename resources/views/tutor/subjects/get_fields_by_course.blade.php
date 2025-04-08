
@if($course->level_type == 'single')
	<div class="col-12 form-field">
		<select name="level_id" class="form-control" required>
			<option value="">Choose Level</option>
			@foreach ($levels as $level_id => $level_title)
				<option value="{{ $level_id }}" @selected($selected_id == $level_id)>
					{{ $level_title }}
				</option>
			@endforeach
		</select>
	</div>
	
	<div class="col-12 form-field">
		<label class="form-label">Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }})</label> 
		<input type="text" name="hourly_rate" value="" class="form-control level-hourly-rate numeric" data-key="1" autocomplete="off" />
	</div>
	<div class="col-12 form-field">
		<label class="form-label">Student Rate ({{ config('constants.CURRENCY_SYMBOL') }})</label> 
		<input type="text" name="lesson_rate" value="" class="form-control" id="LevelLessonRate_1" autocomplete="off"  readonly />
	</div>
	
@elseif(!empty($levels))
	<div class="col-12">
		<div class="row">
			<div class="col-12">
				<table class="container">
					<thead>
						<tr>
							<th>Level</th>
							<th>Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }}):</th>
							<th>Student Rate ({{ config('constants.CURRENCY_SYMBOL') }}):</th>
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
							<td>
								 <input
									type="text"
									name="level[{{$count}}][hourly_rate]"
									value=""
									class="form-control level-hourly-rate numeric"
									data-key="{{$count}}"
									autocomplete="off"
								/>
							</td>
							<td>
								 <input
									type="text"
									id="LevelLessonRate_{{$count}}"
									name="level[{{$count}}][lesson_rate]"
									value=""
									class="form-control"
									autocomplete="off"
									readonly
									
								/>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endif





