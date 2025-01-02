@extends('layouts.admin')
@section('title') Add User @endsection
@section('inline-css')
@endsection
@section('content')
  
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create User</h5>
            </div>
            <div class="card-body">
                    {{ html()->form('POST', route('admin.users.store'))->class('validatedForm')->id('user_form')->open() }}
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="dQwejnSpg2VaoDVLF5OVj2YGs8Onf3zGkScXP8d5">
                    <input type="hidden" name="_token" value="dQwejnSpg2VaoDVLF5OVj2YGs8Onf3zGkScXP8d5" autocomplete="off">
                    <input type="hidden" name="template" id="template" value="cms">
        <div class="form-group row">
            <div class="col-sm-4">
                    <label class="form-label">First Name <span class="required" aria-required="true">*</span></label> 
                    {{ html()->text('firstname')->class('form-control form-control-user required') }}
                                    @if ($errors->has('firstname'))
                                    <span class="error" role="alert">{{ $errors->first('firstname') }}</span>
                                    @endif
            </div>
            <div class="col-sm-4">
                        <label class="form-label">Last Name <span class="required" aria-required="true">*</span></label>    
                        {{ html()->text('lastname')->class('form-control form-control-user required') }}				
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="form-label">Username / Email <span class="required" aria-required="true">*</span></label>    
                {{ html()->text('email')->class('form-control form-control-user required') }}
                                @if ($errors->has('email'))
                                    <span class="error" role="alert">{{ $errors->first('email') }}</span>
                                @endif					
            </div>
            <div class="col-sm-4">
                <label class="form-label">Password <span class="required" aria-required="true">*</span></label>    
                                    {{ html()->text('password')->class('form-control form-control-user required') }}
                                    @if ($errors->has('password'))
                                    <span class="error" role="alert">{{ $errors->first('password') }}</span>
                                    @endif           
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
            @php
            $role_options = [
            '1' => 'student',
            '2' => 'tutor',
            ];
            @endphp
            <label class="form-label">Role <span class="required">*</span></label>
            {{ html()->select('role_id', $role_options)->class('form-control required')->id('role')  }}						
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
            <a href="{{route('admin.users.index')}}" class="btn btn-dark btn-md">Back</a>&nbsp;
                <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
            </div>
        </div>
        {{ html()->form()->close() }}
            </div>
        </div>
                
                </div>


@endsection
@section('inline-js')
@include('includes.admin.summernote') 
<script>
    jQuery('.validatedForm').validate();
</script> 
@endsection
