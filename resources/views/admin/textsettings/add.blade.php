@extends('layouts.admin')
@section('title') Add News @endsection
@section('inline-css')
@endsection
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Create News</h5>
			</div>
			<div class="card-body">
				
				{{ html()->form('POST', route('admin.textsettings.store'))->class('validatedForm')->id('news_form')->open() }}
					{{ csrf_field() }}
					

                    <div class="form-group row">
                        <div class="col-sm-5">
                                <label class="form-label">Text Category <span class="required">*</span></label> 
                                {{ html()->select('key_text', $textcatlist)->class('form-control required')->id('key_text')  }}			
                                @if ($errors->has('key_text'))
                                    <span class="error" role="alert">{{ $errors->first('key_text') }}</span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-5">
                                    <label class="form-label">Key <span class="required">*</span></label>    
                                    {{ html()->text('key_value')->class('form-control form-control-user required') }}					
                                    @if ($errors->has('key_value'))
                                        <span class="error" role="alert">{{ $errors->first('key_value') }}</span>
                                    @endif
                            </div>                            
                    </div>
                    @foreach($languagelist as $key => $lang)
                    <div class="form-group row">
                            <div class="col-sm-10">
                                    <label class="form-label">{{ $lang }} Value <span class="required">*</span></label>
                                        {{ html()->textarea('value[$key]')->class('form-control form-control-user short_desc required') }}	
                                        @if($errors->has("value.$key"))
                                            <span class="error">{{ $errors->first("value.$key")}}</span>
                                        @endif          
                                </div>
                    </div>
                    @endforeach
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <a href="{{route('admin.textsettings.index')}}"  class="btn btn-dark btn-md">Back</a>&nbsp;
                            <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Submit</button>      
                        </div>
                    </div>




				{{ html()->form()->close() }}
		</div>
	</div>



@endsection
@section('inline-js')
<script>
    jQuery('.validatedForm').validate();
</script> 
@endsection
