<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Invoice</title>
    <style>
        body{font-family:"TikTok SANS"; background:#fff; margin:0;}
        .container{max-width:900px; margin:30px auto; padding:0 18px;}
        .card{border:1px solid #eee; border-radius:18px; padding:20px; box-shadow:0 10px 25px rgba(0,0,0,0.06);}
        h2{margin:0 0 10px; font-size:26px; font-weight:600;}
        .row{display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #eee;}
        .row:last-child{border-bottom:none;}
        .label{font-weight:600; color:#333;}
        .value{font-weight:600;}
        .btn{display:inline-block; margin-top:18px; padding:12px 16px; border-radius:12px; text-decoration:none; font-weight:900;}
        .btn-back{border:1px solid #ddd; color:#111;}
        .btn-print{background:#c35f1c; color:#fff; border:none;}
    </style>
</head>
<body>

<div class="container">

    <a class="btn btn-back" href="/admin/payments">← Back</a>

    <div class="card" style="margin-top:16px;">
        <h2>Invoice</h2>

        <div class="row">
            <div class="label">Invoice For Payment ID</div>
            <div class="value">{{ $payment->payment_id }}</div>
        </div>

        <div class="row">
            <div class="label">Customer</div>
            <div class="value">{{ $customer ? $customer->fullname : 'Unknown' }}</div>
        </div>

        <div class="row">
            <div class="label">Email</div>
            <div class="value">{{ $customer ? $customer->email : '-' }}</div>
        </div>

        <div class="row">
            <div class="label">Amount</div>
            <div class="value">RM {{ number_format($payment->amount, 2) }}</div>
        </div>

        <div class="row">
            <div class="label">Issued Date</div>
            <div class="value">{{ now()->format('Y-m-d') }}</div>
        </div>

        <button class="btn btn-print" onclick="window.print()">Print Invoice</button>
    </div>

</div>

</body>
</html>
