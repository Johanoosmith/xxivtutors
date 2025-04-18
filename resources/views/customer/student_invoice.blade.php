@extends('layouts.cms')
@section('content')
    <section class="dashboard-with-sidebar">
        <div class="container">
            <div class="row">
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <div class="invoice-container">
                        <div class="title-with-link-wrapper">
                            <h3>Invoice for Payment #{{ $payment->id }}</h3>
                            <!--<a href="#" class="btn btn-yellow btn-small">Print</a>-->
                        </div>
                        
                        <div class="invoice-logo">
                            <img src="{{ asset(config('settings.', 'storage/uploads/logos/invoice-logo.png')) }}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Invoice To:</h5>
                                <p class="m-0">{{ $payment->student->fullname ?? ' ' }}</p>
                                <p class="m-0">{{ $payment->student->address ?? 'Address not available' }}</p>
                                <p class="m-0">{{ $payment->student->city ?? '' }}</p>
                                <p class="m-0">{{ $payment->student->state ?? '' }}</p>
                                <p>{{ $payment->student->postcode ?? '' }}</p>
                                
                            </div>
                            <div class="col-md-6">
                                <h5>Tutor </h5>
                                <p class="m-0">{{ $payment->tutor->fullname ?? ' ' }}</p>
                                <p class="m-0">{{ $payment->tutor->address ?? 'Address not available' }}</p>
                                <p class="m-0">{{ $payment->tutor->city ?? '' }}</p>
                                <p class="m-0">{{ $payment->tutor->state ?? '' }}</p>
                                <p>{{ $payment->tutor->postcode ?? '' }}</p>
                            </div>
                            <div class="col-md-12 mt-4">
                                <p class="m-0">Your Account: {{ $payment->student->username ?? ' ' }}</p>
                                <p>Invoice Date: 12th September 2024</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                        <td colspan="2">VAT</td>
                                        <td>{{ getAmount($payment->vat_amount) ?? '0.00' }}</td>
                                        <!-- Assuming VAT is stored in cents -->
                                    </tr>

                                    <!-- Total Row -->
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>{{ getAmount($payment->charge_amount) }}</td>
                                        <!-- Assuming total is the charge amount -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-6">VAT Number:130 5954 26</div>
                            <div class="col-6 text-end">Ref:b71554751157759</div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{-- <a href="{{ route('invoice.download', $payment->id) }}" class="btn btn-primary">Download Invoice</a> --}}
                </div>
            </div>
        </div>
    @endsection
