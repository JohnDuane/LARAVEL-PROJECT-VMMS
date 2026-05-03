<!DOCTYPE html>
<html>
<head>
    <title>Job Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .section {
            margin-top: 15px;
        }

        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            padding-bottom: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th {
            background: #f2f2f2;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px;
        }

        .no-border td {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total-box {
            margin-top: 10px;
            border: 2px solid #000;
        }

        .total-box td {
            padding: 10px;
            font-size: 14px;
        }

        .signature {
            margin-top: 40px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="container">

    <img src="{{ public_path('images/HEAD-LOGO-DARK.png') }}" alt="BSA Logo" style="width: 130px; height: auto; position: absolute;">


    <div class="header">
        <h1>BSA AUTO REPAIR SHOP</h1>
        <p>Vehicle Maintenance & Repair Services</p>
        <p>Municipality Of Carmen | 09464644220</p>
    </div>

    <!-- JOB INFO -->
    <div class="section">
        <table class="no-border">
            <tr>
                <td><strong>Job Order No:</strong> {{ $job->job_order_id }}</td>
                <td><strong>Date:</strong> {{ $job->date_issued }}</td>
                <td><strong>Status:</strong> {{ $job->status }}</td>
            </tr>
        </table>
    </div>

    <!-- CUSTOMER + VEHICLE -->
    <div class="section">
        <div class="section-title">CUSTOMER & VEHICLE DETAILS</div>
        <table>
            <tr>
                <td><strong>Customer Name</strong></td>
                <td>{{ $view->cust_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Plate Number</strong></td>
                <td>{{ $view->plate_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Mechanic</strong></td>
                <td>{{ $view->mechanic_name ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- SERVICES -->
    <div class="section">
        <div class="section-title">SERVICES</div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td class="text-right">₱{{ number_format($service->price, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-right">No services</td>
                </tr>
                @endforelse

                <tr>
                    <td class="bold">Services Subtotal</td>
                    <td class="text-right bold">₱{{ number_format($services_total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PARTS -->
    <div class="section">
        <div class="section-title">PARTS USED</div>
        <table>
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parts as $part)
                <tr>
                    <td>{{ $part->name }}</td>
                    <td>{{ $part->qty }}</td>
                    <td>₱{{ number_format($part->price, 2) }}</td>
                    <td class="text-right">
                        ₱{{ number_format($part->price * $part->qty, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No parts used/No parts needed</td>
                </tr>
                @endforelse

                <tr>
                    <td colspan="3" class="bold">Parts Subtotal</td>
                    <td class="text-right bold">₱{{ number_format($parts_total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- TOTAL -->
    <div class="section">
        <table class="total-box">
            <tr>
                <td class="bold">TOTAL COST</td>
                <td class="text-right bold">
                    ₱{{ number_format($job->total_cost, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <!-- SIGNATURE -->
<div class="signature">
    <table class="no-border" style="width: 100%; margin-top: 20px;">
        <tr>
            <td style="text-align: center;">
                __________________________<br>
                <strong>Customer Signature</strong><br>
                {{ $view->cust_name ?? 'N/A' }}`
            </td>

            <td style="text-align: center;">
                __________________________<br>
                <strong>Supervisor</strong><br>
                Bernie S. Aranda
            </td>

            <td style="text-align: center;">
                __________________________<br>
                <strong>Mechanic</strong><br>
                {{ $view->mechanic_name ?? 'N/A' }}
            </td>
        </tr>
    </table>
</div>

    <!-- FOOTER -->
    <div class="footer">
        <p>Thank you for choosing BSA Auto Repair Shop</p>
    </div>

</div>

</body>
</html>