<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Report;


class ReportController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        return view('admin.reports.index');
    }

    // ✅ Report 1: Monthly Revenue
    public function monthlyRevenue()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        Report::create([
            'report_type' => 'Monthly Revenue Report',
            'generated_date' => now()
        ]);

        // Only PAID reservations count as revenue
        $monthly = DB::table('payments')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("SUM(amount) as total_revenue"),
                DB::raw("COUNT(*) as total_transactions")
            )
            ->where('payment_status', 'paid')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $grandTotal = DB::table('payments')
            ->where('payment_status', 'paid')
            ->sum('amount');

        $totalTransactions = DB::table('payments')
            ->where('payment_status', 'paid')
            ->count();

        // Top 5 packages
        $topPackages = DB::table('reservations')
            ->join('packages', 'reservations.package_id', '=', 'packages.id')
            ->join('payments', 'reservations.reservation_id', '=', 'payments.reservation_id')
            ->select(
                'packages.name',
                DB::raw("COUNT(reservations.reservation_id) as total_bookings"),
                DB::raw("SUM(payments.amount) as total_revenue")
            )
            ->where('payments.payment_status', 'paid')
            ->groupBy('packages.name')
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        return view('admin.reports.monthly-revenue', compact(
            'monthly',
            'grandTotal',
            'totalTransactions',
            'topPackages'
        ));
    }

    // ✅ Report 2: Package Popularity
    public function packagePopularity()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        Report::create([
            'report_type' => 'Package Popularity Report',
            'generated_date' => now()
        ]);

        $packages = DB::table('reservations')
            ->join('packages', 'reservations.package_id', '=', 'packages.id')
            ->join('payments', 'reservations.reservation_id', '=', 'payments.reservation_id')
            ->select(
                'packages.name',
                DB::raw("COUNT(reservations.reservation_id) as total_bookings"),
                DB::raw("SUM(payments.amount) as total_revenue")
            )
            ->where('payments.payment_status', 'paid')
            ->groupBy('packages.name')
            ->orderByDesc('total_bookings')
            ->get();

        $totalBookings = $packages->sum('total_bookings');
        $totalRevenue = $packages->sum('total_revenue');

        $topPackages = $packages->take(5);

        return view('admin.reports.package-popularity', compact(
            'packages',
            'totalBookings',
            'totalRevenue',
            'topPackages'
        ));
    }

    // ✅ Report 3: Peak Session Time Report
    public function peakSessionTime()
    {
        if (!session()->has('user_id') || session('role') !== 'admin') {
            return redirect('/login');
        }

        Report::create([
            'report_type' => 'Peak Session Time Report',
            'generated_date' => now()
        ]);

        // Count bookings by start_time
        $peak = DB::table('reservations')
            ->join('photoshoot_sessions', 'reservations.session_id', '=', 'photoshoot_sessions.session_id')
            ->join('payments', 'reservations.reservation_id', '=', 'payments.reservation_id')
            ->select(
                'photoshoot_sessions.start_time',
                DB::raw("COUNT(reservations.reservation_id) as total_bookings")
            )
            ->where('payments.payment_status', 'paid')
            ->groupBy('photoshoot_sessions.start_time')
            ->orderByDesc('total_bookings')
            ->get();

        $topSlot = $peak->first();

        // Top 5 packages also show here (ranking requirement)
        $topPackages = DB::table('reservations')
            ->join('packages', 'reservations.package_id', '=', 'packages.id')
            ->join('payments', 'reservations.reservation_id', '=', 'payments.reservation_id')
            ->select(
                'packages.name',
                DB::raw("COUNT(reservations.reservation_id) as total_bookings")
            )
            ->where('payments.payment_status', 'paid')
            ->groupBy('packages.name')
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        return view('admin.reports.peak-time', compact(
            'peak',
            'topSlot',
            'topPackages'
        ));
    }
}
