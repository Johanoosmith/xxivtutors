@extends('layouts.cms')
@section('content')
    <section class="dashboard-with-sidebar">
        <div class="container">
            <div class="row">
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h3>Invoice for Payment #{{ $payment->id }}</h3>

                    <div class="col-md-6">
                        <h5><strong>Invoice To:</strong></h5>
                        <p>
                            {{ $payment->student->name ?? ' ' }}<br>
                            {{ $payment->student->address ?? 'Address not available' }}<br>
                            {{ $payment->student->city ?? '' }}<br>
                            {{ $payment->student->state ?? '' }}<br>
                            {{ $payment->student->postcode ?? '' }}<br>
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
                                    <td>£{{ number_format($payment->tutor_amount / 100, 2) }}</td>
                                    <!-- Assuming amount in cents -->
                                </tr>

                                <!-- VAT Row -->
                                <tr>
                                    <td>VAT</td>
                                    <td>1</td>
                                    <td>£{{ number_format($payment->vat_amount / 100, 2) ?? '0.00' }}</td>
                                    <!-- Assuming VAT is stored in cents -->
                                </tr>

                                <!-- Total Row -->
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td>${{ number_format($payment->charge_amount, 2) }}</td>
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
