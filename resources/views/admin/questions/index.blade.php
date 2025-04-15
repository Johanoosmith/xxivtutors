@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Questions List</h4>
            </div>

            <div class="card-body table-border-style mb-2">
                <!-- Filter Form -->
                <form action="{{ route('admin.questions.index') }}" method="GET" id="filter-form">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" name="user" class="form-control" value="{{ request('user') }}" placeholder="Search by User Name">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" value="{{ request('title') }}" placeholder="Search by Title">
                        </div>
                        <div class="col-md-2 fiter-btn-pd">
                            <button type="submit" class="btn btn-sm btn-primary filter-btn">Filter</button>
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-dark btn-sm reset-btn">Reset</a>
                        </div>
                        <div class="col-md-2 text-right">
                            <span class="col-form-label">Per Page: </span>
                            <select name="per_page" class="form-control perpage_select" onchange="document.getElementById('filter-form').submit();">
                                <option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request()->per_page == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request()->per_page == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    @if ($questions->isEmpty())
                        <p>No questions found.</p>
                    @else
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Course</th>
                                    <th>Subject</th>
                                    <th>Title</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $index => $question)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question->user->fullname }}</td>
                                        <td>{{ $question->course->title ?? 'N/A' }}</td>
                                        <td>{{ $question->subject->title ?? 'N/A' }}</td>
                                        <td>{{ $question->title }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>
                                            @if ($question->status === 'approved')
                                                <span class="badge bg-light-success">Accepted</span>
                                            @elseif ($question->status === 'pending')
                                                <span class="badge bg-light-warning">Pending</span>
                                                <div class="mt-1">
                                                    <button class="btn btn-success btn-sm approve-btn" data-id="{{ $question->id }}" title="Accept">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $question->id }}" title="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @elseif ($question->status === 'reject')
                                                <span class="badge bg-light-danger">Rejected</span>
                                                <br>
                                                <button type="button" class="btn btn-sm btn-link text-danger p-0 mt-1 view-reason-btn"
                                                    data-reason="{{ $question->reject_reason }}" title="View Full Reason">
                                                    View
                                                </button>
                                            @endif
                                        </td>
                                        <td>{{ $question->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($questions))
                            {!! $questions->withQueryString()->links('pagination::bootstrap-5') !!}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Reason Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="reject-form">
                @csrf
                <input type="hidden" name="question_id" id="reject-question-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reject-reason">Reason for rejection</label>
                            <textarea name="reject_reason" id="reject-reason" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Reject</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- View Reject Reason Modal -->
    <div class="modal fade" id="viewReasonModal" tabindex="-1" aria-labelledby="viewReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rejection Reason</h5>
                    <button type="button" class="btn-close dismissclose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="full-reject-reason" class="text-dark"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary dismissclose" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('inline-js')
<script>
    $(document).ready(function() {
        // Approve question
        $('.approve-btn').on('click', function() {
            const questionId = $(this).data('id');
            $.ajax({
                url: '{{ route('admin.questions.accept') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: questionId
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        });

        // Reject button - open modal
        $('.reject-btn').on('click', function() {
            const questionId = $(this).data('id');
            $('#reject-question-id').val(questionId);
            $('#rejectModal').modal('show');
        });

        // Submit reject form
        $('#reject-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.questions.reject') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#rejectModal').modal('hide');
                        location.reload();
                    }
                }
            });
        });

        // View full reject reason
        $('.view-reason-btn').on('click', function() {
            const reason = $(this).data('reason');
            $('#full-reject-reason').text(reason);
            $('#viewReasonModal').modal('show');
        });

        $('.dismissclose').on('click', function() {
            $('#viewReasonModal').modal('hide');
        });
    });
</script>
@endsection
