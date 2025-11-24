<?php

use App\Http\Controllers\AuthController;
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

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('login', ["AuthController::class", 'login'])->name('login');
Route::post('register', ["AuthController::class", 'register'])->name('register');
Route::post('logout', ["AuthController::class", 'logout'])->name('auth.logout');

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
});
