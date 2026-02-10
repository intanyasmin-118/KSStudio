<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Receipt</title>
    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#f6f6f6;
            margin:0;
            padding:0;
        }

        .page{
            max-width:700px;
            margin:30px auto;
            background:#fff;
            border-radius:14px;
            border:1px solid #eee;
            padding:25px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:20px;
            margin-bottom:18px;
        }

        .brand{
            font-size:20px;
            font-weight:600;
            color:#c36b2c;
        }

        .small{
            font-size:12px;
            color:#666;
            line-height:1.5;
        }

        h2{
            margin:0;
            font-size:18px;
        }

        .box{
            border:1px solid #eee;
            border-radius:12px;
            padding:14px;
            margin-top:14px;
        }

        .row{
            display:flex;
            justify-content:space-between;
            padding:7px 0;
            border-bottom:1px dashed #ddd;
            font-size:13px;
        }

        .row:last-child{
            border-bottom:none;
        }

        .row b{
            color:#222;
        }

        .total{
            font-size:16px;
            font-weight:600;
        }

        .actions{
            display:flex;
            gap:12px;
            margin-top:18px;
        }

        .btn{
            flex:1;
            border:none;
            border-radius:12px;
            padding:14px;
            font-weight:600;
            cursor:pointer;
        }

        .btn-print{
            background:#c36b2c;
            color:#fff;
        }

        .btn-back{
            background:#fff;
            border:2px solid #ddd;
        }

        /* PRINT MODE */
        @media print{
            body{
                background:#fff;
            }
            .page{
                box-shadow:none;
                border:none;
                margin:0;
                max-width:100%;
                border-radius:0;
            }
            .actions{
                display:none;
            }
        }
    </style>
</head>
<body>

<div class="page">

    <div class="top">
        <div>
            <div class="brand">📸 KSStudio</div>
            <div class="small">
                Photography Reservation System<br>
                Malaysia
            </div>
        </div>

        <div style="text-align:right;">
            <h2>Payment Receipt</h2>
            <div class="small">
                Reservation ID: <b>{{ $reservation->reservation_id }}</b><br>
                Status: <b>{{ $reservation->reservation_status }}</b>
            </div>
        </div>
    </div>

    <div class="box">
        <h3 style="margin:0 0 10px; font-size:14px;">Customer</h3>

        <div class="row">
            <span>Name</span>
            <b>{{ $customer->fullname ?? '-' }}</b>
        </div>

        <div class="row">
            <span>Email</span>
            <b>{{ $customer->email ?? '-' }}</b>
        </div>
    </div>

    <div class="box">
        <h3 style="margin:0 0 10px; font-size:14px;">Session</h3>

        <div class="row">
            <span>Package</span>
            <b>{{ $package->name ?? '-' }}</b>
        </div>

        <div class="row">
            <span>Date</span>
            <b>{{ $sessionData->session_date ?? '-' }}</b>
        </div>

        <div class="row">
            <span>Time</span>
            <b>
                {{ $sessionData ? $sessionData->start_time . ' - ' . $sessionData->end_time : '-' }}
            </b>
        </div>

        <div class="row">
            <span>Duration</span>
            <b>{{ $package->duration_minutes ?? '-' }} min</b>
        </div>
    </div>

    <div class="box">
        <h3 style="margin:0 0 10px; font-size:14px;">Payment</h3>

        <div class="row">
            <span>Payment Method</span>
            <b>{{ $payment->payment_method ?? '-' }}</b>
        </div>

        <div class="row">
            <span>Payment Status</span>
            <b>{{ $payment->payment_status ?? '-' }}</b>
        </div>

        <div class="row total">
            <span>Total Paid</span>
            <b>RM {{ number_format($payment->amount ?? 0, 2) }}</b>
        </div>
    </div>

    <div class="actions">
        <button class="btn btn-print" onclick="window.print()">Print Receipt</button>

        <form method="GET" action="/user/dashboard" style="flex:1;">
            <button class="btn btn-back" type="submit">Back to Dashboard</button>
        </form>
    </div>

</div>

</body>
</html>
