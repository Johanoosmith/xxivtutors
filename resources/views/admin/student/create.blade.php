<!-- resources/views/student/index.blade.php -->

@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('content')

        <!-- Display validation errors -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

     
        <div class="card">
            <div class="card-header">
                <h5>Create New Student</h5>
            </div>
            <!-- Create User Form -->
            <div class="card-body">
            <form action="{{ route('admin.student.store') }}" method="POST" class="validatedForm">
                @csrf

                <!-- Fullname -->
                <div class="form-group">
                    <label for="fullname">Fullname</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name" >
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
                </div>

                <!-- Contact -->
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" >
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
                </div>

                  <!-- Select Course Field -->
                {{-- <div class="form-group">
                    <label for="course">Select Course</label>
                    <select name="course" id="course" class="form-control" required>
                        <option value="">Select a Course</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <!-- Add more courses as needed -->
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ old('status', $student->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $student->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
            </div>
        </div>
     
@endsection
