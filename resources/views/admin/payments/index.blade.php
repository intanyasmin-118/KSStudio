<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Admin - Payments</title>
    <style>
        body{
            font-family: 'TikTok SANS', sans-serif;
            background:#fff;
            margin:0;
            padding:0;
        }

        .container{
            max-width:1200px;
            margin:35px auto 40px;
            padding:0 18px;
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

        /* HEADER INSIDE BOX */
        .header-row{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:16px;
            margin-bottom: 18px;
        }

        h2{
            margin:0;
            font-size:30px;
            font-weight:600;
        }

        .subtitle{
            margin:8px 0 0;
            color:#666;
            font-size:13px;
            font-weight:700;
        }

        /* TABLE CARD INSIDE BOX */
        .table-card{
            margin-top:18px;
            border:1px solid #eee;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,0.06);
            background:#fff;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#fafafa;
        }

        th, td{
            padding:16px 14px;
            text-align:left;
            border-bottom:1px solid #eee;
            vertical-align:middle;
            font-size:14px;
        }

        th{
            font-size:13px;
            color:#444;
            font-weight:600;
        }

        .cust-name{
            font-weight:600;
            margin-bottom:4px;
        }

        .cust-email{
            font-size:12px;
            color:#666;
            font-weight:700;
        }

        .amount{
            font-weight:600;
            font-size:15px;
        }

        .badge{
            display:inline-block;
            padding:6px 10px;
            border-radius:999px;
            font-size:12px;
            font-weight:600;
        }

        .badge-paid{
            background:#fff4d6;
            color:#a95c00;
        }

        .badge-pending{
            background:#eee;
            color:#333;
        }

        .actions{
            display:flex;
            gap:10px;
        }

        .icon-btn{
            width:40px;
            height:40px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            border:1px solid #ddd;
            border-radius:12px;
            background:#fff;
            text-decoration:none;
            font-size:16px;
        }

        .icon-btn:hover{
            border-color:#c36b2c;
        }

        .empty{
            padding:22px;
            font-weight:600;
            color:#666;
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
            <div>
                <h2>Manage Payments</h2>
                <div class="subtitle">
                    View customer payment history and generate receipts/invoices
                </div>
            </div>
        </div>

        {{-- TABLE INSIDE BOX --}}
        <div class="table-card">

            @if(count($rows) == 0)
                <div class="empty">No payment records found.</div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="width:160px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($rows as $row)

                    @php
                        $p = $row['payment'];
                        $c = $row['customer'];

                        $methodLabel = strtoupper($p->payment_method ?? 'N/A');
                    @endphp

                    <tr>
                        <td style="font-weight:750;text-align: center;">
                            {{ $p->payment_id }}
                        </td>

                        <td>
                            <div class="cust-name">
                                {{ $c ? $c->fullname : 'Unknown' }}
                            </div>
                            <div class="cust-email">
                                {{ $c ? $c->email : '-' }}
                            </div>
                        </td>

                        <td class="amount">
                            RM {{ number_format($p->amount, 2) }}
                        </td>

                        <td>
                            {{ $methodLabel }}
                        </td>

                        <td>
                            @if($p->payment_status === 'paid')
                                <span class="badge badge-paid">Completed</span>
                            @else
                                <span class="badge badge-pending">{{ ucfirst($p->payment_status) }}</span>
                            @endif
                        </td>

                        <td>
                            {{ $p->created_at ? $p->created_at->format('Y-m-d') : '-' }}
                        </td>

                        <td>
                            <div class="actions">

                                {{-- 👁 View Receipt --}}
                                <a class="icon-btn" href="/admin/payments/{{ $p->payment_id }}/receipt" title="View Receipt">
                                    👁
                                </a>

                                {{-- 📄 Generate Invoice --}}
                                <a class="icon-btn" href="/admin/payments/{{ $p->payment_id }}/invoice" title="Generate Invoice">
                                    📄
                                </a>

                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            @endif

        </div>

    </div>

</div>
</body>
</html>
