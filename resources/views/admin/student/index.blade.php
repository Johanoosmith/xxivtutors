@extends('layouts.admin')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-10">
							<h4>Students Management</h4>
						</div>
						<div class="col-md-2">
							<a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-sm custom_btn float-right"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New</a>
						</div>
					</div>
				</div>

                <div class="card-body table-border-style mb-2">
				    <!-- Filter Form -->
                    <form action="{{ route('admin.student.index') }}" method="GET" id="filter-form">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Search by Full Name & Email" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-3">
                                <!-- Add the Status Filter -->
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        
                            <div class="col-md-3 fiter-btn-pd">
                                <button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                    </svg>
                                </button>
                                <a href="{{ route('admin.student.index') }}" class="btn btn-dark btn-sm reset-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <polyline points="23 20 23 14 17 14"></polyline>
                                    <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                                </svg>
                                </a>
                            </div>
                            <div class="col-md-2 text-right">
                                <!-- Records Per Page Dropdown -->
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

                <div class="table-responsive">
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
        <tbody class="list" id="pages">
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->fullname }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->contact}}</td>
					<td>{{ $student->course}}</td>
                    <td>
                    @if($student->status == 'active')
                        <label class="badge bg-light-success">{{ ucfirst($student->status) }}</label>  <!-- Green badge for active status -->
                    @elseif($student->status == 'inactive')
                        <label class="badge bg-light-warning">{{ ucfirst($student->status) }}</label>  <!-- Red badge for inactive status -->
                    @else
                        <label class="badge bg-light-warning">{{ ucfirst($student->status) }}</label>  <!-- Yellow badge for any other status -->
                    @endif
					</td>
                    <td class="noselect text-right">	
                    <div class="action-tools">
						<a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title="" data-original-title="Edit">
							<i class="far fa-edit"> Edit</i>
						</a>	
                        <a href="{{ Route('admin.delete-student', $student->id ) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i> Delete
                        </a> 								
								
					</div>
                       					
					</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
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