@extends('layouts.admin')
@section('title') Admin Dashboard @endsection
@section('inline-css')
@endsection
@section('content')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Dashboard</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
        <!-- Card 1: Count Display -->
        <div class="col-sm-3">
            <div class="card prod-p-card bg-light-info background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Total Students</h6>
                            <h3 class="m-b-0">{{ $data['students'] }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-info">school</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="col-sm-3">
            <div class="card prod-p-card bg-light-success background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Total Tutors</h6>
                            <h3 class="m-b-0">{{ $data['tutors'] }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-success">person</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        
        <div class="col-sm-3">
            <div class="card prod-p-card bg-light-primary background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Confirmed Bookings</h6>
                            <h3 class="m-b-0">{{ $data['confirmed_bookings'] }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-primary">check_circle</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="col-sm-3">
            <div class="card prod-p-card bg-light-warning background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Pending Bookings</h6>
                            <h3 class="m-b-0">{{ $data['pending_bookings'] }}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-warning">pending_actions</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card prod-p-card background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Students</h6>
                            <p><a href="{{ route('admin.student.index', ['role' => 'student']) }}">View More</a></p>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-primary">arrow_forward</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card prod-p-card background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Tutors</h6>
                            <p><a href="{{ route('admin.tutors.index', ['role' => 'tutor']) }}">View More</a></p>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-primary">arrow_forward</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card prod-p-card background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Confirmed Bookings</h6>
                            <p><a href="{{ route('admin.booking.index', ['status' => 2]) }}">View More</a></p>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-primary">arrow_forward</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card prod-p-card background-pattern">
                <div class="card-body">
                    <div class="row align-items-center m-b-0">
                        <div class="col">
                            <h6 class="m-b-5">Pending Bookings</h6>
                            <p><a href="{{ route('admin.booking.index', ['status' => 1]) }}">View More</a></p>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons-two-tone text-primary">arrow_forward</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

         
        </div>
    </div>
</div>
@endsection
@endsection

@section('inline-js')


@endsection