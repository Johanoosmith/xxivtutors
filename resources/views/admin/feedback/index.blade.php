@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Feedback List</h4>
                </div>

                <div class="card-body table-border-style mb-2">
                    <form action="{{ route('admin.feedback.index') }}" method="GET" id="filter-form">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" name="student" class="form-control" value="{{ request('student') }}"
                                    placeholder="Search by Student Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="tutor" class="form-control" value="{{ request('tutor') }}"
                                    placeholder="Search by Tutor Name">
                            </div>
                            <div class="col-md-2 fiter-btn-pd">
                                <button type="submit" class="btn btn-sm btn-primary filter-btn">Filter</button>
                                <a href="{{ route('admin.feedback.index') }}"
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
                        @if ($feedbacks->isEmpty())
                            <p>No feedbacks found.</p>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Tutor Name</th>
                                        <th>Content</th>
                                        <th>Tutor Rating</th>
                                        <th>Site Rating</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $index => $f)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $f->student->fullname ?? '-' }}</td>
                                            <td>{{ $f->tutor->fullname ?? '-' }}</td>
                                            <td>{{ $f->content ?? '-' }}</td>
                                            <td>{{ $f->tutor_rating ?? '-' }}</td>
                                            <td>{{ $f->site_rating ?? '-' }}</td>
                                            <td>
                                                @if ($f->status == 'pending')
                                                    <span class="badge bg-light-warning">Pending</span>
                                                    <div class="mt-1">
                                                        <button class="btn btn-success btn-sm approve-btn"
                                                            data-id="{{ $f->id }}" title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm reject-btn"
                                                            data-id="{{ $f->id }}" title="Reject">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @elseif ($f->status == 'approved')
                                                    <span class="badge bg-light-success">Approved</span>
                                                @elseif ($f->status == 'unapproved')
                                                    <span class="badge bg-light-danger">Rejected</span>
                                                    <br>
                                                    <button type="button"
                                                        class="btn btn-sm btn-link text-danger p-0 mt-1 view-reason-btn"
                                                        data-reason="{{ $f->reject_reason }}" title="View Full Reason">
                                                        View
                                                    </button>
                                                @endif
                                            </td>


                                            <td>{{ $f->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($feedbacks))
                                {!! $feedbacks->withQueryString()->links('pagination::bootstrap-5') !!}
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Reject Reason Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Provide Reject Reason</h5>
                    <button type="button" class="btn-close dismissfeedreason" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="rejectReason" class="form-control" rows="4" placeholder="Enter rejection reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary dismissfeedreason" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="submitRejectReason">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- View Reject Reason Modal -->
    <div class="modal fade" id="viewReasonModal" tabindex="-1" aria-labelledby="viewReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title dismissfeed" id="viewReasonModalLabel">Reject Reason</h5>
                    <button type="button" class="btn-close dismissfeed" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="rejectReasonText"></p> <!-- This is where we will show the reject reason -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary dismissfeed" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('inline-js')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.view-reason-btn', function() {
                var rejectReason = $(this).data('reason'); 

                $('#rejectReasonText').text(rejectReason);

                $('#viewReasonModal').modal('show');
            });
            $(document).on('click', '.dismissfeed', function() {
                $('#viewReasonModal').modal('hide');
            });
            $(document).on('click', '.dismissfeedreason', function() {
                $('#rejectModal').modal('hide');
            });


            $(document).on('click', '.approve-btn', function() {
                var articleId = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.feedback.approve') }}", 
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: articleId
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload(); 
                        } else {
                            alert('Something went wrong');
                        }
                    },
                    error: function() {
                        alert('Error while approving feedback');
                    }
                });
            });

            // Reject Button click handler
            $(document).on('click', '.reject-btn', function() {
                var feedbackId = $(this).data('id');
                $('#rejectModal').data('feedbackId', feedbackId).modal('show');
            });

            // Submit reject reason
            $('#submitRejectReason').click(function() {
                var rejectReason = $('#rejectReason').val();
                var feedbackId = $('#rejectModal').data('feedbackId');

                if (!rejectReason.trim()) {
                    alert('Please enter a reason');
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.feedback.reject') }}", // Route to handle rejection
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: feedbackId,
                        reject_reason: rejectReason
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Reload the page to reflect the change
                        } else {
                            alert('Something went wrong');
                        }
                    },
                    error: function() {
                        alert('Error while rejecting feedback');
                    }
                });

                $('#rejectModal').modal('hide');
            });
        });
    </script>
@endsection
