<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Analytics Reports</title>

    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#fff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 1200px;
            margin: 35px auto 40px;
            padding: 0 18px;
        }

        /* BACK BUTTON OUTSIDE BOX */
        .back-top{
            display:inline-block;
            margin: 0 0 18px 0;
            text-decoration:none;
            font-weight:600;
            color:#333;
            font-size:18px;
        }

        /* BIG BOX */
        .page-box{
            border:1px solid #eee;
            border-radius:18px;
            padding:24px;
            background:#fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        h2{
            margin:0;
            font-size:34px;
            font-weight:600;
        }

        .subtitle{
            margin-top:8px;
            color:#666;
            font-size:14px;
            font-weight:600;
            margin-bottom: 18px;
        }

        /* GRID */
        .grid{
            display:grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap:18px;
        }

        /* REPORT CARD */
        .card{
            border:1px solid #eee;
            border-radius:18px;
            padding:18px;
            background:#fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);

            /* 🔥 IMPORTANT: standardize button position */
            display:flex;
            flex-direction:column;
            min-height: 210px;
        }

        .card h3{
            margin:0;
            font-size:20px;
            font-weight:600;
        }

        .desc{
            margin-top:10px;
            font-size:13px;
            color:#555;
            font-weight:600;
            line-height:1.6;
            flex:1; /* 🔥 push button to bottom */
        }

        /* STANDARDIZED BUTTON */
        .btn-view{
            margin-top:16px;
            display:inline-block;
            background:#c36b2c;
            color:#fff;
            font-weight:600;
            padding:12px 16px;
            border-radius:14px;
            text-decoration:none;
            width: fit-content;
        }

        .btn-view:hover{
            opacity:0.95;
        }

        @media(max-width: 1000px){
            .grid{
                grid-template-columns: 1fr;
            }
            .card{
                min-height: auto;
            }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- BACK BUTTON OUTSIDE BOX --}}
    <a href="/admin/dashboard" class="back-top">← Back</a>

    <div class="page-box">

        <h2>Analytics Reports</h2>
        <div class="subtitle">
            Monthly revenue, package ranking, and peak session time
        </div>

        <div class="grid">

            {{-- Monthly Revenue --}}
            <div class="card">
                <h3>Monthly Revenue Report</h3>
                <div class="desc">
                    Shows revenue trend per month, total transactions, and top packages.
                </div>

                <a class="btn-view" href="/admin/reports/monthly-revenue">
                    View Report
                </a>
            </div>

            {{-- Package Popularity --}}
            <div class="card">
                <h3>Package Popularity Report</h3>
                <div class="desc">
                    Shows most booked packages and their revenue contribution.
                </div>

                <a class="btn-view" href="/admin/reports/package-popularity">
                    View Report
                </a>
            </div>

            {{-- Peak Time --}}
            <div class="card">
                <h3>Peak Session Time Report</h3>
                <div class="desc">
                    Shows the most popular time slots based on bookings.
                </div>

                <a class="btn-view" href="/admin/reports/peak-time">
                    View Report
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
