@extends('layouts.admin')
@section('title')
    View Verification
@endsection
@section('inline-css')
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>View Verification Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <!-- List of Verification Details -->
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>User Name:</strong> {{ $Verification->user->fullname }}
                            </li>
                            <li class="list-group-item">
                                <strong>Verification Type:</strong>
                                @if ($Verification->verification_type == '1')
                                    Profile Image
                                @elseif ($Verification->verification_type == '2')
                                    Identity ID
                                @elseif ($Verification->verification_type == '3')
                                    DBS
                                @elseif ($Verification->verification_type == '4')
                                    Reference
                                @else
                                    Pending
                                @endif
                            </li>
                            <li class="list-group-item">
                                <strong>Document Type:</strong> {{ $Verification->document_type }}
                            </li>
                            <li class="list-group-item">
                                <strong>DBS Number:</strong> {{ $Verification->dbs_number }}
                            </li>
                            <li class="list-group-item">
                                <strong>Name on Document:</strong> {{ $Verification->firstname_on_doc }}
                                {{ $Verification->lastname_on_doc }}
                            </li>
                            <li class="list-group-item">
                                <strong>Other Name on Document:</strong> {{ $Verification->othername_on_doc }}
                            </li>
                            @php
                                $statusLabels = [1 => 'Approved', 2 => 'Pending', 3 => 'Rejected'];
                                $badgeClass = [1 => 'success', 2 => 'warning', 3 => 'danger'];
                            @endphp

                            <li class="list-group-item">
                                <strong>Status:</strong>
                                @if ($Verification->status == 2)
                                    <form method="POST"
                                        action="{{ route('admin.verification.approve', $Verification->id) }}"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">✔️</button>
                                    </form>

                                    <!-- Trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">
                                        ❌
                                    </button>
                                @else
                                    <span class="badge bg-light-{{ $badgeClass[$Verification->status] ?? 'secondary' }}">
                                        {{ $statusLabels[$Verification->status] ?? 'Pending' }}
                                    </span>
                                @endif
                            </li>

                            @if (!empty($Verification->reject_reason))
                                <li class="list-group-item">
                                    <strong>Reject Reason:</strong> {{ $Verification->reject_reason }}
                                </li>
                            @endif
                            <li class="list-group-item">
                                <strong>Created At:</strong>
                                {{ $Verification->created_at->format(config('constants.SITE.DATE_FORMAT')) }}
                            </li>

                    </div>

                    @if ($Verification->verification_type == '1')
                        <div class="col-sm-4">
                            <div class="file-item">
                                <p><strong>Profile Image:</strong></p>
                                <img src="{{ asset('storage/' . $Verification->file) }}" alt="Profile Image"
                                    class="img-fluid" style="max-width: 200px;">
                            </div>
                        </div>
                    @endif

                    @if ($Verification->verification_type == '2')
                        <div class="col-sm-4">
                            <div class="file-item">
                                <p><strong>Identity ID:</strong></p>
                                <img src="{{ asset('storage/' . $Verification->file) }}" alt="Identity ID"
                                    class="img-fluid" style="max-width: 200px;">
                            </div>
                        </div>
                    @endif

                    @if ($Verification->verification_type == '3')
                        <div class="col-sm-4">
                            <div class="file-item">
                                <p><strong>DBS:</strong></p>
                                <img src="{{ asset('storage/' . $Verification->file) }}" alt="DBS" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        </div>
                    @endif

                    @if ($Verification->verification_type == '4')
                        <div class="col-sm-4">
                            <div class="file-item">
                                <p><strong>Reference:</strong></p>
                                <img src="{{ asset('storage/' . $Verification->file) }}" alt="Reference" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        </div>
                    @endif
                    </ul>

                    <!-- Display Documents Based on Verification Type -->


                </div>

                <!-- Back Button -->
                <div class="row pt-5">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.verification.index') }}" class="btn btn-dark btn-md">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reject Reason Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.verification.reject', $Verification->id) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Verification</h5>
                        <button type="button" class="btn-close closeviewdismiss" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reject_reason">Reason for Rejection</label>
                            <textarea name="reject_reason" id="reject_reason" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Submit Rejection</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('inline-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalTrigger = document.querySelector('[data-bs-target="#rejectModal"]');
            if (modalTrigger) {
                modalTrigger.addEventListener('click', function() {
                    const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
                    modal.show();
                });
            }
        });

        $('.closeviewdismiss').click(function() {
            const $modal = $('#rejectModal');
            $modal.removeAttr('style');
            $modal.removeAttr('role');
            $modal.removeAttr('aria-modal');
            $('.modal-backdrop').remove();
            $modal.removeClass('show');
            $modal.css('display', 'none');
        });
    </script>
@endsection
