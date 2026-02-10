<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Account;
use App\Models\PhotoshootSession;
use App\Models\Package;
use App\Models\Payment;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $status = $request->query('status'); // paid / completed

        $reservationsQuery = Reservation::query()
            ->whereIn('reservation_status', ['paid', 'completed'])
            ->orderBy('reservation_id', 'desc');

        if ($status && in_array($status, ['paid', 'completed'])) {
            $reservationsQuery->where('reservation_status', $status);
        }

        $reservations = $reservationsQuery->get();

        // attach extra display data
        foreach ($reservations as $r) {
            $r->customer = Account::where('user_id', $r->user_id)->first();
            $r->sessionData = PhotoshootSession::where('session_id', $r->session_id)->first();
            $r->packageData = Package::find($r->package_id);
            $r->paymentData = Payment::where('reservation_id', $r->reservation_id)->first();
        }

        return view('admin.reservations.index', compact('reservations', 'status'));
    }

    public function markCompleted($reservation_id)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $reservation = Reservation::where('reservation_id', $reservation_id)->firstOrFail();

        if ($reservation->reservation_status !== 'paid') {
            return redirect('/admin/reservations')->with('success', 'Reservation cannot be completed.');
        }

        $reservation->update([
            'reservation_status' => 'completed'
        ]);

        return redirect('/admin/reservations')->with('success', 'Reservation marked as completed.');
    }

    public function deleteReservation($reservation_id)
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $reservation = Reservation::where('reservation_id', $reservation_id)->firstOrFail();

        // delete reservation (photos will become inaccessible if you already handle cascade / manual delete)
        $reservation->delete();

        return redirect('/admin/reservations')->with('success', 'Reservation deleted successfully.');
    }

    public function deleteCompleted()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        Reservation::where('reservation_status', 'completed')->delete();

        return redirect('/admin/reservations')->with('success', 'All completed reservations have been deleted.');
    }
}
