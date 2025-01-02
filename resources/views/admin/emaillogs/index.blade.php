@extends('layouts.admin')
@section('title') Manage Email Logs @endsection
@section('inline-css')
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-10">
						<h4>All Email Logs</h4>
					</div>
				</div>
			</div>
			<div class="card-body table-border-style mb-2">
				{{ html()->modelForm($search,'get',route('admin.emaillogs.index'))->class('')->id('filter-form')->open() }}
				<div class="row mb-4">
					<div class="col-md-4">
						{{ html()->text('search_text')->class('form-control')->placeholder('Search by name, email & subject') }}
					</div>
					<div class="col-md-3 fiter-btn-pd">
						<button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn"><i data-feather="filter"></i></button>
						<a href="{{ route('admin.emaillogs.index') }}" class="btn btn-dark btn-sm reset-btn"><i data-feather="refresh-ccw"></i></a>
					</div>
					<div class="col-md-5 text-right">
						<span class="col-form-label">Per Page: </span>
						@php $showrecord = Config::get('constants.SHOW_RECORD'); @endphp
						{{ html()->select('showrecord', $showrecord)->class('form-control perpage_select')->id('showrecord')  }}
					</div>
				</div>
				{{ html()->form()->close() }}

				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>To Name</th>
								<th>To Email</th>
								<th>Subject</th>
								<th>Created</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody class="list" id="countries">
							@if(count($emaillogs))
							@php $i = ($emaillogs->currentPage() - 1) * $emaillogs->perPage(); @endphp
							@foreach($emaillogs as $emaillog)
							<tr>
								<td>{{ ++$i }}</td>
								<td> {!! $emaillog->to_name !!}</td>
								<td> {!! $emaillog->to_email !!}</td>
								<td> {!! $emaillog->subject !!}</td>
								<td>{{date('d M Y h:i:s a',strtotime($emaillog->created_at))}}</td>
								<td class="noselect text-right">
									<div class="action-tools">
										<a href="{{ route('admin.emaillogs.show', $emaillog->id) }}"
											class="btn btn-info btn-sm show" data-toggle="tooltip"
											title="" data-original-title="View">
											<i class="far fa-eye"></i>
										</a>
										&nbsp;&nbsp;
										<a href="{{ Route('admin.delete-emaillog', $emaillog->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="Delete">
											<i class="fa fa-trash"></i> </a>
									</div>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td class="noselect text-center" colspan="6">{{trans('admin.NO_ITEM_FOUND')}}</th>
							</tr>
							@endif
						</tbody>
					</table>
					@if (count($emaillogs))
					{!! $emaillogs->withQueryString()->links('pagination::bootstrap-5') !!}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('inline-js')

@endsection