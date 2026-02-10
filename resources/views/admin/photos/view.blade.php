<!DOCTYPE html>
<html>
<head>
    <title>View Photos</title>
</head>
<body>

<h2>Photos for Reservation ID: {{ $reservation_id }}</h2>

<p><a href="/admin/photos">Back</a></p>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($photos->count() == 0)
    <p>No photos uploaded for this reservation.</p>
@else
    @foreach($photos as $p)
        <div style="margin-bottom:20px;">
            <p>{{ $p->file_name }}</p>

            <a href="{{ asset('storage/' . $p->file_path) }}" target="_blank">
                View Photo
            </a>

            |
            <a href="/admin/photo/delete/{{ $p->photo_id }}"
               onclick="return confirm('Delete this photo?')">
               Delete Photo
            </a>
        </div>
        <hr>
    @endforeach
@endif

</body>
</html>
