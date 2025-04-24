@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                @include('elements.alert_message')

                <h2>Add Qualification</h2>
                <p>TPlease provide details of your qualification. Select the image file for your qualification certificate so we can verify your qualification.</p>
                @if (session('success'))
                <div class="success" style="color: green;">
                    {{ session('success') }}
                </div>
                @endif
                <form class="edit-form" action="{{ route('tutor.qualifications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- @include('elements.user.alert_message') -->
                    <div class="row">
                        <!-- Qualification Type -->
                        <div class="col-md-6 form-field">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <label class="form-label" for="idtype">Qualification Type</label>
                            <div class="select-field">
                                <select class="form-select" id="qualification_type" name="qualification_type">
                                    <option value="all" {{ old('qualification_type') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="school" {{ old('qualification_type') == 'school' ? 'selected' : '' }}>School</option>
                                    <option value="university" {{ old('qualification_type') == 'university' ? 'selected' : '' }}>University</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-field">
                            <label class="form-label" for="idtype">Qualification</label>
                            <div class="select-field">
                                <select class="form-select" id="qualification_id" name="qualification_id">
                                    @foreach ($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}" {{ old('qualification_id') == $qualification->id ? 'selected' : '' }}>
                                        {{ $qualification->qualification }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-field">
                            <label class="form-label" for="university">University</label>
                            <input type="text" class="form-control" name="institute_name" id="institute_name" value="{{ old('institute_name') }}">
                        </div>
                        <div class="col-md-6 form-field">
                            <label class="form-label" for="lastname">Course</label>
                            <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}">
                        </div>

                        <div class="col-md-6 form-field">
                            <label class="form-label" for="grade">Grade</label>
                            <input type="text" name="grade" class="form-control" id="grade" value="{{ old('grade') }}">
                        </div>

                        <div class="col-md-6 form-field">
                            <label class="form-label" for="qdate">Qualification Date:</label>
                            <div class="select-field">
                                <select class="form-select" id="qdate" name="qualification_year">
                                    <option value="" disabled {{ old('qualification_year') ? '' : 'selected' }}>Year</option>
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                    <option value="{{ $year }}" {{ old('qualification_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-12 form-field uploadContainer">
                            <!-- Hidden Input for File Upload -->
                            <input type="file" name="qdocument" id="file" style="display: none;" onchange="handleFileChange(event)">
                            <!-- Drag and Drop Container -->
                            <div class="upload-area" id="uploadfile" onclick="triggerFileInput()">
                                <svg class="uploadIcon" width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M19 14v5H5v-5H3v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5h-2zm-7-4 4 4h-3v4h-2v-4H8l4-4zm1-8h-2v4H9.5l2.5-3 2.5 3H13V2z"></path>
                                </svg>
                                <h2 id="draganddropheader">Drag and Drop or Click to Upload File</h2>
                            </div>
                            <!-- File Preview Section -->
                            <div class="fileblock" id="filePreview" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="filedesc">
                                        <span id="filename1" class="filename"></span>
                                        &nbsp;&nbsp;<span id="filesize1" class="filesize"></span>
                                    </span>
                                    <button type="button" class="closefile btn-danger" onclick="clearFileInput()">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-green">Complete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    // Ensure DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get the file input element
        const fileInput = document.getElementById('file');
        const uploadArea = document.getElementById('uploadfile');

        // Check if fileInput and uploadArea exist
        if (!fileInput || !uploadArea) {
            console.error('File input or upload area not found in the DOM.');
            return;
        }

        // Trigger file input click when the upload area is clicked
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', function(event) {
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