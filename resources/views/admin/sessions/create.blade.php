<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Admin - Create Sessions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        body {
            font-family: "TikTok SANS", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 35px auto 40px;
            padding: 0 18px;
        }

        /* BACK BUTTON OUTSIDE BOX */
        .back-top {
            display: inline-block;
            margin: 0 0 18px 0;
            text-decoration: none;
            font-weight: 600;
            color: #333;
            font-size: 18px;
        }

        /* BIG PAGE BOX */
        .page-box {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 24px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        /* TOP INSIDE BOX */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        h2 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
        }

        .btn-right {
            text-decoration: none;
            background: #c36b2c;
            color: #fff;
            padding: 12px 16px;
            border-radius: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-right:hover {
            opacity: 0.95;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin: 12px 0 6px;
        }

        input {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background: #f3f3f3;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #c36b2c;
            background: #fff;
        }

        /* DATE PICKER INPUT spacing */
        .date-input {
            margin-bottom: 14px;
            /* ruang antara input box & calendar */
        }

        .hint {
            margin-top: 10px;
            font-size: 12px;
            color: #777;
            font-weight: 600;
        }

        .slots-title {
            margin-top: 22px;
            font-size: 15px;
            font-weight: 600;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 14px;
            margin-top: 12px;
            align-items: end;
        }

        /* ruang antara row slots & add button */
        #slots-container {
            margin-bottom: 14px;
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 12px 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-add {
            background: #333;
            color: #fff;
        }

        .btn-add:hover {
            opacity: 0.95;
        }

        .btn-remove {
            background: #fff;
            border: 2px solid #ffb3b3;
            color: #cc0000;
            padding: 10px 12px;
        }

        .btn-remove:hover {
            background: #fff2f2;
        }

        .btn-save {
            width: 100%;
            margin-top: 18px;
            background: #c36b2c;
            color: #fff;
            font-size: 14px;
            padding: 14px;
        }

        .btn-save:hover {
            opacity: 0.95;
        }

        .errors {
            background: #ffecec;
            border: 1px solid #ffb8b8;
            color: #9b1c1c;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        /* Make calendar FULL width ikut container */
        .flatpickr-calendar.inline {
            width: 100% !important;
            max-width: none !important;
        }

        /* Make inner calendar content ikut width */
        .flatpickr-rContainer,
        .flatpickr-days {
            width: 100% !important;
        }

        .dayContainer {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }

        @media(max-width: 700px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-right {
                width: 100%;
                justify-content: center;
            }

            .row {
                grid-template-columns: 1fr;
            }
        }

        /* 1. Make the numbers much larger */
        .flatpickr-day {
            font-size: 20px !important;
            /* Increase this to make numbers bigger */
            font-weight: 600 !important;
            height: 60px !important;
            /* Increase height to keep it square */
            line-height: 60px !important;
            /* Center the number vertically */
            max-width: none !important;
            /* Allow it to grow with the container */
        }

        /* 2. Style the Day names (Mon, Tue, etc.) to match */
        .flatpickr-weekday {
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #333 !important;
        }

        /* 3. Increase the Month and Year size at the top */
        .flatpickr-current-month {
            font-size: 150% !important;
            padding: 10px 0 !important;
        }

        /* 4. Fix the container height so it doesn't look cramped */
        .flatpickr-days {
            width: 100% !important;
            min-height: 350px;
            /* Adjust this if the calendar looks too short */
        }

        /* 5. Highlight the selected date better */
        .flatpickr-day.selected {
            background: #c36b2c !important;
            border-color: #c36b2c !important;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- BACK BUTTON OUTSIDE BOX --}}
        <a class="back-top" href="/admin/reservations">← Back</a>

        @if ($errors->any())
            <div class="errors">
                <b>Please fix the following:</b>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="page-box">

            {{-- TOP INSIDE BOX --}}
            <div class="topbar">
                <h2>Create Photoshoot Sessions</h2>

                {{-- NEW BUTTON (go to sessions page) --}}
                <a href="/admin/sessions" class="btn-right">
                    📅 View Sessions
                </a>
            </div>

            <form method="POST" action="/admin/sessions/store-multiple">
                @csrf

                <label>Select Date</label>

                {{-- Removed "Choose date" placeholder (redundant) --}}
                <input type="text" id="session_date" name="session_date" class="date-input" required>

                <div class="hint">
                    Only dates that you create here will be available for customers in the calendar.
                </div>

                <div class="slots-title">Available Time Slots</div>

                <div id="slots-container">

                    {{-- default 1 slot --}}
                    <div class="row slot-row">
                        <div>
                            <label>Start Time</label>
                            <input type="time" name="slots[0][start_time]" required>
                        </div>

                        <div>
                            <label>End Time</label>
                            <input type="time" name="slots[0][end_time]" required>
                        </div>

                        <div>
                            <button type="button" class="btn btn-remove" onclick="removeSlot(this)">
                                🗑
                            </button>
                        </div>
                    </div>

                </div>

                {{-- Added spacing so it doesn't touch Start Time box --}}
                <button type="button" class="btn btn-add" onclick="addSlot()">
                    + Add Time Slot
                </button>

                <button type="submit" class="btn btn-save">
                    Save Sessions
                </button>

            </form>

        </div>

    </div>

    <script>
        flatpickr("#session_date", {
            inline: true,
            dateFormat: "Y-m-d",
            minDate: "today"
        });

        let slotIndex = 1;

        function addSlot() {
            const container = document.getElementById("slots-container");

            const div = document.createElement("div");
            div.className = "row slot-row";

            div.innerHTML = `
            <div>
                <label>Start Time</label>
                <input type="time" name="slots[${slotIndex}][start_time]" required>
            </div>

            <div>
                <label>End Time</label>
                <input type="time" name="slots[${slotIndex}][end_time]" required>
            </div>

            <div>
                <button type="button" class="btn btn-remove" onclick="removeSlot(this)">
                    🗑
                </button>
            </div>
        `;

            container.appendChild(div);
            slotIndex++;
        }

        function removeSlot(btn) {
            const allSlots = document.querySelectorAll(".slot-row");

            if (allSlots.length <= 1) {
                alert("At least 1 time slot is required.");
                return;
            }

            btn.closest(".slot-row").remove();
        }
    </script>

</body>

</html>
