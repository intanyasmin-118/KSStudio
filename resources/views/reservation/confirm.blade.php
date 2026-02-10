<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Confirm Reservation</title>

    <style>
        body{
            font-family: "TikTok Sans", sans-serif;
            background:#ffffff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 900px;
            margin: 35px auto;
            padding: 0 18px;
        }

        /* BACK OUTSIDE BOX */
        .topbar{
            display:flex;
            align-items:center;
            gap:16px;
            margin-bottom: 18px;
        }

        .back-btn{
            text-decoration:none;
            font-weight:600;
            color:#111;
            font-size:16px;
        }

        /* MAIN BIG BOX */
        .card{
            border:1px solid #eee;
            border-radius:18px;
            padding:22px;
            background:#fff;
            box-shadow:0 10px 25px rgba(0,0,0,0.06);
        }

        .page-title{
            font-size:30px;
            font-weight:600;
            margin:0 0 18px;
        }

        .section{
            border:1px solid #eee;
            border-radius:16px;
            padding:18px;
            margin-bottom:16px;
            background:#fff;
        }

        .section-title{
            font-size:18px;
            font-weight:600;
            margin:0 0 10px;
        }

        .info{
            font-size:14px;
            color:#111;
            line-height:1.8;
            font-weight:600;
        }

        .info b{
            font-weight:600;
        }

        /* BUTTON */
        .btn-payment{
            width:100%;
            border:none;
            border-radius:14px;
            padding:16px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            background:#b55200;
            color:#fff;
            margin-top:10px;
        }

        .btn-payment:hover{
            background:#944300;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- BACK BUTTON OUTSIDE -->
    <div class="topbar">
        <a href="/sessions" class="back-btn">← Back</a>
    </div>

    <!-- BIG BOX -->
    <div class="card">

        <!-- TITLE INSIDE BOX -->
        <div class="page-title">Confirm Reservation</div>

        <!-- CUSTOMER INFO -->
        <div class="section">
            <div class="section-title">Customer Information</div>

            <div class="info">
                <div><b>Full Name:</b> {{ $user->fullname }}</div>
                <div><b>Email Address:</b> {{ $user->email }}</div>
            </div>
        </div>

        <!-- SESSION INFO -->
        <div class="section">
            <div class="section-title">Session Information</div>

            <div class="info">
                <div><b>Package:</b> {{ $package->name }}</div>
                <div><b>Date:</b> {{ $sessionData->session_date }}</div>
                <div><b>Time:</b> {{ $sessionData->start_time }} - {{ $sessionData->end_time }}</div>
                <div><b>Duration:</b> {{ $package->duration_minutes }} minutes</div>
                <div><b>Price:</b> RM {{ number_format($package->price, 2) }}</div>
            </div>
        </div>

        <!-- BUTTON -->
        <form method="POST" action="/reservations/submit">
            @csrf
            <input type="hidden" name="session_id" value="{{ $sessionData->session_id }}">

            <button type="submit" class="btn-payment">
                Continue to Payment
            </button>
        </form>

    </div>

</div>

</body>
</html>
