<!DOCTYPE html>
<html>
<head>
    <title>Admin Upload Photo</title>
</head>
<body>

<h2>Admin Upload Photo</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/admin/upload-photo" enctype="multipart/form-data">
    @csrf

    <label>Reservation ID</label><br>
    <input type="number" name="reservation_id" placeholder="Enter reservation id"><br><br>

    <label>Select Photo</label><br>
    <input type="file" name="photo"><br><br>

    <button type="submit">Upload</button>
</form>

<p><a href="/admin/dashboard">Back to Admin Dashboard</a></p>

</body>
</html>
