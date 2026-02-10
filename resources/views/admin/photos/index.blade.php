<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Manage Gallery</title>
    <style>
        body{
            font-family: "TikTok SANS", sans-serif;
            background:#fff;
            margin:0;
            padding:0;
        }

        .container{
            max-width: 1200px;
            margin: 35px auto 40px;
            padding: 0 18px;
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

        /* TITLE INSIDE BOX */
        h2{
            margin:0 0 18px;
            font-size:30px;
            font-weight:600;
        }

        .msg-success{
            background:#eaffea;
            border:1px solid #b8f0b8;
            padding:12px 14px;
            border-radius:12px;
            font-weight:600;
            margin-bottom:16px;
        }

        /* Upload Box */
        .upload-card{
            background:#fff9eb;
            border:2px solid #eadfc6;
            border-radius:18px;
            padding:18px;
            margin-top:10px;
        }

        .upload-title{
            font-size:18px;
            font-weight:600;
            margin-bottom: 14px;
        }

        /* FIX ALIGNMENT */
        .grid{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:18px;
            align-items:start; /* 🔥 FIX */
        }

        label{
            display:block;
            font-size:13px;
            font-weight:600;
            margin-bottom:6px;
        }

        input[type="text"]{
            width:100%;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid #eee;
            font-weight:600;
            background:#fff;
            box-sizing:border-box;
        }

        /* 🔥 FIX FILE INPUT HEIGHT + LOOK */
        input[type="file"]{
            width:100%;
            padding:10px 14px;
            border-radius:12px;
            border:1px solid #eee;
            font-weight:600;
            background:#fff;
            box-sizing:border-box;
            height:44px; /* match text input */
        }

        .help{
            margin-top:8px;
            font-size:12px;
            font-weight:600;
            color:#666;
        }

        .btn-upload{
            margin-top:14px;
            padding:12px 16px;
            border:none;
            border-radius:12px;
            background:#c35f1c;
            color:#fff;
            font-weight:600;
            cursor:pointer;
        }

        .btn-upload:hover{
            opacity:0.95;
        }

        /* Reservation List */
        .list{
            margin-top:22px;
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .reservation-card{
            border:1px solid #eee;
            border-radius:18px;
            padding:18px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            display:flex;
            justify-content:space-between;
            gap:18px;
            background:#fff;
        }

        .left h3{
            margin:0 0 6px;
            font-size:22px;
            font-weight:600;
        }

        .meta{
            font-size:13px;
            color:#333;
            font-weight:600;
            line-height:1.7;
        }

        .muted{
            color:#666;
            font-weight:600;
        }

        .right{
            display:flex;
            align-items:flex-start;
            gap:10px;
        }

        .btn-view{
            padding:10px 14px;
            border-radius:12px;
            border:1px solid #ddd;
            background:#fff;
            font-weight:600;
            cursor:pointer;
        }

        .btn-view:hover{
            border-color:#c35f1c;
        }

        .btn-trash{
            width:44px;
            height:44px;
            border-radius:12px;
            border:1px solid #ffb4b4;
            background:#fff;
            cursor:pointer;
            font-size:18px;
        }

        .btn-trash:hover{
            border-color:#ff4d4d;
        }

        .photos-box{
            display:none;
            margin-top:14px;
            padding-top:14px;
            border-top:1px solid #eee;
        }

        .photos-grid{
            display:grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap:12px;
        }

        .photos-grid img{
            width:100%;
            height:180px;
            object-fit:cover;
            border-radius:14px;
            border:1px solid #eee;
        }

        .empty{
            font-weight:600;
            color:#666;
            padding:8px 0;
        }

        @media(max-width: 900px){
            .grid{grid-template-columns:1fr;}
            .photos-grid{grid-template-columns: repeat(2, minmax(0, 1fr));}
        }
    </style>
</head>

<body>
<div class="container">

    <a class="back-top" href="/admin/dashboard">← Back</a>

    <div class="page-box">
        <h2>Manage Gallery</h2>

        @if(session('success'))
            <div class="msg-success">{{ session('success') }}</div>
        @endif

        {{-- Upload Box --}}
        <div class="upload-card">
            <div class="upload-title">Upload Photos</div>
            <form method="POST" action="/admin/photos/upload" enctype="multipart/form-data">
                @csrf
                <div class="grid">
                    <div>
                        <label>Reservation ID</label>
                        <input type="text" name="reservation_id" placeholder="Enter reservation ID" required>
                        <div class="help">Select one reservation ID to upload photos for the customer's gallery</div>
                    </div>
                    <div>
                        <label>Select Photos</label>
                        <input type="file" name="photos[]" multiple required>
                    </div>
                </div>
                <button class="btn-upload" type="submit">Upload Photos</button>
            </form>
        </div>

        {{-- Showcase Section with Show/Hide Toggle --}}
        <div class="upload-card" style="background: #f0f7ff; border-color: #c6daea; margin-top: 20px;">
            <div class="upload-title" style="display: flex; justify-content: space-between; align-items: center;">
                <span>Manage Homepage Showcase</span>
                <button type="button" class="btn-view" onclick="document.getElementById('showcaseModal').style.display='block'">
                    + Add New Work
                </button>
            </div>
            <div class="help">These photos appear in the "Our Works" section of the homepage.</div>
        </div>

        <div class="page-box" style="margin-top: 20px; border: 2px dashed #c6daea; background: #fafcfe;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="font-size: 18px; font-weight: 600; color: #333; margin: 0;">Current Homepage Portfolio</h3>
                <button type="button" class="btn-view" id="btn-toggle-showcase" onclick="toggleShowcase()">
                    Show Showcase
                </button>
            </div>
            
            <div id="showcase-content" style="display: none;">
                @if(!isset($showcasePhotos) || $showcasePhotos->isEmpty())
                    <div class="empty">No photos are currently displayed on the homepage.</div>
                @else
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px;">
                        @foreach($showcasePhotos as $photo)
                            <div style="position: relative; border-radius: 12px; overflow: hidden; border: 1px solid #ddd; background: #fff;">
                                <img src="{{ asset('storage/' . $photo->path) }}" style="width: 100%; height: 120px; object-fit: cover; display: block;">
                                <form action="/admin/showcase/delete/{{ $photo->id }}" method="POST" 
                                      style="position: absolute; top: 5px; right: 5px;"
                                      onsubmit="return confirm('Remove this from the homepage?');">
                                    @csrf
                                    <button type="submit" style="background: #ff4d4d; color: white; border: none; border-radius: 6px; width: 24px; height: 24px; cursor: pointer; font-weight: bold; font-size: 12px;">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Reservation List --}}
        <div class="list">
            @if(count($reservations) == 0)
                <div class="empty">No reservations found.</div>
            @else
                @foreach($reservations as $r)
                    @php $count = $photoCounts[$r->reservation_id] ?? 0; @endphp
                    <div class="reservation-card" id="res-card-{{ $r->reservation_id }}">
                        <div class="left">
                            <h3>{{ $r->package_name }}</h3>
                            <div class="meta">
                                <div><span class="muted">Customer:</span> {{ $r->fullname }}</div>
                                <div><span class="muted">Email:</span> {{ $r->email }}</div>
                                <div><span class="muted">Reservation ID:</span> {{ $r->reservation_id }}</div>
                                <div><span class="muted">Photos:</span> {{ $count }} photo(s)</div>
                            </div>
                            <div class="photos-box" id="photos-box-{{ $r->reservation_id }}">
                                <div class="photos-grid" id="photos-grid-{{ $r->reservation_id }}"></div>
                            </div>
                        </div>
                        <div class="right">
                            <button class="btn-view" id="btn-view-{{ $r->reservation_id }}" type="button" onclick="togglePhotos({{ $r->reservation_id }})">
                                View Photos
                            </button>
                            <form method="POST" action="/admin/photos/delete/{{ $r->reservation_id }}" onsubmit="return confirm('Delete this reservation and all photos?');">
                                @csrf @method('DELETE')
                                <button class="btn-trash" type="submit">🗑</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


