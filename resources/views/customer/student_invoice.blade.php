@extends('layouts.cms')
@section('content')
    <section class="dashboard-with-sidebar">
        <div class="container">
            <div class="row">
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h3>Invoice for Payment #{{ $payment->id }}</h3>

                    <img src="{{ asset(config('settings.', 'uploads/logos/header_log.png')) }}" alt="">
                    <div class="col-md-6">
                        <h5><strong>Invoice To:</strong></h5>
                        <p>
                            {{ $payment->student->fullname ?? ' ' }}<br>
                            {{ $payment->student->address ?? 'Address not available' }}<br>
                            {{ $payment->student->city ?? '' }}<br>
                            {{ $payment->student->state ?? '' }}<br>
                            {{ $payment->student->postcode ?? '' }}<br>

                            <h3>Tutor </h3>
                            {{ $payment->tutor->fullname ?? ' ' }}<br>
                            {{ $payment->tutor->address ?? 'Address not available' }}<br>
                            {{ $payment->tutor->city ?? '' }}<br>
                            {{ $payment->tutor->state ?? '' }}<br>
                            {{ $payment->tutor->postcode ?? '' }}<br>
                            <strong>Your Account:</strong> {{ $payment->student->username ?? ' ' }}
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tutor Fee Row -->
                                <tr>
                                    <td>Tutor Fee for {{ $payment->tutor->fullname ?? ' ' }}</td>
                                    <td>1</td>
                                    <td>{{ getAmount($payment->charge_amount, 2) }}</td>
                                    <!-- Assuming amount in cents -->
                                </tr>

                                <!-- VAT Row -->
                                <tr>
                                    <td>VAT</td>
                                    <td>1</td>
                                    <td>{{ getAmount($payment->vat_amount) ?? '0.00' }}</td>
                                    <!-- Assuming VAT is stored in cents -->
                                </tr>

                                <!-- Total Row -->
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td>{{ getAmount($payment->charge_amount) }}</td>
                                    <!-- Assuming total is the charge amount -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right">
                    {{-- <a href="{{ route('invoice.download', $payment->id) }}" class="btn btn-primary">Download Invoice</a> --}}
                </div>
            </div>
        </div>
    @endsection
