@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>Suggested Tutors</h2>
                    <p>Here we list potential tutors who found matched your profile infomation.</p>
                       <span class="profilescorealert">
                        <p class="important">Sorry - we have no suggested tutors for you currently.  To help us build a list for you, please ensure your profile is complete.</p>
                        </span>
                        <div class="cardcontent">
                            <p></p>
                        </div>
                    </div>
            </div>
        </div>
</section>
@endsection


                                   