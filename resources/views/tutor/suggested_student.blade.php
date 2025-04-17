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
                    <table class="table table-striped table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Job Detail</th>
                            </tr>
                          
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>
                                <a href="#" title="Send Message">

                                    <strong>{{ $student->level_title }} {{ $student->subject_title }}</strong>
                                    @if(!empty($student->town) && !empty($student->county))
                                    located in {{ $student->town }} {{ $student->county }}
                                    @endif
                                </a>
                                </td>
                                <td style="padding: 10px;">
                                <a href="#" title="Send Message">
                                <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Message" style="width: 20px; height: 20px;">
                                </a> </td>
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