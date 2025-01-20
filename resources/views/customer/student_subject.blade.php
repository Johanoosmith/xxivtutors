@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <div class="dashboard-overview">
                        <div class="row">
                            <div class="col-md-4">
                            <h2>My Subjects</h2>
                            <span style="font-size: 12px;">&nbsp;&nbsp;
                                <img src="/images/plus.gif" style="position: relative; left: 0px; top: 2px;" alt="* ">&nbsp;
                                <a href="{{ route('customer.student_add_subject') }}">Add a Subject </a>
                            </span>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="table-responsive">
                                <div class="col-6 col-lg-3 dashboard-box">
                                <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Level</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="pages">
                                                    <tr>
                                                        <td>Art</td>
                                                        <td>K5</td>
                                                        <td class="noselect text-right">	
                                                        <div class="action-tools">
                                                            <a href="http://192.168.9.32:18212/admin/student/1/edit" class="btn btn-info btn-sm action-btn edit" data-toggle="tooltip" title="" data-original-title="Edit">
                                                                <i class="far fa-edit"> Edit</i>
                                                            </a>	
                                                            <a href="http://192.168.9.32:18212/admin/delete-student/1" onclick="confirmation(event)" class="btn btn-danger btn-sm action-btn delete" data-toggle="tooltip" title="" data-original-title="Delete">
                                                                <i class="far fa-trash-alt"></i> Delete
                                                            </a> 									
                                                        </div>
                                                                            
                                                        </td> 
                                                    </tr>
                                
                                                </tbody>
                                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
