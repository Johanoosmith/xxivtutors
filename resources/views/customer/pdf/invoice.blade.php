<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .invoice-logo img {
            max-height: 60px;
            margin-left: 120px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .table th {
            text-align: left;
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="title">
            <h2>Invoice for Payment #{{ $payment->id }}</h2>
        </div>

        <div class="invoice-logo">
            <img src="{{ public_path('storage/uploads/logos/invoice-logo.png') }}" alt="Logo">
        </div>

        <table style="width:100%; margin-top:20px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <h4>Invoice To:</h4>
                    <p>{{ $payment->student->fullname ?? ' ' }}</p>
                    <p>{{ $payment->student->address ?? 'Address not available' }}</p>
                    <p>{{ $payment->student->postcode ?? '' }}</p>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <h4>Tutor:</h4>
                    <p>{{ config('constants.SITE.TITLE') }}:</p>
                    <p>{{ config('constants.SITE.ADDRESS') }}</p>
                    <p>{{ config('constants.SITE.EMAIL') }}</p>
                </td>
            </tr>
        </table>

        <p><strong>Your Account:</strong> {{ $payment->student->username ?? ' ' }}</p>
        <p><strong>Invoice Date:</strong>{{ $payment->created_at }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tutor Fee for {{ $payment->tutor->fullname ?? ' ' }}</td>
                    <td>1</td>
                    <td>{{ getAmount($payment->charge_amount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2">VAT</td>
                    <td>{{ getAmount($payment->vat_amount) ?? '0.00' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><strong>{{ getAmount($payment->charge_amount) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 50%; text-align: left;">
                    VAT Number: 130 5954 26
                </td>
                <td style="width: 50%; text-align: right;">
                    Ref: b71554751157759
                </td>
            </tr>
        </table>


    </div>
</body>

</html>