@extends('layouts.admin')
@section('title') Manage Page @endsection
@section('inline-css')
@endsection
@section('content')


<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-10">
							<h4>All Pages</h4>
						</div>
						<div class="col-md-2">
							<a href="{{Route('admin.pages.create')}}" class="btn btn-primary btn-sm custom_btn float-right"><i class="fa fa-plus" aria-hidden="true"></i>
								Add New</a>
						</div>
					</div>
				</div>
				<div class="card-body table-border-style mb-2">
					{{ html()->modelForm($search,'get',route('admin.pages.index'))->class('')->id('filter-form')->open() }}
					<div class="row mb-4"> 
						<div class="col-md-4">
							{{ html()->text('search_text')->class('form-control')->placeholder('Search by title') }}
						</div>
						<div class="col-md-3 ">
							@php $status = Config::get('constants.SEARCH_STATUS'); @endphp
							{{ html()->select('status', $status)->class('form-control')->id('status')  }}
						</div>
						<div class="col-md-3 fiter-btn-pd">
							<button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn"><i data-feather="filter"></i></button>
							<a href="{{ route('admin.pages.index') }}" class="btn btn-dark btn-sm reset-btn"><i data-feather="refresh-ccw"></i></a>
						</div>
						<div class="col-md-2 text-right">
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
									<th>Title</th>
									<th>Page Slug</th>									
									<th>Status</th>
									<th>Created</th>
									<th>Updated</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody class="list" id="pages">
							@if(count($pages))
								@php 
									$i = ($pages->currentPage() - 1) * $pages->perPage(); 					
									$status = config('constants.STATUS');
								@endphp
								@foreach($pages as $page)
									<tr>
										<td>{{ ++$i }}</td>
										<td>{{ $page->title }}</td>
										<td>{{ $page->page_url }}</td>
										
										<td>
											@if($page->status== 1)
											<div><label class="badge bg-light-success">Active</label></div>
											@else
											<div><label class="badge bg-light-warning">Deactive</label></div>
											@endif
										</td> 
										
										<td>{{date('M d, Y h:i:s a',strtotime($page->created_at))}}</td>
										<td>{{date('M d, Y h:i:s a',strtotime($page->updated_at))}}</td>

										<td class="noselect text-right">
											<div class="action-tools">
												<a href="{{ url('/admin/pages/'.$page->id.'/edit') }}"
													class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title=""
													data-original-title="{{trans('admin.EDIT')}}">
													<i class="far fa-edit"></i>
												</a>												
											</div>
										</td>
									</tr>
								@endforeach
							@else
							<tr>
								<td class="noselect text-center" colspan="7">{{trans('admin.NO_ITEM_FOUND')}}</th>
							</tr>
							@endif

							</tbody>
						</table>
						@if (count($pages))
						{!! $pages->withQueryString()->links('pagination::bootstrap-5') !!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('inline-js')


@endsection