<div id="showcaseModal" style="display:none; position:fixed; z-index:2000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
    <div style="background:white; margin:10% auto; padding:30px; border-radius:18px; width:90%; max-width:450px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
        <h2 style="font-size: 24px;">Upload to Showcase</h2>
        <form action="/admin/showcase/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Select Work (Max 5MB)</label>
            <input type="file" name="showcase_photo" required>
            <div style="display: flex; gap: 10px; margin-top: 25px;">
                <button type="submit" class="btn-upload" style="flex: 2; margin-top: 0;">Upload to Home</button>
                <button type="button" class="btn-view" onclick="document.getElementById('showcaseModal').style.display='none'" style="flex: 1;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>

    function toggleShowcase() {
        const content = document.getElementById('showcase-content');
        const btn = document.getElementById('btn-toggle-showcase');
        if (content.style.display === "none") {
            content.style.display = "block";
            btn.innerText = "Hide Showcase";
        } else {
            content.style.display = "none";
            btn.innerText = "Show Showcase";
        }
    }


    async function togglePhotos(reservationId){
        const box = document.getElementById("photos-box-" + reservationId);
        const grid = document.getElementById("photos-grid-" + reservationId);
        const btn = document.getElementById("btn-view-" + reservationId);

        if(box.style.display === "block"){
            box.style.display = "none";
            btn.innerText = "View Photos";
            return;
        }

        box.style.display = "block";
        btn.innerText = "Hide Photos";

        if(grid.dataset.loaded === "yes"){ return; }

        grid.innerHTML = "<div class='empty'>Loading photos...</div>";

        try{
            const res = await fetch("/admin/photos/list/" + reservationId);
            const photos = await res.json();

            if(!Array.isArray(photos) || photos.length === 0){
                grid.innerHTML = "<div class='empty'>No photos uploaded yet.</div>";
                grid.dataset.loaded = "yes";
                return;
            }

            grid.innerHTML = "";

            photos.forEach(p => {
                
                const wrapper = document.createElement("div");
                wrapper.style.position = "relative";
                wrapper.style.borderRadius = "12px";
                wrapper.style.overflow = "hidden";
                wrapper.style.border = "1px solid #ddd";
                wrapper.style.background = "#fff";

                const img = document.createElement("img");
                img.src = p.url;
                img.style.width = "100%";
                img.style.height = "180px";
                img.style.objectFit = "cover";
                img.style.display = "block";


                const delBtn = document.createElement("button");
                delBtn.innerHTML = "✕";
    
 
                delBtn.style.position = "absolute";
                delBtn.style.top = "5px";
                delBtn.style.right = "5px";
                delBtn.style.background = "#ff4d4d";
                delBtn.style.color = "white";
                delBtn.style.border = "none";
                delBtn.style.borderRadius = "6px";
                delBtn.style.width = "24px";
                delBtn.style.height = "24px";
                delBtn.style.cursor = "pointer";
                delBtn.style.fontWeight = "bold";
                delBtn.style.fontSize = "12px";
                delBtn.style.display = "flex";
                delBtn.style.alignItems = "center";
                delBtn.style.justifyContent = "center";

                delBtn.onclick = function() {
                    if(confirm('Delete this photo permanently?')) {
                        window.location.href = "/admin/photo/delete/" + p.photo_id;
        }
    };

    // 5. Put it all together
    wrapper.appendChild(img);
    wrapper.appendChild(delBtn);
    grid.appendChild(wrapper);
});

            grid.dataset.loaded = "yes";

        }catch(err){
            grid.innerHTML = "<div class='empty'>Failed to load photos.</div>";
        }
    }
</script>

</body>
</html>
