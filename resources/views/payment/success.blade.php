<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Payment Successful</title>
    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#fff;
            margin:0;
            padding:0;
        }

        .wrapper{
            width:100%;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px 15px;
        }

        .card{
            width:520px;
            border-radius:16px;
            border:1px solid #eee;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            padding:28px;
            text-align:center;
        }

        .icon{
            width:70px;
            height:70px;
            border-radius:50%;
            margin:0 auto 12px;
            border:4px solid #c36b2c;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:34px;
            color:#c36b2c;
            font-weight:600;
        }

        h2{
            margin:10px 0 6px;
            font-size:22px;
        }

        .sub{
            color:#666;
            font-size:13px;
            margin-bottom:18px;
        }

        .details{
            margin: 18px 0;
            text-align:left;
            background:#f7f7f7;
            border:1px solid #eee;
            border-radius:12px;
            padding:16px;
        }

        .details h3{
            margin:0 0 12px;
            font-size:15px;
        }

        .row{
            display:flex;
            justify-content:space-between;
            padding:6px 0;
            font-size:13px;
            border-bottom:1px dashed #ddd;
        }

        .row:last-child{
            border-bottom:none;
        }

        .row b{
            color:#333;
        }

        .note{
            margin-top:14px;
            background:#fff6e6;
            border:1px solid #f0d19b;
            border-radius:12px;
            padding:12px;
            font-size:12px;
            color:#7a4a10;
            text-align:left;
        }

        .btn{
            width:100%;
            border:none;
            border-radius:12px;
            padding:14px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            margin-top:12px;
        }

        .btn-primary{
            background:#c36b2c;
            color:#fff;
        }

        .btn-secondary{
            background:#fff;
            border:2px solid #ddd;
            color:#333;
        }

        .footer{
            margin-top:18px;
            font-size:11px;
            color:#888;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="card">

        <div class="icon">✓</div>

        <h2>Reservation & Payment Successful</h2>
        <div class="sub">Your reservation has been confirmed and payment has been received.</div>

        <div class="details">
            <h3>Reservation Details</h3>

            <div class="row">
                <span>Reservation ID:</span>
                <b>{{ $reservation->reservation_id }}</b>
            </div>

            <div class="row">
                <span>Package:</span>
                <b>{{ $package ? $package->name : '-' }}</b>
            </div>

            <div class="row">
                <span>Date:</span>
                <b>{{ $sessionData->session_date ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Time:</span>
                <b>{{ $sessionData ? $sessionData->start_time . ' - ' . $sessionData->end_time : '-' }}</b>
            </div>

            <div class="row">
                <span>Amount Paid:</span>
                <b>RM {{ number_format($amountPaid, 2) }}</b>
            </div>
        </div>

        <div class="note">
            Your reservation is now marked as <b>PAID</b>.<br>
            You will be able to view your photos once the admin uploads them.
        </div>

        <form method="GET" action="/payment/receipt/{{ $reservation->reservation_id }}">
            <button class="btn btn-primary" type="submit">Print Receipt</button>
        </form>

        <form method="GET" action="/user/dashboard">
            <button class="btn btn-secondary" type="submit">Back to Dashboard</button>
        </form>

        <div class="footer">
            Need help? Contact support@photoshoot.com
        </div>

    </div>
</div>

</body>
</html>
