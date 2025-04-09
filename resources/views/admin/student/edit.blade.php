@extends('layouts.admin')

@section('content')
    <h1>Edit Student</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="fullname" value="{{ $student->user->fullname ?? '' }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->user->email ?? '' }}">
        </div>

        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" value="{{ $student->user->mobile ?? '' }}">
        </div>

        {{-- <div class="form-group">
                    <label for="course">Select Course</label>
                    <select name="course" id="course" class="form-control">
                        <option value="">Select a Course</option>
                        <option value="Computer Science" {{ old('course', $student->course ?? '') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                        <option value="Mathematics" {{ old('course', $student->course ?? '') == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                        <option value="Physics" {{ old('course', $student->course ?? '') == 'Physics' ? 'selected' : '' }}>Physics</option>
                        <option value="Chemistry" {{ old('course', $student->course ?? '') == 'Chemistry' ? 'selected' : '' }}>Chemistry</option>
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

        <div class="form-group">
            <label for="password">Password (leave blank if you don't want to change)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection
