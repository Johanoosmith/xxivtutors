@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Qualification List</h4>
            </div>

            <div class="card-body table-border-style mb-2">
                <!-- Filter Form -->


                <!-- Table -->
                <div class="table-responsive">

                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Qualification</th>
                                <th>Institute</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($qualifications->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center bg-secondary">
                                    <h5>No qualifications found</h5>
                                </td>
                            </tr>
                            @else
                            @foreach($qualifications as $index => $qualification)
                            <tr>
                                <td>{{ $qualifications->firstItem() + $index }}</td>
                                <td>{{ $qualification->user->full_name }}</td>
                                <td>{{ $qualification->qualification->qualification }}</td>
                                <td>{{ $qualification->institute_name }}</td>
                                <td>{{ $qualification->subject }}</td>
                                <td>
                                    @if ($qualification->status == 1)
                                    <span class="badge bg-success">Approved</span>
                                    @elseif ($qualification->status == 3)
                                    <span class="badge bg-danger">Rejected</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($qualification->status == 1)
                                    <form method="POST" action="{{ route('admin.tutors.qualifications.approve', $qualification->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $qualification->id }}">
                                        Reject
                                    </button>
                                    @elseif ($qualification->status == 3)
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#viewReasonModal{{ $qualification->id }}">
                                        View Reason
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $qualifications->links() }}
                </div>

                <!-- Modals (placed outside the table loop) -->
                @foreach($qualifications as $qualification)
                @if ($qualification->status == 1)
                <!-- Reject Modal -->
                <div class="modal fade" id="rejectModal{{ $qualification->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.tutors.qualifications.reject', $qualification->id) }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reject Qualification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Reason for Rejection</label>
                                    <textarea name="reason" class="form-control" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @elseif ($qualification->status == 3)
                <!-- View Reason Modal -->
                <div class="modal fade" id="viewReasonModal{{ $qualification->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rejected Reason</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea class="form-control" rows=6 readonly>{{ $qualification->reason }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach


                <!-- Pagination -->
                {{ $qualifications->links() }}


                <!-- Pagination -->

            </div>
        </div>
    </div>



</div>
@endsection
<!-- In your main layout, usually in footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@section('inline-js')

@endsection