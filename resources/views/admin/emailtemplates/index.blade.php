@extends('layouts.admin')
@section('title') Email Templates @endsection
@section('inline-css')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-10">
						<h4>All Email Templates</h4>
					</div>
				</div>
			</div>
			<div class="card-body table-border-style mb-2">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Subject</th>
								<th>Title</th>
								<th>constants</th>
								<th>Created</th>
								<th>Updated</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody class="list" id="countries">
							@if(count($emailtemplates))
								@php $i = ($emailtemplates->currentPage() - 1) * $emailtemplates->perPage(); @endphp
								@foreach($emailtemplates as $emailTemplate)
									<tr>
										<td>{{ ++$i }}</td>
										<td>{{ $emailTemplate->subject }}</td>
										<td>{{ $emailTemplate->action }}</td>
										<td>{{ $emailTemplate->constants }}</td>
										<td>{{date('d M Y h:i:s a',strtotime($emailTemplate->created_at))}}</td>
										<td>{{date('d M Y h:i:s a',strtotime($emailTemplate->updated_at))}}</td>
										<td class="noselect text-right">
											<div class="action-tools">
												<a href="{{ url('/admin/emailtemplates/'.$emailTemplate->id.'/edit') }}"
													class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title=""
													data-original-title="{{trans('admin.EDIT')}}"><i class="far fa-edit"></i></a>
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
					@if (count($emailtemplates))
						{!! $emailtemplates->withQueryString()->links('pagination::bootstrap-5') !!}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('inline-js')

@endsection