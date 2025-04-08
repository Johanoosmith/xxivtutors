@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <div class="title-with-link-wrapper">
                        <h2>My Subjects</h2>
                        <a href="{{ route('customer.student_add_subject') }}" class="btn btn-green btn-small">Add a Subject</a>    
                    </div>
                    <!-- If not added any qualification -->
                    <!-- <div class="important important bg-danger bg-opacity-10 text-danger">
                        <p>You currently have not selected any Subjects!</p>
                        <p>Without subjects you won't be found on our In-person lesson searches. Please <a href="{{ route('customer.student_add_subject') }}">Add a Subject</a> to be found on our In-person lesson searches.</p>
                    </div> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Level</th>
                                    <th class="small-col"></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="pages">
                                <tr>
                                    <td>Art</td>
                                    <td>K5</td>
                                    <td class="noselect small-col">    
                                        <div class="action-tools">
                                            <a href="http://192.168.9.32:18212/admin/student/1/edit" class="icon-btn edit" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <svg class="icon">
                                                    <use xlink:href="#edit"></use>
                                                </svg>
                                            </a>    
                                            <a href="http://192.168.9.32:18212/admin/delete-student/1" onclick="confirmation(event)" class="icon-btn delete" data-toggle="tooltip" title="" data-original-title="Delete">
                                                <svg class="icon">
                                                    <use xlink:href="#delete"></use>
                                                </svg>
                                            </a>                                    
                                        </div>
                                    </td> 
                                </tr>
            
                            </tbody>
                        </table>
                    </div>
                    <!-- If not added any qualification -->
                    <!-- <div class="title-with-link-wrapper mt-5">
                        <h2>My Online Subjects</h2>
                        <a href="#" class="btn btn-green btn-small">Add a Subject</a>    
                    </div> -->
                    <!-- If not added any qualification -->
                    <!-- <div class="important important bg-danger bg-opacity-10 text-danger">
                        <p>To help us to promote your profile to online students please tell us about your</p>
                        <p><a href="#">Online teaching experience here</a></p>
                    </div> -->
                    <!-- If not added any qualification -->
               </div>
            </div>
        </div>
</section>
@endsection
