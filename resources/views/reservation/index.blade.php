<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>My Reservations</title>
    <style>
        body {
            font-family: 'TikTok SANS', sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container{
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 18px;
        }

        /* BACK BUTTON OUTSIDE BOX */
        .topbar{
            display:flex;
            align-items:center;
            gap:14px;
            margin-bottom: 14px;
        }

        .back-btn{
            text-decoration:none;
            font-weight:600;
            color:#111;
            font-size:16px;
        }

        /* BIG BOX */
        .big-card{
            border:1px solid #eee;
            border-radius:18px;
            padding:22px;
            background:#fff;
            box-shadow:0 10px 25px rgba(0,0,0,0.06);
        }

        /* Header inside big box */
        . section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        h2 {
            font-size: 26px;
            font-weight: 600;
            margin: 0;
            color:#111;
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #eee;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        /* Header Styling */
        thead th {
            padding: 18px 24px;
            background: #fcfcfc;
            border-bottom: 2px solid #f0f0f0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #111;
            font-weight: 600;
        }

        /* Row Styling */
        tbody td {
            padding: 20px 24px;
            border-bottom: 1px solid #f9f9f9;
            vertical-align: middle;
        }

        .res-id {
            color: #888;
            font-size: 12px;
            margin-top: 4px;
            display: block;
            font-weight: 600;
        }

        .package-name {
            font-weight: 600;
            color: #111;
            font-size: 16px;
        }

        /* Status Badges */
        .status {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-completed {
            background: #333;
            color: #fff;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-paid{
            background:#fff1c8;
            color:#a65b00;
        }

        /* Time & Date Formatting */
        .date-text {
            font-weight: 600;
            color: #111;
        }

        .time-text {
            color: #666;
            font-size: 13px;
            margin-top: 3px;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
            font-weight: 600;
        }

        @media(max-width: 900px){
            thead th:nth-child(4),
            tbody td:nth-child(4){
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- BACK BUTTON OUTSIDE BOX -->
    <div class="topbar">
        <a href="/user/dashboard" class="back-btn">← Back</a>
    </div>

    <!-- BIG BOX -->
    <div class="big-card">

        <div class="header-section">
            <h2 style="font-size:34px ">My Reservations</h2>
        </div>

        @if($reservations->count() == 0)
            <div class="table-container" style="text-align: center;">
                <p class="empty-state">No reservations found.</p>
            </div>
        @else
            <div class="table-container" style="text-align: center;">
                <table>
                    <thead>
                        <tr>
                            <th style="font-weight: 900;">Package</th>
                            <th style="font-weight: 900;">Date & Time</th>
                            <th style="font-weight: 900;">Status</th>
                            <th style="text-align: center; font-weight: 900;">Reservation ID</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reservations as $r)
                        <tr>
                            <td>
                                <div class="package-name">
                                    {{ $r->package->name ?? 'N/A' }}
                                </div>
                            </td>

                            <td>
                                <div class="date-text">
                                    {{ $r->session->session_date ?? 'N/A' }}
                                </div>
                                <div class="time-text">
                                    {{ $r->session->start_time ?? '-' }} - {{ $r->session->end_time ?? '-' }}
                                </div>
                            </td>

                            <td>
                                @php
                                    $status = strtolower($r->reservation_status ?? 'pending');
                                @endphp

                                @if($status === 'completed')
                                    <span class="status status-completed">COMPLETED</span>
                                @elseif($status === 'paid')
                                    <span class="status status-paid">PAID</span>
                                @else
                                    <span class="status status-pending">{{ strtoupper($status) }}</span>
                                @endif
                            </td>

                            <td>
                                <span class="res-id" style="text-align: center;">#{{ $r->reservation_id }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</div>

</body>
</html>
