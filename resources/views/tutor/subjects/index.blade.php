@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
                    
					<div class="title-with-link-wrapper">
						<h3>Subjects</h3>
						<a href="{{ route('tutor.subjects.create') }}" class="btn btn-yellow btn-small">Add a Subject</a>
					</div>
						
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Level</th>
									<th>Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }})</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($subject_tutors->isEmpty())
									<tr>
										<td colspan="7">No Subject found.</td>
									</tr>
								@else
									@foreach($subject_tutors as $subject)
									<tr>
										<td>{{ $subject->subject->title }}</td>
										<td>{{ $subject->level->title }}</td>
										<td>{{ $subject->hourly_rate }}</td>
										<td class="noselect text-right">	
											<div class="action-tools">
												<a href="{{ route('tutor.subjects.edit', $subject) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Edit">
													<svg class="icon">
														<use xlink:href="#edit"></use>
													</svg>
												</a>	
												
												<form id="{{ 'SubjectDelete_'.$subject->id }}" action="{{ route('tutor.subjects.destroy') }}" method="POST" style="display: inline;" >
													@csrf
													@method('POST')
													<input type="hidden" name="subject_tutor_id" value="{{ $subject->id }}">
													<button type="submit" class="icon-btn">
														<svg class="icon">
															<use xlink:href="#delete"></use>
														</svg>
													</button>
												</form>
												
											</div>                 
										</td> 
										
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					
					
					<div class="title-with-link-wrapper">
						<h3>Online Subjects</h3>
						<a href="{{ route('tutor.subjects.create') }}" class="btn btn-yellow btn-small">Add a Subject</a>
					</div>
						
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Level</th>
									<th>Hourly Rate ({{ config('constants.CURRENCY_SYMBOL') }})</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($subject_tutors_online->isEmpty())
									<tr>
										<td colspan="7">No Online Subject found.</td>
									</tr>
								@else
									@foreach($subject_tutors_online as $subjectO)
									<tr>
										<td>{{ $subjectO->subject->title }}</td>
										<td>{{ $subjectO->level->title }}</td>
										<td>{{ $subjectO->hourly_rate }}</td>
										<td class="noselect text-right">	
											<div class="action-tools">
												<a href="{{ route('tutor.subjects.edit', $subjectO) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Edit">
													<svg class="icon">
														<use xlink:href="#edit"></use>
													</svg>
												</a>	
												
												<form id="{{ 'SubjectDelete_'.$subjectO->id }}" action="{{ route('tutor.subjects.destroy') }}" method="POST" style="display: inline;" >
													@csrf
													@method('POST')
													<input type="hidden" name="subject_tutor_id" value="{{ $subjectO->id }}">
													<button type="submit" class="icon-btn">
														<svg class="icon">
															<use xlink:href="#delete"></use>
														</svg>
													</button>
												</form>
												
											</div>                 
										</td> 
										
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					
				</div>
            </div>
        </div>
</section>
@endsection