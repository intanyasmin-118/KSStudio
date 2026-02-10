<!DOCTYPE html>
<html>

<head>
    <title>My Gallery</title>
    <style>
        :root {
            --primary: #c35f1c;
            --dark: #1f1f1f;
            --muted: #6b6b6b;
            --border: #eeeeee;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #fff;
            color: #111;
        }

        .container {
            max-width: 1400px;
            margin: 25px auto;
            padding: 0 18px;
        }

        /* BACK BUTTON (LUAR BOX) */
        .topbar {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .back-btn {
            text-decoration: none;
            font-weight: 900;
            color: #111;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 0;
            /* remove padding */
            border: none;
            /* remove border */
            background: none;
            /* remove background */
        }

        /* BIG BOX */
        .big-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            box-shadow: var(--shadow);
            background: #fff;
        }

        /* TITLE INSIDE BIG BOX */
        .page-title {
            margin: 0;
            font-size: 34px;
            font-weight: 900;
        }

        /* INSIDE SECTION */
        .section {
            margin-top: 18px;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            background: #fff;
        }

        .title {
            font-size: 22px;
            font-weight: 900;
        }

        .meta {
            margin-top: 6px;
            color: var(--muted);
            font-weight: 700;
            font-size: 13px;
            line-height: 1.5;
        }

        /* GRID */
        .grid {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            align-items: start;
        }

        /* PHOTO BOX */
        .photo-box {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            height: auto;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .photo-box img {
            width: 100%;
            height: auto;
            display: block;
            opacity: 1;
        }

        .overlay {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: 0.2s ease;
        }

        .photo-box:hover .overlay {
            opacity: 1;
        }

        .btn {
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 900;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .btn-view {
            background: #fff;
            color: #111;
        }

        .btn-download {
            background: var(--primary);
            color: #fff;
        }

        .empty {
            margin-top: 18px;
            border: 1px dashed #ddd;
            border-radius: 18px;
            padding: 22px;
            color: #444;
            font-weight: 800;
        }

        /* RESPONSIVE */
        @media(max-width: 1000px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 650px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- BACK BUTTON OUTSIDE BIG BOX -->
        <div class="topbar">
            <a class="back-btn" href="/my-photos">← Back</a>
        </div>

        <!-- BIG BOX -->
        <div class="big-card">

            <!-- PAGE TITLE INSIDE BIG BOX -->
            <h2 class="page-title">My Gallery</h2>

            <!-- CONTENT BOX (PACKAGE DETAILS + PHOTOS) -->
            <div class="section">
                <div class="title">{{ $reservation->package_name }}</div>

                <div class="meta">
                    Session Date: {{ $reservation->session_date }} <br>
                    {{ count($photos) }} photo(s)
                </div>

                @if (count($photos) == 0)
                    <div class="empty">
                        No photos found for this session.
                    </div>
                @else
                    <div class="grid">

                        @foreach ($photos as $p)
                            @php
                                $url = asset('storage/' . $p->file_path);
                            @endphp

                            <div class="photo-box">
                                <img src="{{ $url }}" alt="Photo">

                                <div class="overlay">
                                    <a class="btn btn-view" target="_blank" href="{{ $url }}">
                                        👁 View
                                    </a>

                                    <a class="btn btn-download" href="{{ $url }}" download>
                                        ⬇ Download
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif

            </div>

        </div>

    </div>

</body>

</html>