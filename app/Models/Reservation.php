<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'user_id',
        'session_id',
        'package_id',
        'reservation_status'
    ];

    

public function package()
{
    // A reservation belongs to a package
    return $this->belongsTo(Package::class, 'package_id');
}

public function session()
{
    // A reservation belongs to a photoshoot session
    return $this->belongsTo(PhotoshootSession::class, 'session_id');
}

// app/Http/Controllers/ReservationController.php

public function submit(Request $request)
{
    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    $request->validate([
        'session_id' => 'required|exists:photoshoot_sessions,session_id',
    ]);

    // INSTEAD OF Reservation::create(), save to session
    session([
        'pending_reservation' => [
            'user_id'    => session('user_id'),
            'session_id' => $request->session_id,
            'package_id' => session('selected_package_id'),
        ]
    ]);

    // Redirect to your payment gateway
    // Once payment is successful, your payment controller should run:
    // Reservation::create(session('pending_reservation') + ['reservation_status' => 'paid']);
    
    return redirect('/payment/gateway'); 
}

}
