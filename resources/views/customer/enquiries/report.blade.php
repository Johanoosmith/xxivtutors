@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>Inappropriate Content User Report</h2>
                    <p>This is the report user page, you can use the form below to alert us of any users who you think we should be made aware of. This may include users who have inappropriate content on their profile page or have been sending messages which are breaking the terms of service on {{ config('constants.SITE.TITLE') }}.</p>
                    
                    <p class="instruction bg-success text-white">
                        - Do not use this form to contact a member, only we read this report, not the user concerned.
                        <br>
                        - We usually review accounts in under 24 hours after receiving this alert. 
                    </p>
                    
                    @include('elements.alert_message')

                    <form action="{{ route('student.enquiries.report', $enquiry_id) }}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <div class="col-12 form-field">
                            <textarea class="form-control" required maxlength="5500" name="report_reason" id="ReportReason" placeholder="Write your message here for report"></textarea>
                            
                        </div>
                        <div class="col-12 form-field">
                            <button type="submit" class="btn btn-green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection

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
</script>
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
