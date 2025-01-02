@php
    $ = $id = '';
    if(array_key_exists('',$options)){
        $ = $options[''];     
    }
@endphp

<div class="form-group row">
    <div class="col-sm-6">
            <label class="form-label">Logo</label> 
            <input type="file" name="" class="form-control" accept="image/*">     
    </div>  
    @if(isset($options) && (isset($) && !empty($)))               
        @if(file_exists(public_path($)))
        <div class="col-sm-6 mt-2">
            <img src="{{$}}" width="100px">
            <a href="{{ route('admin.delete-settings-image', ['imagename' => '']) }}" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="">
                <i class="fa fa-remove  red-color">X</i>
            </a>
        </div>
        @endif
    @endif 
</div>


<div class="form-group row">
    <div class="col-sm-6">
            <label class="form-label">Copyright Text</label> 
            {{ html()->text('footer_copyright_text')->class('form-control form-control-user') }}            
    </div>   
</div>



