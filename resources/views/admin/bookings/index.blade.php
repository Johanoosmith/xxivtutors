@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Bookings List</h4>
			</div>

			<div class="card-body">
				<form method="GET" action="{{ route('admin.booking.index') }}" id="filter-form">
					<div class="row mb-4">
						<div class="col-md-4">
							<input type="text" name="user" class="form-control" value="{{ request('user') }}" placeholder="Search Tutor or Student">
						</div>
						<div class="col-md-3">
							<select name="status" class="form-control">
								<option value="">All Status</option>
								<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending</option>
								<option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Confirmed</option>
								<option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Cancelled</option>
							</select>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-sm btn-primary">Filter</button>
							<a href="{{ route('admin.booking.index') }}" class="btn btn-sm btn-dark">Reset</a>
						</div>
						<div class="col-md-2">
							<select name="per_page" class="form-control" onchange="document.getElementById('filter-form').submit();">
								<option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
								<option value="25" {{ request()->per_page == 25 ? 'selected' : '' }}>25</option>
								<option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
							</select>
						</div>
					</div>
				</form>

				@if($bookings->isEmpty())
					<p>No bookings found.</p>
				@else
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Tutor</th>
								<th>Student</th>
								<th>Subject</th>
								<th>Start Date & Time</th>
								<th>Hourly Rate</th>
								<th>Student Rate</th>
								<th>Commission</th>
								<th>Status</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody>
							@foreach($bookings as $index => $booking)
							<tr>
								<td>{{ $index + 1 }}</td>
								<td>{{ $booking->tutor->fullname ?? '-' }}</td>
								<td>{{ $booking->student->fullname ?? '-' }}</td>
								<td>{{ $booking->subject->title ?? '-' }}</td>
								<td>{{ $booking->start_date }} {{ $booking->start_time }}</td>
								<td>£{{ number_format($booking->hourly_rate, 2) }}</td>
								<td>£{{ number_format($booking->student_rate, 2) }}</td>
								<td>£{{ number_format($booking->student_rate - $booking->hourly_rate, 2) }}</td>
								<td>
									@switch($booking->status)
										@case(1) <span class="badge bg-warning">Pending</span> @break
										@case(2) <span class="badge bg-success">Confirmed</span> @break
										@case(3) <span class="badge bg-danger">Cancelled</span> @break
									@endswitch
								</td>
							    <td>{{ $booking->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if (count($bookings))
					{!! $bookings->withQueryString()->links('pagination::bootstrap-5') !!}
					@endif

				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
