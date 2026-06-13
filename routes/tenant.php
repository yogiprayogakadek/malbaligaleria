<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Backend\Tenant\PromoController as TenantPromoController;

// BACKEND
// TENANT
Route::controller(TenantDashboardController::class)
    ->middleware(['auth', 'verified', 'checkUserStatus', 'role:tenant'])
    ->prefix('/tenant')
    ->name('tenant.')
    ->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', 'index')->name('dashboard');
        });

        // PROMO
        Route::controller(TenantPromoController::class)->prefix('/promo')
            ->name('promo.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::put('/update/{uuid}', 'update')->name('update');
            });
    });
