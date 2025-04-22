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
                <h5>View References Details</h5>
            </div>
            <div class="card-body">
                @foreach($references as $reference)
                    <form action="{{ route('admin.verification.update_reference', $reference->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-5">
                            <div class="col-lg-3">
                                <strong>First Name:</strong> {{ $reference->first_name }}
                            </div>
                            <div class="col-lg-3">
                                <strong>Last Name:</strong> {{ $reference->last_name }}
                            </div>
                            <div class="col-lg-3">
                                <strong>Email :</strong> {{ $reference->email }}
                            </div>
                            <div class="col-lg-3">
                                <strong>Mobile:</strong> {{ $reference->mobile }}
                            </div>
                            <div class="col-lg-3">
                                <strong>Profession:</strong> {{ $reference->profession }}
                            </div>
                            <div class="col-lg-3">
                                <strong>Status :</strong> {{ ucfirst($reference->status) }}
                            </div>
                        </div>
                            @if($reference->status == 'pending')
                                
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <select class="form-control" id="status_{{ $reference->id }}" name="status">
                                                <option value="1" {{ $reference->status == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ $reference->status == 2 ? 'selected' : '' }}>Pending</option>
                                                <option value="3" {{ $reference->status == 3 ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <textarea name="reason" class="form-control mt-2" id="comment_{{ $reference->id }}" placeholder="Comment">{{ $reference->reject_reason }}</textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="submit" class="btn btn-primary mt-2" id="update_status_{{ $reference->id }}" value="Update Status">
                                        </div>
                                    </div>
                                
                            @endif
                        
                    </form>

                @endforeach

            </div>
        </div>
    </div>
@endsection

