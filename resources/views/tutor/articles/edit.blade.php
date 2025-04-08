@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Article Content</h2>
                    <p>Here you can use this page to share resources or articles on your profile with other users.
                         You can use our editor to format your article content. This resource can managed from within the members homepage.</p>
                         <form action="{{ route('tutor.articles.update', $article->id) }}" method="POST">
                            @csrf
                            @include('elements.alert_message')
                            <div class="row">
                                <div class="col-md-6 form-field">
                                    <label class="form-label">Article Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" required>
                                </div>

                                <div class="col-md-6 form-field">
                                    <label class="form-label">Article Description</label>
                                    <input type="text" class="form-control" name="description" value="{{ old('description', $article->description) }}">
                                </div>
                                <div class="col-md-6 form-field">
                                    <label class="form-label">Article Content</label>
                                    <textarea name="content" class="form-control editor" required>{{ old('content', $article->content) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Update Article</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</section>
@endsection
