@extends('layouts.admin')
@section('title') Manage Media @endsection
@section('inline-css')
@endsection
@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="heading-sec mt-3">			
			<h6 class="m-0 font-weight-bold text-primary">All Media Images</h6>
		</div> 
		<!--
		<div class="add-btn-sec mt-3">
				<a href="{{Route('admin.media.create')}}" class="btn btn-info btn-sm custom_btn position_right">Add New</a>
		</div> 
		-->	
	</div> 
	<div class="card-body">
		{!! Form::model($search, ['route' => ['admin.media.index'],'class' => '','id' => 'filter-form','method' => 'get',]) !!}
			<div class="row">
				<div class="col-md-4 mb-3">
					{!! Form::text('search_text', $search_text, ['class' => 'form-control', 'placeholder' => 'Search by title']) !!}
				</div>
				<div class="col-md-2 mb-3">
					@php $status = Config::get('constants.SEARCH_STATUS'); @endphp
					{!! Form::select('status', $status, null, ['class' => 'form-control','id' => 'status', ]) !!}				
				</div>
				<div class="col-md-3 fiter-btn-pd mb-3">
					<button type="submit" class="btn btn-info btn-sm custom_btn">Filter</button>
					<a href="{{ route('admin.media.index') }}" class="btn btn-success btn-sm custom_btn">Reset</a>
				</div>
				<div class="col-md-3 mb-3 text-right">
					<span class="col-form-label">Per Page: </span>
					@php $showrecord = Config::get('constants.SHOW_RECORD'); @endphp
					{!! Form::select('showrecord', $showrecord, null, ['class' => 'form-control perpage_select', 'onchange' => 'this.form.submit()', 'id' => 'showrecord', ]) !!}
				</div>
			</div>
		{!! Form::close() !!}  

    	<div class="table-responsive">					 
			  <table class="table table-bordered" cellspacing="0">
				<thead>
				  <tr>
					<th>#</th>
					<th>Added By</th>
					<th width="400">Title</th>	
					<th>Image</th>
					<th>Size</th>
					<th>Type</th>
					<th>Status</th>
					<th>Created</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody class="list" id="clients">
				  @if(count($upload_files))
				 	@php
						$i = 0;
					@endphp
					  @foreach($upload_files as $media)
						  <tr>
							<td>{{ ++$i }}</td>
							<td>{{ $media->user->firstname }} {{ $media->user->lastname }}</td>  
							<td>{{ $media->title }}</td>     
							<td>
								@if( isset($media->image_path) && file_exists(public_path($media->image_path))) 
								<img src="{{url($media->image_path)}}" width="60px"> 
								@endif
							</td>
							<td>{{ round($media->image_size) }} KB</td>  
							<td>{{ strtoupper($media->image_type) }}</td>  
							<td>
								@if($media->status== 1)
									<span  class="text-success">Active</span>
								@else
									<span  class="text-warning">Deactive</span>
								@endif
							</td>	
							<td>
							  {{date('D, M d, Y',strtotime($media->created_at))}}
							</td>
							<td class="noselect">
							  <div class="action-tools">
								<a href="{{ url('/admin/media/'.$media->id.'/edit') }}" class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title="" data-original-title="{{trans('admin.EDIT')}}">
								  <i class="far fa-edit"></i> Edit
								</a> 
								&nbsp;
								<!--
									<a href="{{ url('/admin/media/'.$media->id.'/delete') }}" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="" data-original-title="{{trans('admin.EDIT')}}">
									  <i class="far fa-delete"></i> Delete
									</a> 								
								-->
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
			  {!! $upload_files->withQueryString()->links('pagination::bootstrap-5') !!}
			</div>			
		</div>
	</div>
  <!-- /.content -->
@endsection
@section('inline-js')
<script>
  jQuery('.validatedForm').validate();
  function confirmation(e) {
        e.preventDefault();
        var url = e.currentTarget.getAttribute('href');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            text: 'If you delete this, it will be removed forever.',
            showCancelButton: true,
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#a8dab5',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel please!",
            dangerMode: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    }
</script>
@endsection