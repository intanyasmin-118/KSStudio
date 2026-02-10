<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Admin - Manage Reservations</title>
    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#ffffff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 1150px;
            margin: 35px auto;
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

        /* HEADER ROW INSIDE BOX */
        .header-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            margin-bottom: 18px;
        }

        h2{
            margin:0;
            font-size:28px;
            font-weight:600;
        }

        .btn-create{
            text-decoration:none;
            background:#c36b2c;
            color:#fff;
            padding:10px 14px;
            border-radius:12px;
            font-weight:600;
            display:inline-flex;
            gap:8px;
            align-items:center;
        }

        .btn-create:hover{
            opacity:0.95;
        }

        /* TOOLBAR INSIDE BOX */
        .toolbar{
            border:1px solid #eee;
            border-radius:14px;
            padding:14px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            background:#fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            margin-bottom: 18px;
            flex-wrap:wrap;
        }

        .filter{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:13px;
            color:#444;
            font-weight:800;
            flex-wrap:wrap;
        }

        select{
            padding:8px 10px;
            border-radius:10px;
            border:1px solid #ddd;
            background:#f7f7f7;
            font-weight:600;
        }

        .count{
            font-weight:600;
            color:#666;
            margin-left:10px;
        }

        .btn-delete-all{
            border:2px solid #ffb3b3;
            background:#fff;
            color:#cc0000;
            padding:10px 14px;
            border-radius:12px;
            font-weight:600;
            cursor:pointer;
        }

        .btn-delete-all:hover{
            background:#fff2f2;
        }

        .success{
            background:#e9f9ee;
            border:1px solid #bfe9cb;
            color:#1b6b2b;
            padding:10px 12px;
            border-radius:12px;
            font-size:13px;
            margin-bottom: 15px;
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
            vertical-align:top;
        }

        th{
            background:#f7f7f7;
            font-weight:600;
        }

        .sub{
            font-size:12px;
            color:#777;
            margin-top:3px;
        }

        .badge{
            padding:6px 10px;
            border-radius:999px;
            font-weight:600;
            font-size:11px;
            display:inline-block;
        }

        .paid{
            background:#fff1d9;
            color:#8a4a00;
            border:1px solid #f0d19b;
        }

        .completed{
            background:#2f2a27;
            color:#fff;
        }

        .price{
            font-weight:600;
        }

        .actions{
            display:flex;
            gap:10px;
        }

        .btn{
            border:none;
            border-radius:10px;
            padding:9px 12px;
            cursor:pointer;
            font-weight:600;
        }

        .btn-complete{
            background:#c36b2c;
            color:#fff;
        }

        .btn-complete:hover{
            opacity:0.95;
        }

        .btn-delete{
            background:#fff;
            border:2px solid #ffb3b3;
            color:#cc0000;
        }

        .btn-delete:hover{
            background:#fff2f2;
        }

        @media(max-width: 900px){
            .header-row{
                flex-direction:column;
                align-items:flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- BACK BUTTON OUTSIDE BOX --}}
    <a class="back-top" href="/admin/dashboard">← Back</a>

    {{-- BIG BOX --}}
    <div class="page-box">

        {{-- HEADER INSIDE BOX --}}
        <div class="header-row">
            <h2>Manage Reservations</h2>

            <a class="btn-create" href="/admin/sessions/create">
                <span style="font-size:18px;">＋</span> Create Session
            </a>
        </div>

        {{-- SUCCESS MESSAGE INSIDE BOX --}}
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        {{-- TOOLBAR INSIDE BOX --}}
        <div class="toolbar">
            <form method="GET" action="/admin/reservations" class="filter">
                Filter by Status:
                <select name="status" onchange="this.form.submit()">
                    <option value="" {{ $status == null ? 'selected' : '' }}>All</option>
                    <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>

                <span class="count">({{ $reservations->count() }} reservations)</span>
            </form>

            <form method="POST" action="/admin/reservations/delete-completed">
                @csrf
                <button type="submit" class="btn-delete-all">
                    🗑 Delete All Completed Sessions
                </button>
            </form>
        </div>

        {{-- TABLE INSIDE BOX --}}
        @if($reservations->count() == 0)
            <p>No reservations found.</p>
        @else
            <table>
                <tr>
                    <th>Customer</th>
                    <th>Session</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th style="text-align:center">Actions</th>
                </tr>

                @foreach($reservations as $r)
                <tr>
                    <td>
                        <b>{{ $r->customer->fullname ?? 'N/A' }}</b>
                        <div class="sub">{{ $r->customer->email ?? '' }}</div>
                    </td>

                    <td>
                        <b>{{ $r->packageData->name ?? 'N/A' }}</b>
                        <div class="sub">
                            Session ID: {{ $r->session_id }}
                        </div>
                    </td>

                    <td>
                        <b>{{ $r->sessionData->session_date ?? '-' }}</b>
                        <div class="sub">
                            {{ $r->sessionData ? $r->sessionData->start_time : '-' }}
                        </div>
                    </td>

                    <td>
                        @if($r->reservation_status == 'paid')
                            <span class="badge paid">PAID</span>
                        @else
                            <span class="badge completed">COMPLETED</span>
                        @endif
                    </td>

                    <td>
                        <div class="actions">

                            {{-- Mark completed only if PAID --}}
                            @if($r->reservation_status == 'paid')
                                <form method="POST" action="/admin/reservations/{{ $r->reservation_id }}/complete">
                                    @csrf
                                    <button class="btn btn-complete" type="submit">
                                        Mark Completed
                                    </button>
                                </form>
                            @endif

                            {{-- Delete --}}
                            <form method="POST" action="/admin/reservations/{{ $r->reservation_id }}/delete">
                                @csrf
                                <button class="btn btn-delete" type="submit">
                                    🗑
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach
            </table>
        @endif

    </div>

</div>

</body>
</html>
