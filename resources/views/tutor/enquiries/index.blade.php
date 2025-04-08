@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>My Enquiries</h2>
                    <p>Please ensure open enquiries are responded to, if you can not help the student you should close the enquiry.</p>

                    <p class="instruction bg-success text-white">Please do not enter email addresses/urls/websites/home addresses (or any other information that can allow contact) in this message. Users who do so will immediately be removed from {{ config('constants.SITE.TITLE') }}.</p>

                    @include('elements.alert_message')

                    <div class="table-responsive noscroll">
                        <table class="table table-bordered table-striped default-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Enquiry</th>
                                    <th>Last Update</th>
                                    <th>Stauts</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $enquiryStatus = getEnquiryStatus();
                                @endphp
                                @forelse($enquiries as $enquiry)
                                    @php
                                        $status_class = $enquiry->status == 1 ? 'warning' : ($enquiry->status == 2 ? 'danger' : 'success');
                                        $status_label = $enquiryStatus[$enquiry->status];
                                    @endphp
                                    <tr>
                                        <td> 
                                            <div class="infopanel-wrapper">
                                                <span style="position: relative; top: -2px; ">
                                                    <a href="{{ route('tutor.enquiries.chat', $enquiry->id) }}">
                                                    {{ $enquiry->receiver->username }}
                                                    </a>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span>{{ Str::limit($enquiry->enquiry_comments[0]->content, 50, '...') }}</span></td>
                                        <td><span>{{ $enquiry->enquiry_comments[0]->updated_at->format(config('constants.SITE.DATE_FORMAT')) }}</span></td>
                                        <td>
                                            <span class="badge bg-{{$status_class}}">{{$status_label}}</span>
                                        </td>
                                        <td>
                                            <div class="menuholder dropdown">
                                                <button class="action-button">
                                                    <span class="mobno">Action</span>
                                                    <svg class="icon iconlogin">
                                                        <use xlink:href="#caretDown"></use>
                                                    </svg>
                                                </button>
                                                <div class="dropdownmenu">
                                                    <a href="{{ route('tutor.enquiries.chat', $enquiry->id) }}">View Enquiry</a>
                                                    <a href="{{ route('tutor.booking.index') }}">View Lessons</a>
                                                    <a href="{{ route('tutor.booking.create') }}">Book Lessons</a>
                                                    @if($enquiry->status == 1)
                                                        <!--<a href="{{ route('tutor.enquiries.close', $enquiry->id) }}" data-toggle="tooltip" title="Close Enquiry" onclick="return confirm('are you sure to close the enquiry?');">Close Enquiry</a>-->

                                                        <form id="{{ 'EnquiryClose_'.$enquiry->id }}" action="{{ route('tutor.enquiries.close', $enquiry->id) }}" method="POST" style="display: inline;" data-toggle="tooltip"  title="" data-original-title="Close Enquiry" >
                                                            @csrf
                                                            @method('POST')
                                                        </form>

                                                        <a href="#" onclick="confirmEnquiryClose(event, '{{ $enquiry->id }}')" 
                                                            data-toggle="tooltip" title="Close Enquiry">
                                                                Close Enquiry
                                                        </a>
                                                        <a href="{{ route('tutor.enquiries.report', $enquiry->id) }}">Report Enquiry</a>
                                                    @endif


                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('custom-js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".action-button").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.stopPropagation();
            let dropdown = this.nextElementSibling;
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });
    });

    document.addEventListener("click", function () {
        document.querySelectorAll(".dropdownmenu").forEach((menu) => {
            menu.style.display = "none";
        });
    });
});

function confirmEnquiryClose(event, enquiryId) {
        event.preventDefault(); // Prevent the default anchor click action
        
        if (confirm('Are you sure you want to close the enquiry?')) {
            document.getElementById('EnquiryClose_' + enquiryId).submit();
        }
    }

</script>
@endsection

@section('custom-css')
<style>

.menuholder {
    position: relative;
    display: inline-block;
}

.action-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
}

.icon {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.dropdownmenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #ccc;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    padding: 10px;
    min-width: 150px;
    z-index: 1000;
}

.dropdownmenu a {
    display: block;
    padding: 8px;
    text-decoration: none;
    color: black;
}

.dropdownmenu a:hover {
    background-color: #f2f2f2;
}
</style>
@endsection
