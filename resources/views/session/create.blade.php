<!DOCTYPE html>
<html>
<head>
    <title>Add Session</title>
</head>
<body>

<h2>Add Photoshoot Session</h2>

<form method="POST" action="/admin/sessions">
    @csrf

    <label>Date</label><br>
    <input type="date" name="session_date"><br><br>

    <label>Start Time</label><br>
    <input type="time" name="start_time"><br><br>

    <label>End Time</label><br>
    <input type="time" name="end_time"><br><br>

    <button type="submit">Add Session</button>
</form>

</body>
</html>
