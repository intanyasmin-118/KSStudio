<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Admin - Sessions</title>
    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#ffffff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 1050px;
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

        /* BIG PAGE BOX */
        .page-box{
            border:1px solid #eee;
            border-radius:18px;
            padding:24px;
            background:#fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        /* TOP INSIDE BOX */
        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:14px;
            margin-bottom: 18px;
        }

        h2{
            margin:0;
            font-size:32px;
            font-weight:600;
        }

        .btn{
            text-decoration:none;
            background:#c36b2c;
            color:#fff;
            padding:12px 16px;
            border-radius:14px;
            font-weight:600;
            display:inline-flex;
            align-items:center;
            gap:10px;
        }

        .btn:hover{
            opacity:0.95;
        }

        .success{
            background:#e9f9ee;
            border:1px solid #bfe9cb;
            color:#1b6b2b;
            padding:12px 14px;
            border-radius:12px;
            font-size:13px;
            margin-bottom: 16px;
            font-weight:600;
        }

        table{
            width:100%;
            border-collapse:collapse;
            border:1px solid #eee;
            border-radius:14px;
            overflow:hidden;
            background:#fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        th, td{
            padding:14px 12px;
            text-align:left;
            font-size:13px;
            border-bottom:1px solid #eee;
            vertical-align:middle;
        }

        th{
            background:#f7f7f7;
            font-weight:600;
        }

        .badge{
            padding:6px 10px;
            border-radius:999px;
            font-weight:600;
            font-size:11px;
            display:inline-block;
        }

        .available{
            background:#e9f9ee;
            color:#1b6b2b;
            border:1px solid #bfe9cb;
        }

        .booked{
            background:#2f2a27;
            color:#fff;
        }

        .empty{
            font-weight:600;
            color:#666;
            padding:10px 0;
        }

        /* DELETE BUTTON */
        .btn-delete{
            border:2px solid #ffb3b3;
            background:#fff;
            color:#cc0000;
            padding:9px 12px;
            border-radius:12px;
            font-weight:600;
            cursor:pointer;
        }

        .btn-delete:hover{
            background:#fff2f2;
        }

        .muted{
            color:#aaa;
            font-weight:600;
        }

        @media(max-width: 850px){
            .topbar{
                flex-direction:column;
                align-items:flex-start;
            }
            .btn{
                width:100%;
                justify-content:center;
            }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- BACK BUTTON OUTSIDE BOX (go to create page) --}}
    <a class="back-top" href="/admin/sessions/create">← Back</a>

    <div class="page-box">

        <div class="topbar">
            <h2>Sessions</h2>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($sessions->count() == 0)
            <div class="empty">No sessions created yet.</div>
        @else
            <table>
                <tr>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th style="width:120px;">Actions</th>
                </tr>

                @foreach($sessions as $s)
                <tr>
                    <td style="font-weight:600;">{{ $s->session_date }}</td>
                    <td>{{ $s->start_time }}</td>
                    <td>{{ $s->end_time }}</td>

                    <td>
                        @if($s->status == 'available')
                            <span class="badge available">AVAILABLE</span>
                        @else
                            <span class="badge booked">BOOKED</span>
                        @endif
                    </td>

                    <td>
                        {{-- DELETE ONLY IF AVAILABLE --}}
                        @if($s->status == 'available')
                            <form method="POST"
                                  action="/admin/sessions/{{ $s->session_id }}/delete"
                                  onsubmit="return confirm('Delete this available session? This cannot be undone.');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete" title="Delete Session">
                                    🗑
                                </button>
                            </form>
                        @else
                            <span class="muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        @endif

    </div>

</div>

</body>
</html>
