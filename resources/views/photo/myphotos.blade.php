<!DOCTYPE html>
<html>
<head>
    <title>My Photos</title>
</head>
<body>

<h2>My Photos</h2>

@if($photos->count() == 0)
    <p>No photos uploaded yet.</p>
@else
    <ul>
        @foreach($photos as $p)
            <li>
                Reservation ID: {{ $p->reservation_id }} <br>
                File: {{ $p->file_name }} <br>
                <a href="{{ asset('storage/' . $p->file_path) }}" target="_blank">
                    View / Download
                </a>
                <hr>
            </li>
        @endforeach
    </ul>
@endif

</body>
</html>
