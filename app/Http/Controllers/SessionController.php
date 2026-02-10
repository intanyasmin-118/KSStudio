<?php

namespace App\Http\Controllers;

use App\Models\PhotoshootSession;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Reservation;


class SessionController extends Controller
{
    // ============================
    // CUSTOMER: calendar + timeslots
    // ============================
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        // Only customer allowed
        if (session('role') !== 'customer') {
            return redirect('/admin/dashboard');
        }

        // only show available sessions
        $sessions = PhotoshootSession::where('status', 'available')
            ->orderBy('session_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('session.index', compact('sessions'));
    }


    // ============================
    // ADMIN: create session form
    // ============================
    public function create()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('admin.sessions.create');
    }


    // ============================
    // ADMIN: store multiple sessions
    // ============================
    public function storeMultiple(Request $request)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $request->validate([
            'session_date' => 'required|date',
            'slots' => 'required|array|min:1',
            'slots.*.start_time' => 'required',
            'slots.*.end_time' => 'required',
        ]);

        foreach ($request->slots as $slot) {

            // prevent duplicate same date + same start time
            $exists = PhotoshootSession::where('session_date', $request->session_date)
                ->where('start_time', $slot['start_time'])
                ->exists();

            if ($exists) {
                continue;
            }

            PhotoshootSession::create([
                'session_date' => $request->session_date,
                'start_time' => $slot['start_time'],
                'end_time' => $slot['end_time'],
                'status' => 'available'
            ]);
        }

        return redirect('/admin/sessions')->with('success', 'Sessions added successfully.');
    }


    // ============================
    // ADMIN: list all sessions
    // ============================
    public function adminIndex()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $sessions = PhotoshootSession::orderBy('session_date', 'desc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('admin.sessions.index', compact('sessions'));
    }


    public function delete($id)
    {
        // find session
        $session = PhotoshootSession::findOrFail($id);

        // extra security: only allow delete if available
        if ($session->status !== 'available') {
            return back()->with('success', 'Cannot delete a booked session.');
        }

        // IMPORTANT: prevent delete if already linked to reservation (just in case)
        $hasReservation = Reservation::where('session_id', $session->session_id)->exists();

        if ($hasReservation) {
            return back()->with('success', 'Cannot delete. This session already has a reservation.');
        }

        $session->delete();

        return back()->with('success', 'Session deleted successfully.');
    }

}
