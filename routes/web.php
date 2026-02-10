<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Models\Account;
use App\Http\Controllers\AdminDashboardController;
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [AccountController::class, 'showRegisterForm']);
Route::post('/register', [AccountController::class, 'register']);
Route::get('/login', [AccountController::class, 'showLoginForm']);
Route::post('/login', [AccountController::class, 'login']);
Route::get('/logout', [AccountController::class, 'logout']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/admin/register', [AccountController::class, 'showAdminRegisterForm']);
Route::post('/admin/register', [AccountController::class, 'registerAdmin']);
// Customer gallery
Route::get('/my-photos', [PhotoController::class, 'myGallery']);
Route::get('/my-gallery/{reservation_id}', [PhotoController::class, 'myGalleryShow']);

Route::get('/admin/upload-photo', [PhotoController::class, 'uploadForm']);
Route::post('/admin/upload-photo', [PhotoController::class, 'uploadStore']);
Route::get('/profile', [ProfileController::class, 'edit']);
Route::post('/profile', [ProfileController::class, 'update']);
Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages/select/{id}', [PackageController::class, 'select']);
Route::get('/admin/photos', [PhotoController::class, 'adminIndex']);
Route::post('/admin/photos/upload', [PhotoController::class, 'uploadStore']);
Route::get('/admin/photos/list/{reservation_id}', [PhotoController::class, 'adminListPhotos']);
Route::get('/admin/photos/delete/{reservation_id}', [PhotoController::class, 'adminDeleteReservation']);
Route::post('/admin/showcase/upload', [PhotoController::class, 'adminUploadShowcase']);
Route::post('/admin/showcase/delete/{id}', [PhotoController::class, 'adminDeleteShowcase']);

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

Route::get('/user/dashboard', function () {

    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    $user = Account::where('user_id', session('user_id'))->first();

    return view('user.dashboard', compact('user'));
});
/*
|--------------------------------------------------------------------------
| Photoshoot Session Routes (SDD_PD_204)
|--------------------------------------------------------------------------
*/
// ===============================
// ADMIN SESSIONS
// ===============================
Route::get('/admin/sessions', [SessionController::class, 'adminIndex']);
Route::get('/admin/sessions/create', [SessionController::class, 'create']);
Route::post('/admin/sessions/store-multiple', [SessionController::class, 'storeMultiple']);
// ===============================
// CUSTOMER SESSIONS (Calendar Page)
// ===============================
Route::get('/sessions', [SessionController::class, 'index']);
/*
|--------------------------------------------------------------------------
| Optional Root Redirect (Nice UX)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    
    $showcasePhotos = \App\Models\ShowcasePhoto::latest()->get();
    
    return view('home', compact('showcasePhotos'));
});

Route::get('/payment/process', [PaymentController::class, 'create']);
Route::post('/payment', [PaymentController::class, 'store']);

Route::get('/admin/reservations', [ReportController::class, 'reservations']);
Route::get('/admin/payments', [ReportController::class, 'payments']);
// Admin photo management
Route::get('/admin/photos', [PhotoController::class, 'adminIndex']);
Route::get('/admin/photos/{reservation_id}', [PhotoController::class, 'adminView']);
Route::get('/admin/photo/delete/{photo_id}', [PhotoController::class, 'adminDeletePhoto']);

// Admin delete reservation (soft delete)
Route::get('/admin/reservations/delete/{reservation_id}', [AdminReservationController::class, 'deleteReservation']);

// Reservation confirmation
Route::get('/reservations/confirm/{session_id}', [ReservationController::class, 'confirm']);
Route::post('/reservations/submit', [ReservationController::class, 'submit']);
Route::get('/payment/success/{reservation_id}', [PaymentController::class, 'success']);
Route::get('/payment/receipt/{reservation_id}', [PaymentController::class, 'receipt']);
Route::post('/admin/reservations/{reservation_id}/complete', [AdminReservationController::class, 'markCompleted']);

// Manage Reservations
Route::get('/admin/reservations', [AdminReservationController::class, 'index']);
Route::post('/admin/reservations/{reservation_id}/complete', [AdminReservationController::class, 'markCompleted']);
Route::post('/admin/reservations/{reservation_id}/delete', [AdminReservationController::class, 'deleteReservation']);
Route::post('/admin/reservations/delete-completed', [AdminReservationController::class, 'deleteCompleted']);

Route::get('/admin/payments', [PaymentController::class, 'adminIndex']);
Route::get('/admin/payments/{payment_id}/receipt', [PaymentController::class, 'adminReceipt']);
Route::get('/admin/payments/{payment_id}/invoice', [PaymentController::class, 'adminInvoice']);

Route::get('/admin/reports', [ReportController::class, 'index']);
Route::get('/admin/reports/monthly-revenue', [ReportController::class, 'monthlyRevenue']);
Route::get('/admin/reports/package-popularity', [ReportController::class, 'packagePopularity']);
Route::get('/admin/reports/peak-time', [ReportController::class, 'peakSessionTime']);
Route::delete('/admin/sessions/{id}/delete', [SessionController::class, 'delete']);

