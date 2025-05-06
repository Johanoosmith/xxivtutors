@extends('layouts.admin')
@section('content')
    <div class="container">
        <h4>Payments List</h4>

        <form method="GET" action="{{ route('admin.payments.index') }}" class="mb-4 mt-3">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control" />
                </div>
                <div class="col-md-3">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control" />
                </div>
                <div class="col-md-2 mt-4">
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by name">

                </div>
                <div class="col-md-2 fiter-btn-pd mt-4">
                    <button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-filter">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                    </button>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-dark btn-sm reset-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-refresh-ccw">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                    </a>
                </div>
                <div class="col-md-2 text-right" style="max-width:100px;">
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Tutor</th>
                    <th>Start Date</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Transaction ID</th>
                    <th>Application Fee</th>
                    <th>Tutor Amount</th>
                    <th>Final Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->student->fullname ?? '' }}</td>
                        <td>{{ $payment->tutor->fullname ?? '' }}</td>
                        <td>{{ optional($payment->booking)->start_date ? \Carbon\Carbon::parse($payment->booking->start_date)->format('d-m-Y') : '' }}
                        </td>
                        <td>{{ strtoupper($payment->currency ?? '') }}</td>
                        <td>
                            @if ($payment->status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @elseif ($payment->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($payment->status ?? 'N/A') }}</span>
                            @endif
                        </td>
                        <td>{{ $payment->payment_intent_id ?? '' }}</td>
                        <td>£{{ $payment->application_fee ?? '' }}</td>
                        <td>£{{ $payment->tutor_amount ?? '' }}</td>
                        <td>£{{ $payment->charge_amount ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if (count($payments))
            {!! $payments->withQueryString()->links('pagination::bootstrap-5') !!}
        @endif

    </div>
@endsection
