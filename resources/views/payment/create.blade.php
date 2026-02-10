<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Payment</title>
    <style>
        body {
            font-family: "TikTok SANS", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* BACK BUTTON OUTSIDE BOX */
        .topbar {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .back-btn {
            text-decoration: none;
            font-weight: 600;
            color: #111;
            font-size: 16px;
        }

        /* BIG MAIN BOX */
        .big-card {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 22px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        /* TITLE INSIDE BOX */
        h2 {
            font-size: 30px;
            font-weight: 600;
            margin: 0 0 18px;
        }

        /* Top reservation info */
        .top-info {
            background: #f6f2e8;
            border: 1px solid #eadfc6;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .top-info .item {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #e6e6e6;
            border-radius: 12px;
            padding: 18px;
            background: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .card h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
        }

        .muted {
            color: #444;
            font-size: 14px;
            line-height: 1.7;
            font-weight: 600;
        }

        .highlight {
            border: 2px solid #e1b24a;
            background: #fff9eb;
        }

        /* Payment method section */
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0 12px;
        }

        .methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 14px;
        }

        .method-box {
            border: 2px solid #e6e6e6;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            text-align: center;
            font-weight: 600;
            background: #fff;
            transition: 0.15s;
            user-select: none;
        }

        .method-box:hover {
            border-color: #c36b2c;
        }

        .method-box.active {
            border-color: #c36b2c;
            background: #fff9eb;
        }

        /* Method details box */
        .method-details {
            margin-top: 10px;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 16px;
            background: #fff;
        }

        .details-title {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .qr-box {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .qr-img {
            width: 220px;
            height: 220px;
            object-fit: contain;
            border-radius: 14px;
            border: 1px solid #eee;
            background: #fff;
        }

        /* Form inputs */
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #f7f7f7;
            outline: none;
            font-size: 14px;
            font-weight: 600;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #c36b2c;
            background: #fff;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        /* Pay now button */
        .pay-btn {
            width: 100%;
            border: none;
            border-radius: 14px;
            padding: 16px;
            background: #b55200;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 18px;
        }

        .pay-btn:hover {
            background: #944300;
        }

        /* Message */
        .errors {
            color: red;
            font-size: 13px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        .note {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
            font-weight: 600;
            line-height: 1.6;
        }

        /* Mobile */
        @media(max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- BACK BUTTON OUTSIDE BIG BOX -->
        <div class="topbar">
            <a href="/sessions" class="back-btn">← Back</a>
        </div>

        <!-- BIG MAIN BOX -->
        <div class="big-card">

            <h2>Payment</h2>

            {{-- TOP INFO --}}
            <div class="top-info">
                <div class="item">
                    <b>Reservation ID:</b> <span style="color: #888;">#NEW</span>
                </div>
                <div class="item">
                    <b>Status:</b> <span style="color: #b55200;">WAITING FOR PAYMENT</span>
                </div>
            </div>

            {{-- DETAILS BOXES --}}
            <div class="grid">

                <div class="card">
                    <h3>Session Details</h3>
                    <div class="muted">
                        <b>Package:</b> {{ $packageName }}<br>
                        <b>Duration:</b> {{ $packageDuration }} min
                    </div>
                </div>

                <div class="card highlight">
                    <h3>Schedule</h3>
                    <div class="muted">
                        {{ $sessionData->session_date ?? '-' }}<br>
                        {{ $sessionData->start_time ?? '-' }} - {{ $sessionData->end_time ?? '-' }}
                    </div>
                </div>

                <div class="card">
                    <h3>Customer</h3>
                    <div class="muted">
                        {{ $customer->fullname ?? '-' }}<br>
                        {{ $customer->email ?? '-' }}
                    </div>
                </div>

                <div class="card highlight">
                    <h3>Amount</h3>
                    <div class="muted">
                        RM {{ number_format($packagePrice, 2) }}
                    </div>
                </div>

            </div>

            {{-- PAYMENT FORM --}}
            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/payment">
                @csrf

                {{-- We pass the SESSION ID and PACKAGE ID instead of a Reservation ID --}}
                <input type="hidden" name="session_id" value="{{ $pendingData['session_id'] }}">
                <input type="hidden" name="package_id" value="{{ $pendingData['package_id'] }}">

                <div class="section-title">Select Payment</div>

                {{-- METHOD CARDS --}}
                <div class="methods">
                    <div class="method-box active" id="box-qr" onclick="setMethod('duitnow_qr')">
                        DuitNow QR
                    </div>

                    <div class="method-box" id="box-transfer" onclick="setMethod('bank_transfer')">
                        Bank Transfer
                    </div>
                </div>

                {{-- Hidden select (backend still works) --}}
                {{-- This shows the user what they picked, but they can't click it to change it --}}
                <div style="margin-top: 10px;">
                    <label>Selected Method</label>
                    <div id="method-display"
                        style="padding: 12px; border-radius: 10px; border: 1px solid #ddd; background: #eee; font-weight: 700; color: #555;">
                        DuitNow QR
                    </div>
                </div>

                {{-- This hidden input actually sends the data to your controller --}}
                <input type="hidden" name="payment_method" id="payment_method" value="duitnow_qr">

                {{-- METHOD DETAILS (dynamic) --}}
                <div class="method-details" id="method-details">

                    <!-- Default: QR -->
                    <div id="qr-details">
                        <div class="details-title">Scan this QR to pay KSStudio</div>

                        <div class="qr-box">
                            {{-- IMPORTANT:
                                Put your QR image inside:
                                public/images/ksstudio_qr.png
                            --}}
                            <img class="qr-img" src="{{ asset('images/ksstudio_qr.png') }}" alt="KSStudio QR">
                        </div>

                        <div class="note">
                            After payment, click <b>Continue</b> to confirm.
                        </div>
                    </div>

                    <!-- Bank transfer -->
                    <div id="bank-details" style="display:none;">
                        <div class="details-title">Select Bank</div>

                        <label>Bank Name</label>
                        <select name="bank_name" id="bank_name">
                            <option value="">-- Select Bank --</option>
                            <option value="Bank A">Bank A</option>
                            <option value="Bank B">Bank B</option>
                            <option value="Bank C">Bank C</option>
                        </select>

                        <div class="note">
                            Please transfer to KSStudio account and click <b>Continue</b>.
                        </div>
                    </div>

                </div>

                <div class="section-title" style="margin-top:22px;">Payment Amount</div>

                <div class="row">
                    <div>
                        <label>Amount (RM)</label>
                        <input type="number" step="0.01" name="amount" value="{{ $packagePrice }}" readonly>
                    </div>
                </div>

                <button class="pay-btn" type="submit">Continue</button>
            </form>

        </div>

    </div>

    <script>
        function setMethod(method) {
        // 1. Update the hidden input for the backend
        document.getElementById("payment_method").value = method;

        // 2. Update the "Read Only" display text for the user
        const display = document.getElementById("method-display");
        if (display) {
            display.innerText = (method === 'duitnow_qr') ? "DuitNow QR" : "Bank Transfer";
        }

        // 3. Toggle visual active states
        document.getElementById("box-qr").classList.remove("active");
        document.getElementById("box-transfer").classList.remove("active");

        const qr = document.getElementById("qr-details");
        const bank = document.getElementById("bank-details");

        if (method === "duitnow_qr") {
            document.getElementById("box-qr").classList.add("active");
            qr.style.display = "block";
            bank.style.display = "none";
        } else {
            document.getElementById("box-transfer").classList.add("active");
            qr.style.display = "none";
            bank.style.display = "block";
        }
    }
    </script>

</body>

</html>
