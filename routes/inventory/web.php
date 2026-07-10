<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\InventoryController;

/*
|--------------------------------------------------------------------------
| Inventory Subdomain — Web Routes
|--------------------------------------------------------------------------
| All protected inventory routes run on inventory.malbaligaleria.com.
|
| Middleware stack (applied in order):
|   auth                  → must be logged in
|   check_inventory_access → must have been granted access by superuser
|   check_inventory_ip    → must come from a whitelisted IP (if list is set)
|
| To make this work locally, add to your hosts file:
|   127.0.0.1  inventory.localhost
| Then set in .env:
|   INVENTORY_SUBDOMAIN=inventory.localhost
*/

Route::domain(config('inventory.subdomain'))
    ->middleware([
        'auth',
        'check_inventory_access',
        'check_inventory_ip',
    ])
    ->name('inventory.')
    ->group(function () {

        // ── Dashboard ────────────────────────────────────────────────────
        Route::get('/', [InventoryController::class, 'index'])->name('index');

        // ── Assets CRUD ──────────────────────────────────────────────────
        Route::prefix('/items')->name('assets.')->group(function () {
            Route::get('/',               [InventoryController::class, 'index'])->name('index');
            Route::get('/print',          [InventoryController::class, 'print'])->name('print');
            Route::get('/create',         [InventoryController::class, 'create'])->name('create');
            Route::post('/store',         [InventoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit',      [InventoryController::class, 'edit'])->name('edit');
            Route::put('/{id}',           [InventoryController::class, 'update'])->name('update');
            Route::delete('/{id}',        [InventoryController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/history',   [InventoryController::class, 'history'])->name('history');
        });

        // ── Categories CRUD ──────────────────────────────────────────────
        Route::prefix('/categories')->name('categories.')->group(function () {
            Route::get('/',           [InventoryController::class, 'categories'])->name('index');
            Route::get('/create',     [InventoryController::class, 'categoryCreate'])->name('create');
            Route::post('/store',     [InventoryController::class, 'categoryStore'])->name('store');
            Route::get('/{id}/edit',  [InventoryController::class, 'categoryEdit'])->name('edit');
            Route::put('/{id}',       [InventoryController::class, 'categoryUpdate'])->name('update');
            Route::delete('/{id}',    [InventoryController::class, 'categoryDestroy'])->name('destroy');
        });
    });
