@extends('layouts.cms')
@section('content')

<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                <h2 style="clear: both; ">Students  have left feedback for &nbsp;&nbsp;&nbsp;</h2>
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