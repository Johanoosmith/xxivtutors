@extends('layouts.admin')
@section('title') All News @endsection
@section('inline-css')
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-10">
						<h4>Text Settings</h4>
					</div>
					<div class="col-md-2">
						<a href="{{Route('admin.textsettings.create')}}" class="btn btn-primary btn-sm custom_btn float-right"><i class="fa fa-plus" aria-hidden="true"></i>
							Add New</a>
					</div>
				</div>
			</div>
			<div class="card-body table-border-style mb-2">
				{{ html()->modelForm($search,'get',route('admin.textsettings.index'))->class('')->id('filter-form')->open() }}
				<div class="row mb-4">
					<div class="col-md-4">
						{{ html()->text('search_text')->class('form-control')->placeholder('Search by title') }}
					</div>
					<div class="col-md-3 ">
						{{ html()->select('key_text', $textcatlist)->class('form-control')->id('textcatlist')  }}
					</div>
					<div class="col-md-3 fiter-btn-pd">
						<button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn"><i data-feather="filter"></i></button>
						<a href="{{ route('admin.textsettings.index') }}" class="btn btn-dark btn-sm reset-btn"><i data-feather="refresh-ccw"></i></a>
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
								<th>Text Category</th>
								<th>Key value</th>
								<th width="250px">Text value</th>
								<th style="width: 10%;">Created</th>
								<th style="width: 10%;">Modified</th>
								<th class="text-right">Action</th>
							</tr>


						</thead>
						<tbody class="list" id="news">
							@if(count($textsettings))
							@php
							$i = ($textsettings->currentPage() - 1) * $textsettings->perPage();
							@endphp
							@foreach($textsettings as $textsetting)
							<tr>
								<td>{{ ++$i }}</td>
								<td> {{ isset($textcatlist[$textsetting->key_text]) ? $textcatlist[$textsetting->key_text] : '-' }}</td>
								<td> {{ $textsetting->key_value }}</td>
								<td width="50%">@if(strlen($textsetting->value) > 70) {{ substr($textsetting->value,0,70).'..' }} @else {{$textsetting->value}} @endif</td>
								<td> {{date('D, M d, Y',strtotime($textsetting->created_at))}} </td>
								<td> {{date('D, M d, Y',strtotime($textsetting->updated_at))}} </td>
								<td class="noselect text-right">
									<div class="action-tools">
										<a href="{{ url('/admin/textsettings/'.$textsetting->id.'/edit') }}" class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title="" data-original-title="{{trans('admin.EDIT')}}">
											<i class="far fa-edit"></i> Edit
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
					@if (count($textsettings))
					{!! $textsettings->withQueryString()->links('pagination::bootstrap-5') !!}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('inline-js')
<script>
	jQuery('.validatedForm').validate();
</script>
@endsection