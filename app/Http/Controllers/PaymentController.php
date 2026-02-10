<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Package;
use App\Models\Payment;
use App\Models\PhotoshootSession;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show payment page
    public function create() // Remove $reservation_id from here
    {
        // 1. Check if user is logged in
        if (! session()->has('user_id')) {
            return redirect('/login');
        }

        // 2. Fetch the temporary booking data from the SESSION
        $pendingData = session('pending_booking');

        if (! $pendingData) {
            return redirect('/sessions')->with('error', 'Booking session expired. Please re-select your slot.');
        }

        // 3. Fetch details based on the IDs stored in the session
        $customer = \App\Models\Account::where('user_id', $pendingData['user_id'])->first();
        $sessionData = \App\Models\PhotoshootSession::where('session_id', $pendingData['session_id'])->first();
        $package = \App\Models\Package::find($pendingData['package_id']);

        // 4. Fallback logic for price/package
        $packagePrice = $package ? $package->price : 100;
        $packageDuration = $package ? $package->duration_minutes : 0;
        $packageName = $package ? $package->name : 'N/A';

        // 5. Return the view.
        // NOTE: We pass 'pendingData' instead of 'reservation' because the DB row isn't made yet.
        return view('payment.create', [
            'pendingData' => $pendingData,
            'customer' => $customer,
            'sessionData' => $sessionData,
            'packageName' => $packageName,
            'packageDuration' => $packageDuration,
            'packagePrice' => $packagePrice,
        ]);
    }

    // Store payment
    public function store(Request $request)
    {
        // 1. VALIDATION
        // Remove 'reservation_id' from validation since we use the session now
        $request->validate([
            'payment_method' => 'required|in:duitnow_qr,bank_transfer',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($request->payment_method === 'bank_transfer') {
            $request->validate([
                'bank_name' => 'required',
            ]);
        }

        // 2. RETRIEVE SESSION DATA
        $data = session('pending_booking');

        if (! $data) {
            return redirect('/sessions')->with('error', 'Booking session expired. Please try again.');
        }

        // 3. FINAL AVAILABILITY CHECK (Crucial!)
        // Make sure no one else booked this while the user was on the payment page
        $session = \App\Models\PhotoshootSession::where('session_id', $data['session_id'])
            ->where('status', 'available')
            ->first();

        if (! $session) {
            return redirect('/sessions')->with('error', 'Sorry, this slot was just taken by someone else.');
        }

        // 4. CREATE RESERVATION (Only now does it hit the database)
        $reservation = \App\Models\Reservation::create([
            'user_id' => session('user_id'),
            'session_id' => $data['session_id'],
            'package_id' => $data['package_id'],
            'reservation_status' => 'paid', // Set directly to paid
        ]);

        // 5. CREATE PAYMENT RECORD (Using your original logic)
        \App\Models\Payment::create([
            'reservation_id' => $reservation->reservation_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
        ]);

        // 6. UPDATE SESSION STATUS
        $session->update(['status' => 'booked']);

        // 7. CLEANUP
        session()->forget('pending_booking');

        // 8. REDIRECT
        return redirect('/payment/success/'.$reservation->reservation_id);
    }

    public function success($reservation_id)
    {
        if (! session()->has('user_id')) {
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
        if (! session()->has('user_id')) {
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
        if (! session()->has('user_id')) {
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
                'customer' => $customer,
            ];
        }

        return view('admin.payments.index', compact('rows'));
    }

    public function adminReceipt($payment_id)
    {
        if (! session()->has('user_id')) {
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
        if (! session()->has('user_id')) {
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
