@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Verify your Tutor Hunt Account</h2>
                    <p>To make full use of our service and have maximum exposure to our 10,000s of students, please complete the following steps and <strong>verify your Tutor Hunt account</strong>.</p>
                    <p>To activate your profile and feature in student's searches please complete the following steps to <strong>verify your Tutor Hunt account.</strong> We will never display any documents you have provided us within your profile, we will just indicate what we have verified.</p>
                    @include('elements.user.alert_message')
                    <div class="card">
                    <div class="cardheader">
                        <h2 class="cardtitle">Verification Summary </h2>
                    </div>
        <div class="cardtable tablewrap">
                <table class="table tablestriped">
                    <tbody>
                        <tr>
                            <th style="width: 29%;">Mandatory Items </th>
                            <th style="width: 29%;">Progress </th>
                            <th></th>
                        </tr>
                        <tr>  
                            <td height="30">
                                <div class="infopanel-wrapper">
                                    <span style="position: relative; top: -2px; ">Profile image </span>
                                </div>
                            </td>
                            <td> 
                                @if ($user->profile_image)
                                <img src="https://www.tutorhunt.com/images/icon-tick-a.png" style="position: relative; top: 2px;"> 
                                <span class="profilescorealert">
                                    <span class="infookay">Profile Photo Added</span> 
                                </span>
                                @else
                                <span class="profilescorealert">
                                    <span class="infookay">Profile Photo Not Uploaded</span> 
                                </span>
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
                            <td height="30">
                                <div class="infopanel-wrapper">
                                    <span style="position: relative; top: -2px;">Photo ID</span>
                                </div>
                            </td>
                            <td>
                                <span class="profilescorealert">
                                    <span class="infookay">Not Uploaded</span>
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tutor.proofidentity') }}">Upload ID</a>   	 
                            </td>
                        </tr>
                        <tr>      
                            <td height="30">	
                                <div class="infopanel-wrapper">
                                    <span style="position: relative; top: -2px;">Enhanced DBS </span>
                                </div>
                            </td>
                            <td>
                                <span class="profilescorealert">
                                    <span class="infookay">Not Uploaded</span> 
                                </span>
                            </td>
                            <td>
                                <a href="/members/upload-crb.asp">Upload Another DBS</a>
                                | <a href="/members/dbs-application.asp">Apply for DBS</a> 
                            </td>
                        </tr>
                    </tbody>
                </table>  
                </div> 
                <div class="cardcontent">
                <p>
                </p></div>
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
