<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\PhotoshootSession;

class PaymentController extends Controller
{
    // Show payment page
    public function create($reservation_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $reservation = \App\Models\Reservation::findOrFail($reservation_id);

        // Security: only owner (customer) or admin can access
        if (session('role') === 'customer' && $reservation->user_id != session('user_id')) {
            return redirect('/user/dashboard');
        }

        $customer = \App\Models\Account::where('user_id', $reservation->user_id)->first();
        $sessionData = \App\Models\PhotoshootSession::where('session_id', $reservation->session_id)->first();
        $package = \App\Models\Package::find($reservation->package_id);

        // If no package (old reservations), fallback
        $packagePrice = $package ? $package->price : 100;
        $packageDuration = $package ? $package->duration_minutes : 0;
        $packageName = $package ? $package->name : "N/A";

        return view('payment.create', [
            'reservation' => $reservation,
            'customer' => $customer,
            'sessionData' => $sessionData,
            'packageName' => $packageName,
            'packageDuration' => $packageDuration,
            'packagePrice' => $packagePrice
        ]);
    }


    // Store payment
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,reservation_id',
            'payment_method' => 'required|in:duitnow_qr,bank_transfer',
            'amount' => 'required|numeric|min:0'
        ]);

        // if bank transfer -> must choose bank
        if ($request->payment_method === 'bank_transfer') {
            $request->validate([
                'bank_name' => 'required'
            ]);
        }

        $reservation = Reservation::where('reservation_id', $request->reservation_id)->firstOrFail();

        // Security: only owner (customer) or admin can pay
        if (session('role') === 'customer' && $reservation->user_id != session('user_id')) {
            return redirect('/user/dashboard');
        }

        // AUTO RETRIEVE PACKAGE PRICE
        $package = Package::find($reservation->package_id);
        $amount = $package ? $package->price : 100;

        Payment::create([
            'reservation_id' => $reservation->reservation_id,
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'bank_name' => $request->payment_method === 'bank_transfer' ? $request->bank_name : null,
            'payment_status' => 'paid'
        ]);

        // Update reservation status
        $reservation->update([
            'reservation_status' => 'paid'
        ]);

        return redirect('/payment/success/' . $reservation->reservation_id);
    }


    public function success($reservation_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $reservation = \App\Models\Reservation::findOrFail($reservation_id);

        // Security: only owner or admin
        if (session('role') === 'customer' && $reservation->user_id != session('user_id')) {
            return redirect('/user/dashboard');
        }

        $customer = \App\Models\Account::where('user_id', $reservation->user_id)->first();
        $sessionData = \App\Models\PhotoshootSession::where('session_id', $reservation->session_id)->first();
        $package = \App\Models\Package::find($reservation->package_id);

        $amountPaid = $package ? $package->price : 0;

        return view('payment.success', compact(
            'reservation',
            'customer',
            'sessionData',
            'package',
            'amountPaid'
        ));
    }

    public function receipt($reservation_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $reservation = Reservation::where('reservation_id', $reservation_id)->firstOrFail();

        // Security: only owner or admin
        if (session('role') === 'customer' && $reservation->user_id != session('user_id')) {
            return redirect('/user/dashboard');
        }

        $customer = Account::where('user_id', $reservation->user_id)->first();
        $sessionData = PhotoshootSession::where('session_id', $reservation->session_id)->first();
        $package = Package::find($reservation->package_id);

        // get payment record
        $payment = Payment::where('reservation_id', $reservation->reservation_id)
            ->orderBy('payment_id', 'desc')
            ->first();

        return view('payment.receipt', compact(
            'reservation',
            'customer',
            'sessionData',
            'package',
            'payment'
        ));
    }

    public function adminIndex()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'admin') {
            return redirect('/user/dashboard');
        }

        $payments = Payment::orderBy('created_at', 'desc')->get();

        $rows = [];

        foreach ($payments as $p) {

            $reservation = Reservation::where('reservation_id', $p->reservation_id)->first();
            $customer = $reservation ? Account::where('user_id', $reservation->user_id)->first() : null;

            $rows[] = [
                'payment' => $p,
                'reservation' => $reservation,
                'customer' => $customer
            ];
        }

        return view('admin.payments.index', compact('rows'));
    }

    public function adminReceipt($payment_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'admin') {
            return redirect('/user/dashboard');
        }

        $payment = Payment::where('payment_id', $payment_id)->firstOrFail();
        $reservation = Reservation::where('reservation_id', $payment->reservation_id)->first();
        $customer = $reservation ? Account::where('user_id', $reservation->user_id)->first() : null;

        return view('admin.payments.receipt', compact('payment', 'reservation', 'customer'));
    }

    public function adminInvoice($payment_id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        if (session('role') !== 'admin') {
            return redirect('/user/dashboard');
        }

        $payment = Payment::where('payment_id', $payment_id)->firstOrFail();
        $reservation = Reservation::where('reservation_id', $payment->reservation_id)->first();
        $customer = $reservation ? Account::where('user_id', $reservation->user_id)->first() : null;

        return view('admin.payments.invoice', compact('payment', 'reservation', 'customer'));
    }




}
