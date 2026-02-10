<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Customer Dashboard</title>
    <style>
        body {
            font-family: "TikTok Sans", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
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
            margin: 0;
        }

        .subtitle {
            margin-top: 6px;
            color: #666;
            font-size: 14px;
        }

        .logout {
            text-decoration: none;
            font-weight: 800;
            color: #c36b2c;
            border: 2px solid #eadfc6;
            padding: 10px 14px;
            border-radius: 12px;
        }

        .logout:hover {
            background: #fff9eb;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 26px;
            margin-top: 26px;
        }

        .card {
            border-radius: 16px;
            height: 190px;
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

        .icon {
            font-size: 26px;
            margin-bottom: 10px;
        }

        .label {
            font-size: 24px;
            font-family: "TikTok Sans", sans-serif;
            font-weight: 600;
        }

        .user-info {
            margin-top: 8px;
            font-size: 13px;
            color: #666;
        }

        @media(max-width: 820px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        .auth-logo {
            position: absolute;
            top: 30px;
            left: 50px;
            font-size: 1.5rem;
            font-weight: 800;
            text-decoration: none;
            color: #c36b2c;
        }

        .auth-body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <a href="#" class="auth-logo">KSStudio</a>

    <div class="container">

        {{-- TOP --}}
        <div class="topbar">
            <div>
                <h1 class="title"> Welcome, {{ Str::upper($user->fullname) }}</h1>

            </div>

            <a class="logout" href="/logout">Logout</a>
        </div>

        {{-- 4 BUTTONS --}}
        <div class="grid">

            {{-- PROFILE --}}
            <a class="card dark" href="/profile">
                <div class="icon">👤</div>
                <div class="label">Profile</div>
            </a>

            {{-- NEW RESERVATION --}}
            <a class="card orange" href="/packages">
                <div class="icon">📅</div>
                <div class="label">New Reservation</div>
            </a>

            {{-- GALLERY --}}
            <a class="card dark" href="/my-photos">
                <div class="icon">🖼️</div>
                <div class="label">Gallery</div>
            </a>

            {{-- MY RESERVATIONS --}}
            <a class="card orange" href="/reservations">
                <div class="icon">🧾</div>
                <div class="label">My Reservations</div>
            </a>

        </div>

    </div>

</body>

</html>