<!DOCTYPE html>
<html>
<head>
    <title>Admin - Reservations</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#ffffff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 1050px;
            margin: 35px auto;
            padding: 0 18px;
        }

        h2{
            margin:0 0 8px;
            font-size:28px;
        }

        .top-links{
            margin: 10px 0 18px;
        }

        .top-links a{
            text-decoration:none;
            font-weight:800;
            color:#c36b2c;
            margin-right: 14px;
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
            border-radius:12px;
            overflow:hidden;
        }

        th, td{
            padding:12px;
            text-align:left;
            font-size:13px;
            border-bottom:1px solid #eee;
        }

        th{
            background:#f7f7f7;
            font-weight:900;
        }

        .badge{
            padding:6px 10px;
            border-radius:999px;
            font-weight:800;
            font-size:12px;
            display:inline-block;
        }

        .paid{
            background:#fff1d9;
            color:#8a4a00;
            border:1px solid #f0d19b;
        }

        .completed{
            background:#e9f9ee;
            color:#1b6b2b;
            border:1px solid #bfe9cb;
        }

        .btn{
            padding:8px 12px;
            border:none;
            border-radius:10px;
            font-weight:800;
            cursor:pointer;
        }

        .btn-complete{
            background:#c36b2c;
            color:white;
        }

        .btn-complete:hover{
            opacity:0.95;
        }

        .muted{
            color:#777;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Admin Report: Reservations</h2>

    <div class="top-links">
        <a href="/admin/dashboard">← Back to Dashboard</a>
        <a href="/admin/payments">View Payments Report</a>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($reservations->count() == 0)

        <p>No reservations found.</p>

    @else

        <table>
            <tr>
                <th>Reservation ID</th>
                <th>User ID</th>
                <th>Session ID</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>

            @foreach($reservations as $r)
            <tr>
                <td>{{ $r->reservation_id }}</td>
                <td>{{ $r->user_id }}</td>
                <td>{{ $r->session_id }}</td>

                <td>
                    @if($r->reservation_status == 'paid')
                        <span class="badge paid">PAID</span>
                    @elseif($r->reservation_status == 'completed')
                        <span class="badge completed">COMPLETED</span>
                    @else
                        <span class="muted">{{ $r->reservation_status }}</span>
                    @endif
                </td>

                <td>{{ $r->created_at }}</td>

                <td>
                    @if($r->reservation_status == 'paid')
                        <form method="POST" action="/admin/reservations/{{ $r->reservation_id }}/complete">
                            @csrf
                            <button type="submit" class="btn btn-complete">
                                Mark Completed
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

</body>
</html>
