@extends('layouts.cms')

@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                <h2>Please provide at least two references</h2>
                <p>Please provide us with contact information for <strong>at least two referees</strong>. We will email them to collect a reference.</p>
                @include('elements.alert_message')
                <div class="alert alert-danger">
                    Please provide us contact information for at least two referees. We will email them to collect a reference.
                    This is a requirement to start tutoring at {{ config('constants.SITE.TITLE') }}.
                </div>
                <form class="edit-form" action="{{ route('tutor.submitreference') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Profession</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < 4; $i++)
                                        <tr>
                                        <td>
                                            <input type="text" name="reference[{{$i}}][firstname]" class="form-control"
                                                value="{{ old("reference.$i.firstname") }}">
                                        </td>
                                        <td>
                                            <input type="text" name="reference[{{$i}}][lastname]" class="form-control"
                                                value="{{ old("reference.$i.lastname") }}">
                                        </td>
                                        <td>
                                            <input type="email" name="reference[{{$i}}][email]" class="form-control"
                                                value="{{ old("reference.$i.email") }}">
                                        </td>
                                        <td>
                                            <input type="text" name="reference[{{$i}}][mobile]" class="form-control"
                                                value="{{ old("reference.$i.mobile") }}">
                                        </td>
                                        <td>
                                            <select name="reference[{{$i}}][profession]" class="form-select">
                                                @php
                                                $selectedProfession = old("reference.$i.profession", 'Teacher');
                                                @endphp
                                                <option value="Teacher" {{ $selectedProfession == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                                <option value="Doctor" {{ $selectedProfession == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                                                <option value="Engineer" {{ $selectedProfession == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                                                <option value="Lawyer" {{ $selectedProfession == 'Lawyer' ? 'selected' : '' }}>Lawyer</option>
                                                <option value="Other" {{ $selectedProfession == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </td>
                                        </tr>
                                        @endfor
                                </tbody>

                            </table>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-green">Add References</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection