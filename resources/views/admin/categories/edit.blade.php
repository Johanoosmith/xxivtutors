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
			<h5>Edit Category</h5>
		</div>
       <div class="card-body">
       <form class="validatedForm" action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Title Field -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Title <span class="required" aria-required="true">*</span></label> 
                    <input class="form-control form-control-user required" type="text" name="name" id="title" value="{{ old('title', $category->name) }}" required>
                </div>
            </div>
            <!-- Slug Field -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Slug <span class="required" aria-required="true">*</span></label>
                    <input class="form-control form-control-user" type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" required>
                </div>
            </div>
            <!-- Category Image Field -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="category_image">Category Image</label>
                    @if($category->category_image)
                        <img src="{{ asset($category->category_image) }}" alt="Category Image" style="width: 100px;">
                    @endif
                    <input type="file" name="category_image" class="form-control">
                </div>
            </div>
            <!-- Description Field -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description">{{ old('description', $category->description) }}</textarea>
                </div>
            </div>
            <!-- Status Field -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" {{ $category->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $category->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <!-- SEO Fields -->
            <h4>Manage SEO</h4>

            <!-- Meta Title -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Meta Title</label>
                    <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}">
                </div>
            </div>

            <!-- Meta Description -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="meta_description">{{ old('meta_description', $category->meta_description) }}</textarea>
                </div>
            </div>

            <!-- Buttons: Back and Submit -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-md">Back</a>&nbsp;
                    <button type="submit" id="submit_form" class="btn btn-success btn-user btn-md">Update Category</button>      
                </div>
            </div>
        </form>
       </div>
    </div>
</div>

@endsection
