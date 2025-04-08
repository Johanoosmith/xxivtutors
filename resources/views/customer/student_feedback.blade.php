@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                        <h2 style="clear: both; ">Tutors awaiting your feedback &nbsp;&nbsp;&nbsp;
                            
                        </h2>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">Tutor</th>
                                    <th class="col-institute">Purchase Date	</th>
                                    <th class="col-grade">Write Feedback</th>
                                </tr>
                            </thead>
                             <tbody>
                                @forelse($pendingFeedback as $feedback)
                                    <tr>
                                        <td  class="col-qualification">
                                            <a href="#">
                                                {{ $feedback->tutor->username }}
                                            </a>
                                        </td>
                                        <td class="col-institute">{{ \Carbon\Carbon::parse($feedback->purchase_date)->format('d/m/Y') }}</td>
                                        <td>
                                        <a href="{{ route('student.feedback.create', $feedback->tutor->id) }}">
                                            <i class="fa fa-edit">Create</i>
                                        </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No pending feedback</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <h2 style="clear: both; ">Tutors you have left feedback for &nbsp;&nbsp;&nbsp;</h2>
                         @if($submittedFeedback->isEmpty())
                        <span class="profilescorealert">
                        <p class="important">You have no users tagged.</p>
                        </span>
                         @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-qualification">To</th>
                                        <th class="col-institute">Report</th>
                                        <th class="col-grade">Rating</th>
                                        <th class="col-institute">Status</th>
                                        <th class="col-grade">Sent</th>
                                        <th class="col-grade">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submittedFeedback as $feedback)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{ $feedback->tutor->username }}
                                                </a>
                                            </td>
                                            <td>{{ $feedback->content }}</td>
                                            <td>{{ $feedback->tutor_rating }} / 5</td>
                                            <td>Awaiting Approval</td>
                                            <td>{{ optional($feedback->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                                            <td>
                                                <a href="#">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                </div>
            </div>
        </div>
</section>

@endsection


                                   