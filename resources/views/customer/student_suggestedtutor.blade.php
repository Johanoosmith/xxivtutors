@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.student_tabs')
            <div class="col dashboard-content">
                <h2>Suggested Tutors</h2>
                @if ($tutors->isEmpty())
                <span class="profilescorealert">
                    <p class="important">
                        Sorry - we have no suggested tutors for you currently.
                        To help us build a list for you, please ensure your profile is complete.
                    </p>
                </span>
                @else
                <table cellpadding="10" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Job Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutors as $tutor)
                        <tr>
                            <td style="width: 100%;">
                                <strong>{{ $tutor->level_title }} {{ $tutor->subject_title }}</strong>
                                located in {{ $tutor->town ?? 'N/A' }} {{ $tutor->county ?? '' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection