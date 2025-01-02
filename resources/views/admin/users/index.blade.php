@extends('layouts.admin')
@section('title') Manage Users @endsection
@section('inline-css')
@endsection
@section('content')
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-10">
							<h4>All Users</h4>
						</div>
						<div class="col-md-2">
							<a href="{{Route('admin.users.create')}}" class="btn btn-primary btn-sm custom_btn float-right"><i class="fa fa-plus" aria-hidden="true"></i>
								Add New</a>
						</div>
					</div>
				</div>

	<div class="card-body">
		
		{{ html()->modelForm($search,'get',route('admin.users.index'))->class('')->id('filter-form')->open() }}
				
		<div class="row">
				<div class="col-md-4 mb-3">
					{{ html()->text('search_text')->class('form-control')->placeholder('Search by name / email') }}
				</div>

				<div class="col-md-2 mb-3">
				@php $status = Config::get('constants.SEARCH_STATUS'); @endphp
				{{ html()->select('status', $status)->class('form-control')->id('status')  }}
				</div>				
				<div class="col-md-3 fiter-btn-pd mb-3">
					<button type="submit" class="btn btn-sm custom_btn btn-info">Filter</button>
					<a href="{{ route('admin.users.index') }}" class="btn btn-success btn-sm custom_btn">Reset</a>
				</div>
				<div class="col-md-3 mb-3 text-right">
					<span class="col-form-label">Per Page: </span>
					@php $showrecord = Config::get('constants.SHOW_RECORD'); @endphp
							{{ html()->select('showrecord', $showrecord)->class('form-control perpage_select')->id('showrecord')  }}
				</div>
			</div>
			{{ html()->form()->close() }}

    	<div class="table-responsive">	
			  <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
				<thead>
				  <tr>
					<th>#</th>
					<th>Full Name</th>					
					<th>Email</th>	
					<th>Phone</th>						
					<th>Status</th>
					<th>Created</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody class="list" id="clients">
				  @if(count($users))
					@php
					$i = ($users->currentPage() - 1) * $users->perPage();
					@endphp
					  @foreach($users as $user)
						  <tr>
							<td>{{ ++$i }}</td>                
							<td>{{ $user->firstname }} {{ $user->lastname }}</td>	
							<td>{{ $user->email }}</td>
							<td>{{ $user->mobile }}</td>
							
							<td>
								@if($user->status== 1)
									<span  class="text-success">Active</span>
								@else
									<span  class="text-warning">Deactive</span>
								@endif
							</td>	
							<td>
							  {{date('D, M d, Y h:i',strtotime($user->created_at))}}
							</td>	
							<td class="noselect">
								<div class="action-tools">
									<a href="{{ url('/admin/users/'.$user->id.'/edit') }}"
									class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title=""
									data-original-title="{{trans('admin.EDIT')}}">
									<i class="far fa-edit"></i> Edit
									</a> 
									&nbsp;&nbsp;
									<a href="{{ Route('admin.delete-user', $user->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
										<i class="fa fa-trash"></i> Delete
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
			  @if (count($users))
					{!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
				@endif	
			</div>			 
	</div>
</div>	
</div>			 
	</div>
</div>
@endsection
@section('inline-js')
<script>
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