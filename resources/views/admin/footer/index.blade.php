@extends('layouts.admin')
@section('title') General Settings @endsection
@section('inline-css')
@endsection
@section('content')
<div class="pcoded-content">              
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Manage Footer</h5>
                </div>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
            <form action="{{ route('admin.footer.store') }}" method="POST" class="validatedForm" novalidate="novalidate">
                @csrf
                
                <div class="form-group row">
                <div class="col-sm-6">
                    <label for="" class="form-label">Footer Title<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="" id="" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                <div class="col-sm-6">
                    <label for="" class="form-label">Footer Content<span class="required" aria-required="true">*</span></label>
                    <textarea name="content" class="form-control">{{ $footer->content ?? '' }}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                <div class="col-sm-6">
                    <label for="" class="form-label">Copyright Text<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="copyright" class="form-control" value="{{ $footer->copyright ?? '' }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Footer</button>
            </form> 
            </div>

            </div>
    </div>
</div>
@endsection
