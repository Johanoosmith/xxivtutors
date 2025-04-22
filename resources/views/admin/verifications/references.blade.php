@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>References List</h4>
                </div>

                <div class="card-body table-border-style mb-2">
                    <form action="{{ route('admin.verification.references') }}" method="GET" id="filter-form">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" name="user" class="form-control" value="{{ request('user') }}"
                                    placeholder="Search by User Name">
                            </div>
                            
                            <div class="col-md-2 fiter-btn-pd">
                                <button type="submit" class="btn btn-sm btn-primary filter-btn">Filter</button>
                                <a href="{{ route('admin.verification.index') }}"
                                    class="btn btn-dark btn-sm reset-btn">Reset</a>
                            </div>
                            <div class="col-md-2 text-right">
                                <span class="col-form-label">Per Page: </span>
                                <select name="per_page" class="form-control perpage_select"
                                    onchange="document.getElementById('filter-form').submit();">
                                    <option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request()->per_page == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request()->per_page == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        @if ($references->isEmpty())
                            <p>No references found.</p>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>References</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
										$sNo = ($references->currentPage() - 1) * $references->perPage() + 1;  /* Increasing Serial Number */
									@endphp

                                    @foreach ($references as $index => $reference)
                                        
                                        <tr>
                                            <td>{{ $sNo++ }}</td>
                                            <td>
                                                <a href="{{ route('admin.tutors.edit', $reference->id) }}">
                                                    {{ $reference->full_name }}
                                                </a>
                                            </td>
                                           
                                            <td>{{ $reference->email }}</td>
                                            <td>{{ @$reference->references_count }}</td>
                                            <td>
                                                @php
                                                    $statusLabels = [1 => 'Approved', 2 => 'Pending', 3 => 'Rejected'];
                                                    $badgeClass = [1 => 'success', 2 => 'warning', 3 => 'danger'];
                                                @endphp
                                                <span class="badge bg-light-{{ $badgeClass[$reference->status] ?? 'secondary' }}">
                                                    {{ $statusLabels[$reference->status] ?? 'Unknown' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.verification.reference_view' , $reference->id) }}"
                                                class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title=""
                                                data-original-title="{{trans('admin.EDIT')}}">
                                                <i class="far fa-edit"></i> View
                                                </a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
							@if (count($references))
                            {!! $references->withQueryString()->links('pagination::bootstrap-5') !!}
                            @endif
                        @endif
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
@endsection
