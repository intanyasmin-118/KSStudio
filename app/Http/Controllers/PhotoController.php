<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ShowcasePhoto; 


class PhotoController extends Controller
{
    // Customer: view their photos
    public function myGallery()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'customer') {
            return redirect('/admin/dashboard');
        }

        $userId = session('user_id');

        // list reservations that have photos
        $galleries = \DB::table('reservations')
            ->join('photoshoot_sessions', 'reservations.session_id', '=', 'photoshoot_sessions.session_id')
            ->leftJoin('packages', 'reservations.package_id', '=', 'packages.id')
            ->join('photos', 'reservations.reservation_id', '=', 'photos.reservation_id')
            ->select(
                'reservations.reservation_id',
                \DB::raw('COALESCE(packages.name, "N/A") as package_name'),
                'photoshoot_sessions.session_date',
                \DB::raw('COUNT(photos.photo_id) as total_photos')
            )
            ->where('reservations.user_id', $userId)
            ->groupBy(
                'reservations.reservation_id',
                'packages.name',
                'photoshoot_sessions.session_date'
            )
            ->orderBy('photoshoot_sessions.session_date', 'desc')
            ->get();

        return view('customer.gallery.index', compact('galleries'));
    }

    public function myGalleryShow($reservation_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'customer') {
            return redirect('/admin/dashboard');
        }

        $userId = session('user_id');

        // Security: reservation must belong to customer
        $reservation = \DB::table('reservations')
            ->join('photoshoot_sessions', 'reservations.session_id', '=', 'photoshoot_sessions.session_id')
            ->leftJoin('packages', 'reservations.package_id', '=', 'packages.id')
            ->select(
                'reservations.reservation_id',
                \DB::raw('COALESCE(packages.name, "N/A") as package_name'),
                'photoshoot_sessions.session_date'
            )
            ->where('reservations.reservation_id', $reservation_id)
            ->where('reservations.user_id', $userId)
            ->first();

        if (!$reservation) {
            return redirect('/my-gallery')->with('error', 'Gallery not found.');
        }

        $photos = Photo::where('reservation_id', $reservation_id)
            ->orderBy('photo_id', 'desc')
            ->get();

        return view('customer.gallery.show', compact('reservation', 'photos'));
    }

    public function uploadForm()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('photo.upload');
    }

    public function uploadStore(Request $request)
{
    if (!session()->has('user_id') || session('role') !== 'admin') {
        return redirect('/login');
    }

    $request->validate([
        'reservation_id' => 'required|exists:reservations,reservation_id',
        'photos' => 'required',
        'photos.*' => 'image|mimes:jpg,jpeg,png|max:5120'
    ]);

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // store in storage/app/public/photos
            $path = $file->storeAs('photos', $fileName, 'public');

            Photo::create([
                'reservation_id' => $request->reservation_id,
                'file_name' => $fileName,
                'file_path' => $path
            ]);
        }
        return redirect('/admin/photos')->with('success', 'Photos uploaded successfully!');
    }

    return back()->with('error', 'No photos selected.');
}

    public function adminIndex()
{
    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    if (session('role') !== 'admin') {
        return redirect('/user/dashboard');
    }

    // 1. Existing Logic: Get reservations list
    $reservations = \DB::table('reservations')
        ->join('account', 'reservations.user_id', '=', 'account.user_id')
        ->leftJoin('packages', 'reservations.package_id', '=', 'packages.id')
        ->select(
            'reservations.reservation_id',
            'reservations.user_id',
            'account.fullname',
            'account.email',
            \DB::raw('COALESCE(packages.name, "N/A") as package_name')
        )
        ->orderBy('reservations.reservation_id', 'desc')
        ->get();

    // 2. Existing Logic: Get photo counts per reservation
    $photoCounts = \DB::table('photos')
        ->select('reservation_id', \DB::raw('COUNT(*) as total'))
        ->groupBy('reservation_id')
        ->pluck('total', 'reservation_id');

    // 3. NEW LOGIC: Fetch the showcase photos for the management grid
    $showcasePhotos = \App\Models\ShowcasePhoto::latest()->get();

    // 4. Pass everything to the view
    return view('admin.photos.index', compact('reservations', 'photoCounts', 'showcasePhotos'));
}

    public function adminView($reservation_id)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $photos = Photo::where('reservation_id', $reservation_id)->get();

        return view('admin.photos.view', compact('photos', 'reservation_id'));
    }

    public function adminDeletePhoto($photo_id)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $photo = Photo::findOrFail($photo_id);

        // delete file from storage
        \Illuminate\Support\Facades\Storage::disk('public')->delete($photo->file_path);

        // delete DB record
        $photo->delete();

        return back()->with('success', 'Photo deleted.');
    }

    public function adminListPhotos($reservation_id)
    {
        if (!session()->has('user_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (session('role') !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $photos = \DB::table('photos')
            ->where('reservation_id', $reservation_id)
            ->orderBy('photo_id', 'desc')
            ->get();

        // convert to url
        $result = [];

        foreach ($photos as $p) {
            $result[] = [
                'photo_id' => $p->photo_id,
                'url' => asset('storage/' . $p->file_path),
            ];
        }

        return response()->json($result);
    }

    public function adminUploadShowcase(Request $request)
{
    // Security Check
    if (!session()->has('user_id') || session('role') !== 'admin') {
        return redirect('/login');
    }

    $request->validate([
        'showcase_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        'caption' => 'nullable|string|max:100'
    ]);

    if ($request->hasFile('showcase_photo')) {
        $file = $request->file('showcase_photo');
        
        // Store in storage/app/public/showcase
        $path = $file->store('showcase', 'public');

        // Save to your NEW table
        ShowcasePhoto::create([
            'path' => $path,
            'caption' => $request->caption
        ]);

        return back()->with('success', 'Photo added to homepage showcase!');
    }

    return back()->with('error', 'Upload failed.');
}

public function adminDeleteShowcase($id)
{
    if (session('role') !== 'admin') {
        return redirect('/login');
    }

    $photo = \App\Models\ShowcasePhoto::findOrFail($id);

    // Delete the actual file from storage
    \Illuminate\Support\Facades\Storage::disk('public')->delete($photo->path);

    // Delete the database entry
    $photo->delete();

    return back()->with('success', 'Showcase photo removed!');
}


}
