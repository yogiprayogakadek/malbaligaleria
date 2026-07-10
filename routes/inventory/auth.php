<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\InventoryAuthController;

/*
|--------------------------------------------------------------------------
| Inventory Subdomain — Auth Routes
|--------------------------------------------------------------------------
| Login / logout for the inventory.malbaligaleria.com subdomain.
| These routes run on the inventory subdomain only.
*/

Route::domain(config('inventory.subdomain'))
    ->name('inventory.')
    ->group(function () {

        // ── Guest-only (redirect to index if already logged in) ──────────
        Route::middleware('guest')->group(function () {
            Route::get('/login',  [InventoryAuthController::class, 'showLogin'])->name('login');
            Route::post('/login', [InventoryAuthController::class, 'login'])->name('login.submit');
        });

        // ── Authenticated ────────────────────────────────────────────────
        Route::middleware('auth')->group(function () {
            Route::post('/logout', [InventoryAuthController::class, 'logout'])->name('logout');

            // Access denied (user logged in but not granted inventory access)
            Route::get('/access-denied', [InventoryAuthController::class, 'accessDenied'])->name('access-denied');

            // IP blocked
            Route::get('/ip-blocked', [InventoryAuthController::class, 'ipBlocked'])->name('ip-blocked');
        });
    });
