@extends('layouts.admin')
@section('title') General Settings @endsection
@section('inline-css')
@endsection
@section('content')
<div class="pcoded-content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Contract</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contract.store') }}" method="POST" class="validatedForm" novalidate="novalidate">
                    @csrf
                    @for ($i = 1; $i <= 5; $i++)
                        @php
                        $key="contract_declaration_$i" ;
                        @endphp
                        <div class="form-group row mt-3">
                        <div class="col-sm-12">
                            <label class="form-label">Contract Declaration {{ $i }} <span class="required text-danger">*</span></label>
                            <textarea name="{{ $key }}" class="form-control summernote" required>{{ old("contract$key", $settings[$key] ?? '') }}</textarea>
                         
                        </div>
            </div>
            @endfor

            <button type="submit" class="btn btn-primary mb-3">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('inline-js')
@include('includes.admin.summernote')
@endsection