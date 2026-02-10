<?php

namespace App\Http\Controllers;

use App\Models\PhotoshootSession;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Store reservation (user books a session)
    public function store(Request $request)
    {
        if (! session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'customer') {
            return redirect('/admin/dashboard');
        }

        $request->validate([
            'session_id' => 'required|exists:photoshoot_sessions,session_id',
            'package_id' => 'required|exists:packages,id',
        ]);

        // get session
        $session = \App\Models\PhotoshootSession::where('session_id', $request->session_id)->firstOrFail();

        // 1) If session already booked, block immediately
        if ($session->status !== 'available') {
            return redirect('/sessions')->with('success', 'This time slot is already booked.');
        }

        // 2) If session already exists in reservation table, block
        $alreadyReserved = \App\Models\Reservation::where('session_id', $session->session_id)->exists();

        if ($alreadyReserved) {
            // sync status
            $session->update(['status' => 'booked']);

            return redirect('/sessions')->with('success', 'This time slot is already booked.');
        }

        $sessionData = \App\Models\PhotoshootSession::where('session_id', $request->session_id)->firstOrFail();

        if ($sessionData->status !== 'available') {
            return redirect('/sessions')->with('success', 'This time slot is already booked.');
        }

        // 3) Create reservation
        $reservation = \App\Models\Reservation::create([
            'user_id' => session('user_id'),
            'session_id' => $session->session_id,
            'package_id' => $request->package_id,
            'reservation_status' => 'pending',
        ]);

        // 4) Lock the slot
        $session->update([
            'status' => 'booked',
        ]);

        return redirect('/reservations/summary/'.$reservation->reservation_id);
    }

    // View reservations for logged in user
    public function index()
    {
        if (! session()->has('user_id')) {
            return redirect('/login');
        }

        $reservations = Reservation::with(['package', 'session'])
            ->where('user_id', session('user_id'))
            // ONLY show bookings that are actually paid or completed
            ->whereIn('reservation_status', ['paid', 'completed'])
            ->get();

        return view('reservation.index', compact('reservations'));
    }

    public function confirm($session_id)
    {
        if (! session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'customer') {
            return redirect('/admin/dashboard');
        }

        $sessionData = \App\Models\PhotoshootSession::where('session_id', $session_id)->firstOrFail();

        // 🔥 BLOCK if already booked
        if ($sessionData->status !== 'available') {
            return redirect('/sessions')->with('success', 'This time slot is already booked. Please choose another.');
        }

        // also block if already exists in reservation table
        // Inside confirm($session_id) in ReservationController.php

        // Inside confirm($session_id) in ReservationController.php
        $exists = \App\Models\Reservation::where('session_id', $session_id)
            ->whereIn('reservation_status', ['paid', 'completed'])
            ->exists();

        if ($exists) {
            return redirect('/sessions')->with('success', 'This time slot is already officially booked.');
        }

        $user = \App\Models\Account::where('user_id', session('user_id'))->first();

        // package chosen earlier
        $packageId = session('selected_package_id');
        $package = \App\Models\Package::find($packageId);

        if (! $package) {
            return redirect('/packages')->with('success', 'Please select a package first.');
        }

        return view('reservation.confirm', compact('user', 'sessionData', 'package'));
    }

    // app/Http/Controllers/ReservationController.php

    public function submit(Request $request)
    {
        if (! session()->has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'session_id' => 'required|exists:photoshoot_sessions,session_id',
        ]);

        // INSTEAD of creating a record, save details to the session
        session([
            'pending_booking' => [
                'user_id' => session('user_id'),
                'session_id' => $request->session_id,
                'package_id' => session('selected_package_id'),
            ],
        ]);

        // Redirect to your payment gateway logic
        return redirect('/payment/process');
    }

    public function paymentSuccess(Request $request)
    {
        // 1. Get the temporary data back from the session
        $data = session('pending_booking');

        if (! $data) {
            return redirect('/sessions')->with('error', 'Session expired. Please try again.');
        }

        // 2. Perform a final check: Is the slot still available?
        $session = PhotoshootSession::where('session_id', $data['session_id'])->first();

        if ($session->status !== 'available') {
            return redirect('/sessions')->with('error', 'Sorry, someone else booked this slot while you were paying.');
        }

        // 3. FINALLY create the record in the database
        Reservation::create([
            'user_id' => $data['user_id'],
            'session_id' => $data['session_id'],
            'package_id' => $data['package_id'],
            'reservation_status' => 'paid', // Set directly to paid
        ]);

        // 4. Officially lock the session slot
        $session->update(['status' => 'booked']);

        // 5. Clean up the session so the "sticky note" is gone
        session()->forget('pending_booking');

        return redirect('/reservations')->with('success', 'Booking confirmed and paid!');
    }
}
