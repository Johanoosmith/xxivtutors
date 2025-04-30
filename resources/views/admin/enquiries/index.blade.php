@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4>Enquiries</h4>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style mb-2">
                <!-- Filter Form -->
                <form action="{{ route('admin.enquiries.index') }}" method="GET" id="filter-form">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by sender or receiver name">

                        </div>
                        <div class="col-md-3 fiter-btn-pd">
                            <button type="submit" class="btn btn-sm custom_btn btn-primary filter-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                </svg>
                            </button>
                            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-dark btn-sm reset-btn">
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
                    @if($enquiries->isEmpty())
                    <p>No Enquiry Found.</p>
                    @else
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>S. No.</th>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Information</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enquiries as $index => $enquiry)
                            <tr>
                                <td>{{ $enquiries->firstItem() + $index }}</td>
                                <td>{{ $enquiry->sender->fullname ?? 'N/A' }}</td>
                                <td>{{ $enquiry->receiver->fullname ?? 'N/A' }}</td>
                                <td style="max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    @if($enquiry->status == 1)
                                    <span class="badge bg-primary">Running</span>
                                    @if($enquiry->subject_tutor) on subject {{ $enquiry->subject_tutor->subject->title ?? "-"}}
                                    @endif
                                    @elseif($enquiry->status == 2 && $enquiry->subject_tutor && $enquiry->action_by_user)
                                    <span class="badge bg-warning p-1">Reported by</span> <a href="{{ getUserProfileLink($enquiry->action_by_user->id ?? null) }}" target="_blank">{{ $enquiry->action_by_user->fullname ?? 'User' }} </a> on  subject{{ $enquiry->subject_tutor->subject->title ?? "-"}}
                                    @elseif($enquiry->status == 3 && $enquiry->action_by_user)
                                    <span class="badge bg-danger"> Closed by </span><a href="{{ getUserProfileLink($enquiry->action_by_user->id ?? null) }}" target="_blank">{{ $enquiry->action_by_user->fullname ?? 'User' }}</a>
                                    @else
                                    {{"--"}}
                                    @endif
                                </td>
                                <td>{{ $enquiry->created_at->format('d-m-Y H:i') ?? ''}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No enquiries found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (count($enquiries))
                    {!! $enquiries->withQueryString()->links('pagination::bootstrap-5') !!}
                    @endif


                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection