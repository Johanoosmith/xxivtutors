@extends('layouts.admin')
@section('title') View Email Log @endsection
@section('inline-css')
@endsection
@section('content')
<!-- Page Heading -->

<div class="col-md-12">
        <div class="card">
                <div class="card-header">
                        <h5>View Email Log Detail</h5>
                </div>
                <div class="card-body">
                        <div class="row">
                                <div class="col-lg-8">
                                        <div class="row">
                                                <div class="col-sm-2">
                                                        <label class="form-label">To:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        <p>{{ $emailLog->to_email }}</p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-2">
                                                        <label class="form-label">From:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        <p> {{$emailLog->from_email}}</p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-2">
                                                        <label class="form-label">Subject:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        <p> {{$emailLog->subject}}</p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-2">
                                                        <label class="form-label">Message:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        {!! $emailLog->message !!}
                                                </div>
                                        </div>
                                        <div class="row mt-3">
                                                <div class="col-sm-2">
                                                        <label class="form-label">Created:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                        <p>{{date('D, M d, Y h:i:s a',strtotime($emailLog->created_at))}}</p>
                                                </div>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-4">
                                                <a href="{{route('admin.emaillogs.index')}}" class="btn btn-dark btn-md">Back</a>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
</div>
@endsection