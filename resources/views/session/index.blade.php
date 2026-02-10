<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Choose Session</title>

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
            max-width: 1050px;
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

        /* MAIN BOX */
        .page-box {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 24px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        /* HEADER INSIDE BOX */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
        }

        h2 {
            font-size: 34px;
            font-weight: 600;
            margin: 0;
        }

        .sub {
            color: #666;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 600;
        }

        /* CARD */
        .card {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 18px;
            background: #fff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* input date (box atas calendar) */
        .date-input {
            width: 100%;
            padding: 14px 14px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background: #f3f3f3;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
            font-weight: 600;
            margin-bottom: 16px;
            /* ruang antara input box dengan calendar */
        }

        /* FLATPICKR FULL WIDTH */
        .flatpickr-calendar {
            width: 100% !important;
            max-width: 100 !important;
        }

        .flatpickr-rContainer {
            width: 100% !important;
        }

        .flatpickr-days {
            width: 100% !important;
        }

        .dayContainer {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }

        /* Bigger month + year */
        .flatpickr-current-month {
            font-size: 18px !important;
            font-weight: 600 !important;
            padding-top: 4px !important;
        }

        .flatpickr-current-month input.cur-year {
            font-size: 18px !important;
            font-weight: 600 !important;
        }

        /* Bigger weekday names */
        .flatpickr-weekdays {
            margin-top: 8px !important;
        }

        .flatpickr-weekday {
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #333 !important;
        }

        /* Bigger day cells (THIS removes empty space) */
        .flatpickr-day {
            max-width: none !important;
            height: 48px !important;
            line-height: 48px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            border-radius: 14px !important;
        }


        /* TIME SLOTS */
        .slots-card {
            margin-top: 18px;
        }

        #time-slots {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .slot-btn {
            width: 100%;
            padding: 14px 12px;
            border-radius: 14px;
            border: 2px solid #eadfc6;
            background: #fff9eb;
            font-weight: 600;
            cursor: pointer;
        }

        .slot-btn:hover {
            border-color: #c36b2c;
        }

        .empty {
            color: #666;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 0;
        }

        @media(max-width: 950px) {
            #time-slots {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 600px) {
            h2 {
                font-size: 28px;
            }

            #time-slots {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- BACK BUTTON OUTSIDE BOX --}}
        <a href="/packages" class="back-top">← Back</a>

        <div class="page-box">

            {{-- HEADER --}}
            <div class="topbar">
                <div>
                    <h2>Available Sessions</h2>
                    <div class="sub">
                        Total sessions loaded: {{ $sessions->count() }}
                    </div>
                </div>
            </div>

            @if($sessions->count() == 0)
                <div class="empty">No session available.</div>
            @else

                {{-- SELECT DATE CARD --}}
                <div class="card">
                    <div class="title">Select Date</div>

                    <input type="text" id="session_date" class="date-input" placeholder="Choose date" readonly>

                    {{-- calendar will render inline --}}
                    <div id="calendar-holder"></div>
                </div>

                {{-- TIME SLOTS CARD (BELOW CALENDAR) --}}
                <div class="card slots-card">
                    <div class="title">Available Time Slots</div>

                    <div id="time-slots" class="empty">
                        Please select a date.
                    </div>
                </div>

            @endif

        </div>

    </div>

    <script>
        const sessions = @json($sessions);

        // Group by date
        const sessionsByDate = {};

        sessions.forEach(s => {
            let dbDate = s.session_date;

            if (dbDate.includes(" ")) dbDate = dbDate.split(" ")[0];
            if (dbDate.includes("T")) dbDate = dbDate.split("T")[0];

            if (!sessionsByDate[dbDate]) {
                sessionsByDate[dbDate] = [];
            }

            sessionsByDate[dbDate].push(s);
        });

        function showTimeSlots(selectedDate) {

            let container = document.getElementById('time-slots');
            container.innerHTML = '';

            let list = sessionsByDate[selectedDate] ?? [];

            // only AVAILABLE
            let filtered = list.filter(s => s.status === "available");

            if (filtered.length === 0) {
                container.innerHTML = '<div class="empty">No sessions available on this date.</div>';
                return;
            }

            // sort by start time
            filtered.sort((a, b) => (a.start_time > b.start_time ? 1 : -1));

            filtered.forEach(session => {

                let link = document.createElement('a');
                link.href = "/reservations/confirm/" + session.session_id;
                link.style.textDecoration = "none";

                let btn = document.createElement('button');
                btn.type = "button";
                btn.className = "slot-btn";
                btn.innerText = session.start_time + " - " + session.end_time;

                link.appendChild(btn);
                container.appendChild(link);
            });
        }

        flatpickr("#session_date", {
            inline: true,
            appendTo: document.getElementById("calendar-holder"),
            dateFormat: "Y-m-d",
            minDate: "today",

            onChange: function (selectedDates, dateStr) {
                showTimeSlots(dateStr);
            }
        });
    </script>

</body>

</html>