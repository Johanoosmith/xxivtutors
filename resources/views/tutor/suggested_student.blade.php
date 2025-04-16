@extends('layouts.cms')
@section('content')

<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                <h2>Suggested students who are looking for tuition
                </h2>
                <h4 class="mt-3">Here we list potential students which we found matched your profile infomation
                </h4>
                <div class="mt-3">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; padding: 10px;">Job Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td style="padding: 10px; width: 100%;">
                                    <strong>{{ $student->level_title }} {{ $student->subject_title }}</strong>
                                    located in {{ $student->town ?? 'N/A' }} {{ $student->county ?? 'N/A' }}
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