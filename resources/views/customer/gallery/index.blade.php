<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>My Gallery</title>

    <style>
        body{
            font-family: 'TikTok SANS', sans-serif;
            background:#ffffff;
            margin:0;
            padding:0;
        }

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

        /* Big box macam package */
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
            margin-bottom: 18px;
            font-weight:600;
        }

        .error-msg{
            background:#ffecec;
            border:1px solid #ffbcbc;
            color:#b00000;
            padding:10px 12px;
            border-radius:12px;
            font-size:13px;
            margin-bottom: 16px;
            font-weight:800;
        }

        /* Gallery list card */
        .gallery-card{
            border:1px solid #eee;
            border-radius:16px;
            padding:18px;
            background:#fff;
            box-shadow: 0 8px 22px rgba(0,0,0,0.05);
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:18px;
            margin-bottom: 16px;
        }

        .gallery-title{
            font-size:24px;
            font-weight:900;
            margin:0;
        }

        .gallery-info{
            margin-top:10px;
            font-size:13px;
            color:#444;
            line-height:1.7;
            font-weight:600;
        }

        .btn-view{
            text-decoration:none;
            display:inline-block;
            padding:12px 16px;
            border-radius:14px;
            border:1px solid #ddd;
            font-weight:600;
            color:#111;
            background:#fff;
            min-width:140px;
            text-align:center;
        }

        .btn-view:hover{
            background:#f7f7f7;
        }

        .empty{
            padding:16px;
            border:1px dashed #ddd;
            border-radius:14px;
            color:#555;
            font-weight:600;
            background:#fafafa;
        }

        @media(max-width: 768px){
            .gallery-card{
                flex-direction:column;
                align-items:flex-start;
            }

            .btn-view{
                width:100%;
            }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- BACK BUTTON OUTSIDE BOX --}}
    <a href="/user/dashboard" class="back-top">← Back</a>

    <div class="page-box">

        <h2 style="font-size:34px">My Gallery</h2>
        <div class="subtitle">
            View and download your photos after the session is completed.
        </div>

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="error-msg">{{ session('error') }}</div>
        @endif

        {{-- EMPTY --}}
        @if($galleries->count() == 0)
            <div class="empty">
                No gallery found yet. Please wait until admin uploads your photos.
            </div>
        @else

            {{-- LIST --}}
            @foreach($galleries as $g)
                <div class="gallery-card">

                    <div>
                        <div class="gallery-title">
                            {{ $g->package_name }}
                        </div>

                        <div class="gallery-info">
                            <div>Session Date: {{ $g->session_date }}</div>
                            <div>{{ $g->total_photos }} photo(s)</div>
                        </div>
                    </div>

                    <div>
                        <a class="btn-view" href="/my-gallery/{{ $g->reservation_id }}">
                            📸 View Gallery
                        </a>
                    </div>

                </div>
            @endforeach

        @endif

    </div>

</div>

</body>
</html>
