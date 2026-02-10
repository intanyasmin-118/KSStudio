<!DOCTYPE html>
<html>
<head>
    <title>Admin - Payments</title>
</head>
<body>

<h2>Admin Report: Payments</h2>

<p>
    <a href="/admin/reservations">View Reservations Report</a>
</p>

@if($payments->count() == 0)
    <p>No payments found.</p>
@else
    <table border="1" cellpadding="8">
        <tr>
            <th>Payment ID</th>
            <th>Reservation ID</th>
            <th>Amount (RM)</th>
            <th>Method</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>

        @foreach($payments as $p)
        <tr>
            <td>{{ $p->payment_id }}</td>
            <td>{{ $p->reservation_id }}</td>
            <td>{{ $p->amount }}</td>
            <td>{{ $p->payment_method }}</td>
            <td>{{ $p->payment_status }}</td>
            <td>{{ $p->created_at }}</td>
        </tr>
        @endforeach
    </table>
@endif

</body>
</html>
