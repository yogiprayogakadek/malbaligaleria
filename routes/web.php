<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Import controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\StatusUserController;

// LOGIN
// Others default route are handled by Fortify
Route::controller(AuthController::class)->group(function () {
    // Verify Email
    Route::prefix('/email')->middleware('auth')->group(function () {
        Route::get('/verify', 'verifyEmail')->name('verification.notice');
        Route::get('/verify/{id}/{hash}', 'verificationVerify')->middleware('signed')->name('verification.verify');
        Route::post('/verification-notification', 'verificationNotification')->middleware('throttle:6,1')->name('verification.send');
    });
});

// Notifications
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/latest', [NotificationController::class, 'getLatest'])->name('notifications.latest');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Route check status user
Route::get('/check-status-user', [StatusUserController::class, 'index'])->name('check-status-user');

// Include segmented routes
require __DIR__ . '/inventory/auth.php';  // Inventory subdomain — auth (login/logout)
require __DIR__ . '/inventory/web.php';   // Inventory subdomain — protected CRUD
require __DIR__ . '/frontend.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/tenant.php';
