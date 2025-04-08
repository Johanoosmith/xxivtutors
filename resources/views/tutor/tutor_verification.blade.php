@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Verify your {{ config('constants.SITE.TITLE') }} account</h2>
                    <p>To make full use of our service and have maximum exposure to our 10,000s of students, please complete the following steps and <strong>verify your {{ config('constants.SITE.TITLE') }} account</strong>.</p>
                    <p>To activate your profile and feature in student's searches please complete the following steps to <strong>verify your {{ config('constants.SITE.TITLE') }} account.</strong> We will never display any documents you have provided us within your profile, we will just indicate what we have verified.</p>
                    @include('elements.alert_message')
                    <h2 class="mt-5">Verification Summary</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped default-table">
                            <thead>
                                <tr>
                                    <th>Mandatory Items</th>
                                    <th>Progress</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Profile image</th>
                                    <td>
                                        @if ($user->profile_image)
                                        <svg class="right-tick text-success">
                                            <use xlink:href="#tick"></use>
                                        </svg> 
                                            Profile Photo Added
                                        @else
                                            Profile Photo Not Uploaded
                                        @endif
                                    </td>
                                    @if ($user->profile_image)
                                        <td></td>
                                    @else
                                        <td>
                                        <a href="{{ route('customer.profile-photo') }}">Upload Profile Photo</a>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Photo ID</th>
                                    @if($verification)
                                    <td>
                                        {{ $statusLabels[$verification->status] ?? 'Unknown Status' }}
                                    </td>
                                    @else
                                    <td>
                                        No verification record found.
                                    </td>
                                    @endif
                                    
                                    <td>
                                        <a href="{{ route('tutor.proofidentity') }}">Upload ID</a>   	 
                                    </td>
                                </tr>
                                <tr>
                                    <th>References</th>
                                    @if($verification)
                                    <td>
                                        @php
                                            $ref_app_count = 0;
                                            foreach ($references as $reference) {
                                                if ($reference->status == 1) {
                                                    $ref_app_count++;
                                                }
                                            }
                                        @endphp

                                        @if($ref_app_count > 2)
                                            <svg class="right-tick text-success">
                                                <use xlink:href="#tick"></use>
                                            </svg>
                                        @endif
                                        {{ $ref_app_count > 2 ? 'Approved' : 'Pending'  }}
                                    </td>
                                    @else
                                    <td>
                                        No verification record found.
                                    </td>
                                    @endif
                                    
                                    <td>
                                        <a href="{{ route('tutor.addrefernce') }}">Add Reference</a>   	 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Enhanced DBS</th>
                                    @if($verification)
                                <td>
                                    <span class="profilescorealert">
                                        <span class="infookay">{{ $statusLabels[$verification->status] ?? 'Unknown Status' }}</span>
                                    </span>
                                </td>
                                @else
                                <td>
                                    <span class="profilescorealert">
                                        <span class="infookay">No verification record found.</span>
                                    </span>
                                </td>
                                @endif
                                <td>
                                    <a href="{{ route('tutor.proofdbs') }}">Upload Another DBS</a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="mt-5">My Verification Document Status</h2>
                    <h2>
                    Reference   
                    <span><a href="{{ route('tutor.addrefernce') }}" class="btn btn-yellow btn-small">Add a Reference</a></span>
                    </h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped default-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Sent</th>
                                    <th>Status</th>
                                    <th>Delete</th>
                                    <th>Resend</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($references as $reference)
                                <tr>
                                    <th>{{$reference->first_name}} {{$reference->last_name}}</th>
                                    <td>
                                    <span class="profilescorealert">
                                        <span class="infookay">{{$reference->email}}</span> 
                                    </span>
                                    </td>
                                    <td>{{$reference->sent_date}}</td>
                                    <td class="col-status">
                                        @if ($reference->status == "approved")
                                        <span class="status bg-success text-white">Approved</span>
                                        @elseif ($reference->status == "pending")
                                        <span class="status bg-warning">No Reply</span>
                                        @else
                                        <span class="status bg-danger text-white">Rejected</span>
                                        @endif
                                    </td>
                                    @if ($reference->status == "approved")
                                    <td class="col-action"></td>
                                    @else
                                    <td class="col-action">
                                        <form action="#" method="POST" style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE"> 
                                            <button type="submit" class="icon-btn">
                                                <svg class="icon">
                                                <use xlink:href="#delete"></use>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    @endif

                                    @if ($reference->status == "approved")
                                    <td class="col-action"></td>
                                    @else
                                    <td class="col-action">
                                    <form action="{{ route('tutor.resend.email', $reference->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Resend</button>
                                    </form>
                                    </td>
                                    @endif
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
<script>
    // Ensure DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get the file input element
    const fileInput = document.getElementById('file');
    const uploadArea = document.getElementById('uploadfile');

    // Check if fileInput and uploadArea exist
    if (!fileInput || !uploadArea) {
        console.error('File input or upload area not found in the DOM.');
        return;
    }

    // Trigger file input click when the upload area is clicked
    uploadArea.addEventListener('click', function () {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            // Display the file name and size in the preview section
            document.getElementById('filename1').textContent = file.name;
            document.getElementById('filesize1').textContent = formatFileSize(file.size);

            // Show the preview section
            document.getElementById('filePreview').style.display = 'block';
        }
    });
});

// Clear file input and preview
function clearFileInput() {
    const fileInput = document.getElementById('file');
    if (fileInput) {
        fileInput.value = ''; // Clear the file input value
    }

    // Hide the preview section
    document.getElementById('filePreview').style.display = 'none';
    document.getElementById('filename1').textContent = '';
    document.getElementById('filesize1').textContent = '';
}

// Utility function to format file size
function formatFileSize(bytes) {
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes === 0) return '0 Bytes';

    const i = Math.floor(Math.log(bytes) / Math.log(1024));
    return `${(bytes / Math.pow(1024, i)).toFixed(2)} ${sizes[i]}`;
}

</script>
