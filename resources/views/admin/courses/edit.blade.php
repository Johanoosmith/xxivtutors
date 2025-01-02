@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h5>Edit Course</h5>
		</div>
       <div class="card-body">
       <form class="validatedForm" action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Title Field -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                    <input class="form-control form-control-user required" type="text" name="title" id="title" value="{{ $course->title }}" required>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="status">Level <span class="required" aria-required="true">*</span></label>
                    <select name="level" class="form-control form-control-user required">
                        <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="expert" {{ $course->level == 'expert' ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>
                <div class="form-group row">
                            @if(!empty($cities)) 
                                @foreach($cities as $val)   
                                        @php 									
                                            $checked = '';
                                         
                                        @endphp
                                        @if(!empty($course->cities))			
                                          
                                            @if (in_array($val->id, $course->cities))
                                                @php 								
                                                    $checked = 'checked';
                                                @endphp
                                            @endif
                                        @endif	
                                        <div class="col-sm-4">					
                                            <label class="checkbox">		
                                                <input type="checkbox" class="cities" name="cities[]" value="{{$val->id}}" {{$checked}} /> {{$val->name}}
                                            </label>
                                        </div>
                                @endforeach
                            @endif

                    </div>
            </div>
            <!-- Buttons: Back and Submit -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                    <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Update Course</button>      
                </div>
            </div>
        </form>
       </div>
    </div>
</div>

@endsection

