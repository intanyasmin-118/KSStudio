<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Peak Session Time Report</title>
    <style>
        body{font-family: "TikTok SANS", sans-serif; margin:0; background:#fff;}
        .container{max-width:1200px; margin:35px auto 40px; padding:0 18px;}

        .back-top{
            display:inline-block;
            margin:0 0 18px;
            text-decoration:none;
            font-weight:600;
            color:#333;
            font-size:18px;
        }

        .page-box{
            border:1px solid #eee;
            border-radius:18px;
            padding:24px;
            background:#fff;
            box-shadow:0 10px 30px rgba(0,0,0,0.06);
        }

        h2{margin:0; font-size:32px; font-weight:600;}
        .subtitle{margin-top:8px; color:#666; font-size:14px; font-weight:700; margin-bottom:18px;}

        .section{margin-top:18px; border:1px solid #eee; border-radius:18px; padding:18px; box-shadow:0 10px 25px rgba(0,0,0,0.06); background:#fff;}
        .section h3{margin:0 0 12px; font-size:18px; font-weight:600;}

        table{width:100%; border-collapse:collapse;}
        th,td{padding:14px 12px; border-bottom:1px solid #eee; text-align:left;}
        th{font-size:13px; font-weight:600; color:#444;}
    </style>
</head>
<body>

<div class="container">

    <a class="back-top" href="/admin/reports">← Back</a>

    <div class="page-box">

        <h2>Peak Session Time Report</h2>
        <div class="subtitle">Most popular time slots based on customer bookings</div>

        <div class="section">
            <h3>Most Booked Time Slot</h3>

            @if(!$topSlot)
                <p>No data yet.</p>
            @else
                <p style="font-weight:600; font-size:18px;">
                    {{ $topSlot->start_time }} ({{ $topSlot->total_bookings }} bookings)
                </p>
            @endif
        </div>

        <div class="section">
            <h3>Bookings by Time Slot</h3>

            @if($peak->count() == 0)
                <p>No data yet.</p>
            @else
            <table>
                <tr>
                    <th>Start Time</th>
                    <th>Total Bookings</th>
                </tr>

                @foreach($peak as $p)
                <tr>
                    <td style="font-weight:600;">{{ $p->start_time }}</td>
                    <td>{{ $p->total_bookings }}</td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div class="section">
            <h3>Top 5 Packages (Ranking)</h3>

            @if($topPackages->count() == 0)
                <p>No data yet.</p>
            @else
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Package</th>
                    <th>Total Bookings</th>
                </tr>

                @foreach($topPackages as $index => $p)
                <tr>
                    <td style="font-weight:600;">#{{ $index+1 }}</td>
                    <td style="font-weight:600;">{{ $p->name }}</td>
                    <td>{{ $p->total_bookings }}</td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

    </div>

</div>

</body>
</html>
