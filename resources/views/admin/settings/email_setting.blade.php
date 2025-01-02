@extends('layouts.admin')
@section('title') SMTP Settings @endsection
@section('inline-css')
@endsection
@section('content')

<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Update SMTP Settings</h5>
			</div>
			<div class="card-body">
				
            {{ html()->modelForm($emailSetting,'POST',route('admin.EmailSetting.index'))->class('validatedForm')->open() }}	{{ csrf_field() }}
			
            <div class="card-body p-0">		
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="form-label">Host <span class="required">*</span></label>  
                                                {{ html()->text('host')->class('form-control form-control-user required') }}
                                            </div>
                                   
                                        <div class="col-sm-4">
                                            <label class="form-label">Username <span class="required">*</span> </label>		
                                            {{ html()->text('username')->class('form-control form-control-user required') }}                                           
                                        </div>
                                      
                                        <div class="col-sm-4">
                                            <label class="form-label">Password <span class="required">*</span> </label>		
                                            {{ html()->text('password')->class('form-control form-control-user required') }}                                               
                                        </div>
                                        </div> 
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="form-label">Port <span class="required">*</span> </label>		
                                            {{ html()->text('port')->class('form-control form-control-user required') }}                                             
                                        </div>
                                   
                                        <div class="col-sm-4">
                                            <label class="form-label">Encryption(SSL/TLS Or Leave blank if NULL)</label>		
                                            {{ html()->text('encryption')->class('form-control form-control-user required') }}     
                                        </div>
                                   
                                        <div class="col-sm-4">
                                            <label class="form-label">Transport <span class="required">*</span> </label>		
                                            {{ html()->select('transport', ['smtp'=>'SMTP','mail'=>'Mail'])->class('form-control required')->id('status')  }}	
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="form-label">From Email <span class="required">*</span> </label>	
                                            {{ html()->text('from_email')->class('form-control form-control-user required') }}           
                                        </div>
                                       
                                        <div class="col-sm-4">
                                            <label class="form-label">From Name <span class="required">*</span> </label>	
                                            {{ html()->text('from_name')->class('form-control form-control-user required') }}    
                                        </div>
                                    </div>
                                    <h5>Admin Email Settings</h5>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="form-label">Recieved Notification Email <span class="required">*</span> </label>	                                           
                                            {{ html()->text('to_email')->class('form-control form-control-user required') }}         
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">                   
                                            <button type="submit" id="submit_form" class="btn btn-primary btn-user  btn-md">Submit</button> 
                                        </div>
                                    </div> 
                </div>

            {{ html()->form()->close() }}
		</div>
	</div>




		
<script>
    jQuery('.validatedForm').validate();
</script>
@endsection


