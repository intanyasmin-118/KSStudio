<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $totalReservations = Reservation::count();

        $upcomingCount = Reservation::where('reservation_status', 'paid')->count();

        $completedCount = Reservation::where('reservation_status', 'completed')->count();

        $revenue = Payment::where('payment_status', 'paid')->sum('amount');

        return view('admin.dashboard', compact(
            'totalReservations',
            'upcomingCount',
            'completedCount',
            'revenue'
        ));

    }
}
