@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4>Notification Templates</h4>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.notification-templates.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Add New
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body table-border-style mb-2">
                    <!-- Filter Form -->
					<form action="{{ route('admin.notification-templates.index') }}" method="GET" id="filter-form">
						<div class="row mb-4">
							<div class="col-md-2">
								<input type="text" name="search_name" class="form-control" placeholder="Search by Name"
									value="{{ request()->search_name }}">
							</div>
							<div class="col-md-4">
								<input type="text" name="search_subject" class="form-control" placeholder="Search by Subject"
									value="{{ request()->search_subject }}">
							</div>
					
					
							<div class="col-md-3 fiter-btn-pd">
								<button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
									<!-- SVG omitted for brevity -->
									Filter
								</button>
								<a href="{{ route('admin.notification-templates.index') }}" class="btn btn-dark btn-sm reset-btn">
									Reset
								</a>
							</div>
					
							<div class="col-md-2 text-right">
								<span class="col-form-label">Per Page: </span>
								<select name="per_page" class="form-control perpage_select">
									<option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
									<option value="25" {{ request()->per_page == 25 ? 'selected' : '' }}>25</option>
									<option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
									<option value="100" {{ request()->per_page == 100 ? 'selected' : '' }}>100</option>
								</select>
							</div>
						</div>
					</form>
					

                    <br>

					<div class="card-body table-border-style mb-2">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Subject</th>
										<th>Created</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									@if($emailtemplates->count())
										@php $i = $i ?? 0; @endphp
										@foreach($emailtemplates as $template)
											<tr>
												<td>{{ ++$i }}</td>
												<td>{{ $template->name }}</td>
												<td>{{ $template->subject }}</td>
												<td>{{ $template->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</td>
												<td class="text-end">
													<a href="{{ route('admin.notification-templates.edit', $template->id) }}"
													   class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit">
														<i class="far fa-edit"></i>
													</a>
													<a href="{{ Route('admin.delete-notification', $template->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="Delete">
														<i class="far fa-trash-alt"></i> Delete
													</a> 
												</div>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="7" class="text-center">{{ trans('admin.NO_ITEM_FOUND') }}</td>
										</tr>
									@endif
								</tbody>
							</table>
		
							@if ($emailtemplates->count())
									{!! $emailtemplates->withQueryString()->links('pagination::bootstrap-5') !!}
							@endif
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	@endsection

	@section('inline-js')
	@endsection
	