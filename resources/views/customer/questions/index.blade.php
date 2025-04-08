@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                        <h2 style="clear: both; ">My Questions &nbsp;&nbsp;&nbsp;
                            <span style="font-size: 12px;">
                              <a class="btn btn-yellow btn-small" href="{{ route('student.questions.addmyquestion') }}">Ask an Academic Question</a>
                            </span>
                        </h2>
                        <p>We have thousands of tutors registered here at Tutor Hunt, 
                            our Questions portal allow students to pose any academic query they have directly to them. 
                            Once you submit a question we will publish it, and allow any of our wide range of tutors to answer it for you. 
                            You can also manage your previously asked questions here.</p>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">My Answer	</th>
                                    <th class="col-institute">Status</th>
                                    <th class="col-grade">Date</th>
                                    <th class="col-status">Subject</th>
                                    <th class="col-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($questions as $question)
                                <tr>
                                    <td class="col-qualification">{{ $question->title ?? 'N/A' }}</td>
                                    <td class="col-institute">
                                        @if($question->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($question->status == 'pending')
                                            <span class="badge bg-danger">Waiting Approval</span>
                                        @else
                                            <span class="badge bg-warning">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="col-grade">{{ optional($question->user->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                                    <td class="col-status">{{ $question->subject->title ?? 'N/A' }}</td>
                                    <td class="col-action">
                                    <form action="{{ route('student.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn" onclick="return confirm('Are you sure?');">
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


                                   