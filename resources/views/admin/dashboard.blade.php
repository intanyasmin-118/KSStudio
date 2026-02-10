<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: "TikTok SANS", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .title {
            font-size: 34px;
            font-weight: 600;
            margin: 0;
        }

        .subtitle {
            margin-top: 6px;
            color: #666;
            font-size: 14px;
        }

        .logout {
            text-decoration: none;
            font-weight: 600;
            color: #c36b2c;
            border: 2px solid #eadfc6;
            padding: 10px 14px;
            border-radius: 12px;
        }

        .logout:hover {
            background: #fff9eb;
        }

        /* STATS */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 16px 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        .stat-label {
            font-size: 13px;
            color: #666;
            font-weight: 600;
        }

        .stat-value {
            margin-top: 10px;
            font-size: 34px;
            font-weight: 600;
            color: #111;
        }

        .stat-value.orange {
            color: #c36b2c;
            background: transparent;
        }

        /* BUTTON GRID */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 26px;
        }

        .card {
            border-radius: 16px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
            transition: 0.15s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .dark {
            background: #3f3a36;
            color: #fff;
        }

        .orange {
            background: #c36b2c;
            color: #fff;
        }

        .wide {
            grid-column: 1 / -1;
            height: 140px;
            background: #2f2a27;
            color: #fff;
        }

        /* ICON BESAR */
        .icon {
            font-size: 42px;
            /* bigger */
            margin-bottom: 12px;
        }

        .label {
            font-size: 22px;
            font-weight: 600;
        }

        @media(max-width: 980px) {
            .stats {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 820px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- TOP --}}
        <div class="topbar">
            <div>
                <h1 class="title"> Welcome admin</h1>
                <div class="subtitle">Manage reservations, payments, gallery and reports</div>
            </div>

            <a class="logout" href="/logout">Logout</a>
        </div>

        {{-- STATS --}}
        <div class="stats">

            <div class="stat-card">
                <div class="stat-label">Total Reservations</div>
                <div class="stat-value">{{ $totalReservations }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Upcoming (Paid)</div>
                <div class="stat-value">{{ $upcomingCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ $completedCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Revenue</div>
                <div class="stat-value">RM {{ number_format($revenue, 2) }}</div>
            </div>

        </div>

        {{-- BUTTONS --}}
        <div class="grid">

            <a class="card dark" href="/profile">
                <div class="icon">👤</div>
                <div class="label">Profile</div>
            </a>

            <a class="card orange" href="/admin/reservations">
                <div class="icon">📅</div>
                <div class="label">Reservations</div>
            </a>

            <a class="card dark" href="/admin/payments">
                <div class="icon">💳</div>
                <div class="label">Payments</div>
            </a>

            <a class="card orange" href="/admin/photos">
                <div class="icon">🖼️</div>
                <div class="label">Gallery</div>
            </a>

            <a class="card wide" href="/admin/reports">
                <div class="icon">📄</div>
                <div class="label">Reports</div>
            </a>

        </div>

    </div>

</body>

</html>