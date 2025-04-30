@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4>Contracts</h4>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style mb-2">
                <!-- Filter Form -->
                <form action="{{ route('admin.contracts.index') }}" method="GET" id="filter-form">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by tutor or student name">

                        </div>

                        <div class="col-md-3 fiter-btn-pd">
                            <button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                </svg>
                            </button>
                            <a href="{{ route('admin.contracts.index') }}" class="btn btn-dark btn-sm reset-btn">
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
                    @if($contracts->isEmpty())
                    <p>No Contract Found.</p>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tutor</th>
                                <th>Student</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contracts as $index => $contract)
                            <tr>
                                <td>{{ ($contracts->currentPage() - 1) * $contracts->perPage() + $index + 1 }}</td>
                                <td>{{ $contract->tutor->fullname ?? 'N/A' }}</td>
                                <td>{{ $contract->student->fullname ?? 'N/A' }}</td>
                                <td>
                                    @if ($contract->status == 'signed')
                                    <span class="text-primary">Signed</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $contract->created_at ? \Carbon\Carbon::parse($contract->created_at)->format('d-m-Y h:i') : '' }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.contracts.show', $contract) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye bg-secondary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($contracts))
                    {!! $contracts->withQueryString()->links('pagination::bootstrap-5') !!}
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection