@extends('layouts.admin')
@section('content')
<div class="container">
    <h4>Contract Details</h4>

    <div class="card mt-3">
        <div class="row mt-2">
            <div class="col-md-2">
                <h5>Tutor Name:</h5>
            </div>
            <div class="col-md-4">
                {{ $contract->tutor->fullname ?? 'N/A' }}
            </div>
            <div class="col-md-2">
            <h5>Student Name:</h5>
            </div>
            <div class="col-md-4">
                {{ $contract->student->fullname ?? 'N/A' }}
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-2">
                <h5>Signed Date:</h5>
            </div>
            <div class="col-md-4">
            {{ $contract->signed_date ? \Carbon\Carbon::parse($contract->signed_date)->format('d-m-Y h:i') : '' }}

            </div>

            <div class="col-md-2">
                <h5>IP Address:</h5>
            </div>
            <div class="col-md-4">
{{ $contract->ip_address ?? '' }}
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-2">
                <h5>Status:</h5>
            </div>
            <div class="col-md-4">
          {{ $contract->status ?? '' }}
            </div>
            
            <div class="col-md-2">
                <h5>Signature:</h5>
            </div>
                @if ($contract->signature)
                <div class="col-md-4">
                <img src="{{ asset('uploads/signatures/' . $contract->signature) }}" style="max-width: 200px;">
                @else
                <p>No signature available.</p>
                @endif
            </div>
        </div>

        @for ($i = 1; $i <= 6; $i++)
            <div class="mb-3 mt-3">
            <h5>Contract Declaration {{ $i }}</h5>
            <p class="mt-1">{{ $contract['cd_' . $i] ?? "---" }}</p>
</div>
@endfor

</div>
</div>
@endsection