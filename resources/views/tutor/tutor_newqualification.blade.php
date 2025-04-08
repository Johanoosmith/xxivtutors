@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
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
                                        <select class="form-select" id="idtype" name="qtype">
                                                <option value="all">All</option>
                                                <option value="school">School</option>
                                                <option value="university">university</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="idtype">Qualification</label>
                                        <div class="select-field">
                                        <select class="form-select" id="idtype" name="qualification_id">
                                            @foreach ($qualifications as $qualification)
                                                <option value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="university">University</label>
                                        <input type="text" class="form-control" name="institute_name" id="institute_name" value="">
                                    </div>
                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="lastname">Course</label>
                                        <input type="text" class="form-control" name="subject" id="subject" value="">
                                    </div>

                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="grade">Grade</label>
                                        <input type="text" name="grade" class="form-control" id="grade" value="">
                                    </div>

                                    <div class="col-md-6 form-field">
                                        <label class="form-label" for="qdate">Qualification Date:</label>
                                        <div class="select-field">
                                            <select class="form-select" id="qdate" name="qyear" >
                                                <option value="none" selected="selected">Year</option> 
                                                <option value="2025">2025</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                                <option value="2017">2017</option>
                                                <option value="2016">2016</option>
                                                <option value="2015">2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                                <option value="2012">2012</option>
                                                <option value="2011">2011</option>
                                                <option value="2010">2010</option>
                                                <option value="2009">2009</option>
                                                <option value="2008">2008</option>
                                                <option value="2007">2007</option>
                                                <option value="2006">2006</option>
                                                <option value="2005">2005</option>
                                                <option value="2004">2004</option>
                                                <option value="2003">2003</option>
                                                <option value="2002">2002</option>
                                                <option value="2001">2001</option>
                                                <option value="2000">2000</option>
                                                <option value="1999">1999</option>
                                                <option value="1998">1998</option>
                                                <option value="1997">1997</option>
                                                <option value="1996">1996</option>
                                                <option value="1995">1995</option>
                                                <option value="1994">1994</option>
                                                <option value="1993">1993</option>
                                                <option value="1992">1992</option>
                                                <option value="1991">1991</option>
                                                <option value="1990">1990</option>
                                                <option value="1989">1989</option>
                                                <option value="1988">1988</option>
                                                <option value="1987">1987</option>
                                                <option value="1986">1986</option>
                                                <option value="1985">1985</option>
                                                <option value="1984">1984</option>
                                                <option value="1983">1983</option>
                                                <option value="1982">1982</option>
                                                <option value="1981">1981</option>
                                                <option value="1980">1980</option>
                                                <option value="1979">1979</option>
                                                <option value="1978">1978</option>
                                                <option value="1977">1977</option>
                                                <option value="1976">1976</option>
                                                <option value="1975">1975</option>
                                                <option value="1974">1974</option>
                                                <option value="1973">1973</option>
                                                <option value="1972">1972</option>
                                                <option value="1971">1971</option>
                                                <option value="1970">1970</option>
                                                <option value="1969">1969</option>
                                                <option value="1968">1968</option>
                                                <option value="1967">1967</option>
                                                <option value="1966">1966</option>
                                                <option value="1965">1965</option>
                                                <option value="1964">1964</option>
                                                <option value="1963">1963</option>
                                                <option value="1962">1962</option>
                                                <option value="1961">1961</option>
                                                <option value="1960">1960</option>
                                                <option value="1959">1959</option>
                                                <option value="1958">1958</option>
                                                <option value="1957">1957</option>
                                                <option value="1956">1956</option>
                                                <option value="1955">1955</option>
                                                <option value="1954">1954</option>
                                                <option value="1953">1953</option>
                                                <option value="1952">1952</option>
                                                <option value="1951">1951</option>
                                                <option value="1950">1950</option>
                                                <option value="1949">1949</option>
                                                <option value="1948">1948</option>
                                                <option value="1947">1947</option>
                                                <option value="1946">1946</option>
                                                <option value="1945">1945</option>
                                                <option value="1944">1944</option>
                                                <option value="1943">1943</option>
                                                <option value="1942">1942</option>
                                                <option value="1941">1941</option>
                                                <option value="1940">1940</option>
                                                <option value="1939">1939</option>
                                                <option value="1938">1938</option>
                                                <option value="1937">1937</option>
                                                <option value="1936">1936</option>
                                                <option value="1935">1935</option>
                                                <option value="1934">1934</option>
                                                <option value="1933">1933</option>
                                                <option value="1932">1932</option>
                                                <option value="1931">1931</option>
                                                <option value="1930">1930</option>
                                                <option value="1929">1929</option>
                                                <option value="1928">1928</option>
                                                <option value="1927">1927</option>
                                                <option value="1926">1926</option>
                                                <option value="1925">1925</option>
                                                <option value="1924">1924</option>
                                                <option value="1923">1923</option>
                                                <option value="1922">1922</option>
                                                <option value="1921">1921</option>
                                                <option value="1920">1920</option>
                                                <option value="1919">1919</option>
                                                <option value="1918">1918</option>
                                                <option value="1917">1917</option>
                                                <option value="1916">1916</option>
                                                <option value="1915">1915</option>
                                                <option value="1914">1914</option>
                                                <option value="1913">1913</option>
                                                <option value="1912">1912</option>
                                                <option value="1911">1911</option>
                                                <option value="1910">1910</option>
                                                <option value="1909">1909</option>
                                                <option value="1908">1908</option>
                                                <option value="1907">1907</option>
                                                <option value="1906">1906</option>
                                                <option value="1905">1905</option>
                                                <option value="1904">1904</option>
                                                <option value="1903">1903</option>
                                                <option value="1902">1902</option>
                                                <option value="1901">1901</option>
                                                <option value="1900">1900</option>
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
