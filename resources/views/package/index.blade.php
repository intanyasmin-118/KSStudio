<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Choose Package</title>

    <style>
        body {
            font-family: "TikTok Sans", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Container supaya semua content tengah */
        .container{
            max-width: 950px;
            margin: 35px auto 40px;
            padding: 0 18px;
        }

        /* Back button luar box, tapi dalam container */
        .back-top{
            display:inline-block;
            margin: 0 0 18px 0;
            text-decoration:none;
            color:#111;
            font-weight:600;
            font-size:18px;
        }

        /* BIG BOX UNTUK TITLE + PACKAGE GRID */
        .page-box{
            border:1px solid #eee;
            border-radius:18px;
            padding:24px;
            background:#fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .page-box h2{
            margin:0;
            font-size:32px;
            font-weight:600;
        }

        .subtitle{
            margin-top:8px;
            color:#666;
            font-size:14px;
            margin-bottom: 16px;
        }

        .success-msg {
            background:#e9f9ee;
            border:1px solid #bfe9cb;
            color:#1b6b2b;
            padding:10px 12px;
            border-radius:12px;
            font-size:13px;
            margin-bottom: 16px;
        }

        /* Grid 2 column */
        .package-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        /* Card package */
        .package-card {
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 18px;
            background: #fff;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.06);
        }

        .package-card h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .package-info {
            margin-top: 10px;
            font-size: 13px;
            color: #444;
            line-height: 1.6;
        }

        /* Button full width */
        .btn-select {
            margin-top: 14px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #b55200;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-select:hover {
            background: #944300;
        }

        /* Responsive (mobile jadi 1 column) */
        @media (max-width: 768px) {
            .package-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- BACK BUTTON (OUTSIDE BIG BOX) --}}
    <a href="/user/dashboard" class="back-top">← Back</a>

    {{-- BIG BOX --}}
    <div class="page-box">

        <h2>Choose Your Package</h2>
        <div class="subtitle">Select a package before choosing your session time.</div>

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        {{-- PACKAGE GRID INSIDE BIG BOX --}}
        <div class="package-grid">
            @foreach($packages as $p)
                <div class="package-card">
                    <h3>{{ $p->name }}</h3>

                    <div class="package-info">
                        <div>Duration: {{ $p->duration_minutes }} minutes</div>
                        <div>Price: RM {{ number_format($p->price, 2) }}</div>
                    </div>

                    <a href="/packages/select/{{ $p->id }}" style="text-decoration:none;">
                        <button class="btn-select">Select</button>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

</div>

</body>
</html>
