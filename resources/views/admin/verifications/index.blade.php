@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Verifications List</h4>
                </div>

                <div class="card-body table-border-style mb-2">
                    <form action="{{ route('admin.verification.index') }}" method="GET" id="filter-form">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" name="user" class="form-control" value="{{ request('user') }}"
                                    placeholder="Search by User Name">
                            </div>
                            <div class="col-md-4">
                                <select name="verification_type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="1" {{ request('verification_type') == '1' ? 'selected' : '' }}>
                                        Profile Image</option>
                                    <option value="2" {{ request('verification_type') == '2' ? 'selected' : '' }}>
                                        Identity ID</option>
                                    <option value="3" {{ request('verification_type') == '3' ? 'selected' : '' }}>DBS
                                    </option>
                                    <option value="4" {{ request('verification_type') == '4' ? 'selected' : '' }}>
                                        References</option>
                                </select>
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
                        @if ($verifications->isEmpty())
                            <p>No verifications found.</p>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Verification Type</th>
                                        <th>Document Type</th>
                                        <th>DBS Number</th>
                                        <th>Name on Document</th>
                                        <th>Other Name on Document</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($verifications as $index => $v)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $v->user->fullname ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $types = [
                                                        0 => 'Pending',
                                                        1 => 'Profile Image',
                                                        2 => 'Identity ID',
                                                        3 => 'DBS',
                                                        4 => 'References',
                                                    ];
                                                @endphp
                                                {{ $types[$v->verification_type] ?? 'N/A' }}
                                            </td>
                                            <td>{{ format_label($v->document_type) ?? '-' }}</td>
                                            <td>{{ $v->dbs_number ?? '-' }}</td>
                                            <td>{{ $v->firstname_on_doc }} {{ $v->lastname_on_doc }} </td>
                                            <td>{{ $v->othername_on_doc }} </td>
                                            <td>
                                                @php
                                                    $statusLabels = [1 => 'Approved', 2 => 'Pending', 3 => 'Rejected'];
                                                    $badgeClass = [1 => 'success', 2 => 'warning', 3 => 'danger'];
                                                @endphp
                                                <span class="badge bg-light-{{ $badgeClass[$v->status] ?? 'secondary' }}">
                                                    {{ $statusLabels[$v->status] ?? 'Unknown' }}
                                                </span>
                                            </td>
                                            <td>{{ $v->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</td>
                                            <td>
                                                	<a href="{{ route('admin.verification.show' , $v->id) }}"
                                                class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title=""
                                                data-original-title="{{trans('admin.EDIT')}}">
                                                <i class="far fa-edit"></i> View
                                                </a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
							@if (count($verifications))
                            {!! $verifications->withQueryString()->links('pagination::bootstrap-5') !!}
                            @endif
                        @endif
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
@endsection
