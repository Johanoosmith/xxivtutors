@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>Edit Qualification</h2>
                    <p>TPlease provide details of your qualification. Select the image file for your qualification certificate so we can verify your qualification.</p>
                            @include('elements.user.alert_message')
                            <form class="edit-form" action="{{ route('qualification.update', $qualification->id) }}" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
    
                            @csrf
                                @method('PUT') <!-- This will ensure the form uses PUT for updating data -->

                                <div class="row">
                                    <!-- Qualification Type -->
                                    <div class="col-md-6 form-field">
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <label class="form-label" for="idtype">Qualification Type</label>
                                        <div class="select-field">
                                            <select class="form-select" id="idtype" name="qtype">
                                                <option value="all" {{ $qualification->qtype == 'all' ? 'selected' : '' }}>All</option>
                                                <option value="school" {{ $qualification->qtype == 'school' ? 'selected' : '' }}>School</option>
                                                <option value="university" {{ $qualification->qtype == 'university' ? 'selected' : '' }}>University</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Qualification -->
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="qualification_id">Qualification</label>
                                        <div class="select-field">
                                        @php
                                            $qualifications = session('qualifications') ?? [];
                                        @endphp
                                        <select class="form-select" id="qualification_id" name="qualification_id">
                                            @foreach ($qualification_list as $q_id => $q_title)
                                                <option value="{{ $q_id }}" 
                                                    {{ (isset($selectedQualification) && $q_id == $selectedQualification) ? 'selected' : '' }}>
                                                    {{ $q_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <!-- University -->
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="institute_name">University</label>
                                        <input type="text" class="form-control" name="institute_name" id="institute_name" value="{{ $qualification->institute_name }}">
                                    </div>

                                    <!-- Course -->
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="subject">Course</label>
                                        <input type="text" class="form-control" name="subject" id="subject" value="{{ $qualification->subject }}">
                                    </div>

                                    <!-- Grade -->
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="grade">Grade</label>
                                        <input type="text" name="grade" class="form-control" id="grade" value="{{ $qualification->grade }}">
                                    </div>

                                    <!-- Qualification Date -->
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="qyear">Qualification Date</label>
                                        <div class="select-field">
                                            <select class="form-select" id="qyear" name="qyear">
                                                @foreach (range(date('Y'), 1900) as $year)
                                                    <option value="{{ $year }}" {{ $qualification->qyear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- File Upload (if file exists, show the filename) -->
                                    <div class="upload-wrapper col-12 form-field ">
                                        <input type="file" name="qdocument" id="file" class="hidden-input" onchange="handleFileChange(event)">
                                        <div class="upload-area" id="uploadfile">
                                            <h2>Drag and Drop or Click to Upload File</h2>
                                        </div>

                                        <div class="fileblock" id="filePreview" style="display: none;">
                                            <span id="filename1"></span>
                                            <span id="filesize1"></span>
                                            <button type="button" onclick="clearFileInput()">Clear</button>
                                        </div>
                                        @if(!empty($qualification->qdocument))
                                            <h3 class="mt-5">Uploaded File:</h3>
                                            <div class="profile-photo-container">
                                                <img src="{{ asset('storage/' . $qualification->qdocument) }}" 
                                                    alt="Profile Photo" 
                                                    class="profile-photo">
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-green">Update Qualification</button>
                                    </div>
                                    <div class="col-9">
                                        <a href="{{ route('tutor.qualification') }}" class="btn btn-green">Back</a>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
</section>
@endsection
<style>
    .hidden-input {
        position: absolute;
        opacity: 0;
       
        cursor: pointer;
    }
    .upload-area {
        background-color: #f9f9f9;
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    .fileblock {
        margin-top: 10px;
    }
</style>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('file');
    const uploadArea = document.getElementById('uploadfile');

    // Trigger file input when clicking the upload area
    uploadArea.addEventListener('click', function () {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            document.getElementById('filename1').textContent = file.name;
            document.getElementById('filesize1').textContent = formatFileSize(file.size);
            document.getElementById('filePreview').style.display = 'block';
        }
    });
});

function clearFileInput() {
    const fileInput = document.getElementById('file');
    fileInput.value = ''; // Clear file input value
    document.getElementById('filePreview').style.display = 'none';
    document.getElementById('filename1').textContent = '';
    document.getElementById('filesize1').textContent = '';
}

function formatFileSize(bytes) {
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    if (bytes === 0) return '0 Bytes';
    const i = Math.floor(Math.log(bytes) / Math.log(1024));
    return `${(bytes / Math.pow(1024, i)).toFixed(2)} ${sizes[i]}`;
}


</script>
