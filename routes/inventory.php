<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\InventoryController;

/*
|--------------------------------------------------------------------------
| Inventory Routes
|--------------------------------------------------------------------------
| These routes handle the Inventory Management module.
|
| Current prefix  : /inventory
| Current name    : inventory.
|
| SUBDOMAIN SETUP (future):
|   Uncomment the domain() line below and wrap the group with it,
|   then set INVENTORY_SUBDOMAIN=inventory.malbaligaleria.com in .env
|
|   Route::domain(config('app.inventory_subdomain', 'localhost'))->group(function () { ... });
|
*/

Route::middleware(['auth', 'verified', 'checkUserStatus', 'role:admin,superuser'])
    ->prefix('/inventory')
    ->name('inventory.')
    ->group(function () {

        // ── Dashboard / Index ────────────────────────────────────────────
        Route::get('/', [InventoryController::class, 'index'])->name('index');

        // ── Assets (Items) CRUD ──────────────────────────────────────────
        Route::prefix('/assets')->name('assets.')->group(function () {
            Route::get('/',           [InventoryController::class, 'index'])->name('index');
            Route::get('/create',     [InventoryController::class, 'create'])->name('create');
            Route::post('/store',     [InventoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit',  [InventoryController::class, 'edit'])->name('edit');
            Route::put('/{id}',       [InventoryController::class, 'update'])->name('update');
            Route::delete('/{id}',    [InventoryController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/history', [InventoryController::class, 'history'])->name('history');
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
