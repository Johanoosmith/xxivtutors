@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                        <h2 style="clear: both; ">My Articles  &nbsp;&nbsp;&nbsp;
                            <span style="font-size: 12px;">
                              <a class="btn btn-yellow btn-small" href="{{ route('tutor.articles.addqarticles') }}">Add an Article</a>
                            </span>
                        </h2>
                        <p>Many of our students discover tutors by reading through our articles library,
                             we recommend that tutors upload articles to improve their visibility on {{ config('constants.SITE.TITLE') }}. 
                             Please submit your academic articles here, they must be original, 
                             all articles will go through our approval process before being posted on {{ config('constants.SITE.TITLE') }}.</p>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Title</th>
                                    <th class="col-institute">Description</th>
                                    <th class="col-grade">Subject</th>
                                    <th class="col-status">Submit Date	</th>
                                    <th class="col-action">Live</th>
                                    <th class="col-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="col-qualification">{{ $article->title }}</td>
                                    <td class="col-institute">{{ $article->description }}</td>
                                    <td class="col-grade">{{ $article->subject->title ?? 'N/A' }}</td>
                                    <td class="col-status">{{ $article->created_at }}</td>
                                    <td class="col-status">
                                        <span class="infowarn">No</span>
                                    </td>
                                    <td class="col-action">
                                        <a href="{{ route('tutor.articles.edit', $article->id) }}" class="icon-btn">
                                            <svg class="icon">
                                                <use xlink:href="#view"></use>
                                            </svg>
                                        </a>
                                        
                                        <form action="{{ route('tutor.articles.destroy', $article->id) }}" method="POST" style="display:inline-block;" 
                                                                    onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="icon-btn">
                                            <svg class="icon">
                                                 <use xlink:href="#delete"></use>
                                                </svg>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
