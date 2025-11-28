<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\StatusUserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// landing fix
Route::get('/', function () {
    return view('landing');
});
Route::get('/maintenance', function () {
    return view('maintenance');
});
Route::get('/tenant', function () {
    return view('frontend.tenant.index');
})->name('tenant');

Route::get('/directory', function () {
    return view('frontend.directory.index');
})->name('directory');


// BACKEND
// ADMIN DASHBOARD
Route::controller(DashboardController::class)->middleware(['auth', 'verified', 'checkUserStatus'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', 'index')->name('tenant.dashboard');
    });
});


//Login Route
//Others default route are handled by Fortify
Route::controller(AuthController::class)->group(function () {
    // Verify Email
    Route::prefix('/email')->middleware('auth')->group(function () {
        Route::get('/verify', 'verifyEmail')->name('verification.notice');
        Route::get('/verify/{id}/{hash}', 'verificationVerify')->middleware('signed')->name('verification.verify');
        Route::post('/verification-notification', 'verificationNotification')->middleware('throttle:6,1')->name('verification.send');
    });
});

// Route check status user
Route::controller(StatusUserController::class)->name('status.')->prefix('/status')->group(function () {
    Route::get('/pending', 'pending')->name('pending');
    Route::get('/rejected', 'rejected')->name('rejected');
})->middleware('auth');


Route::get('/test-email', function () {
    Mail::raw('Email test OK', function ($message) {
        $message->to('info@e-undanganku.my.id')->subject('Email tester');
    });

    return 'Sent!';
});
