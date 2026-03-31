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
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\DirectoryController;
use App\Http\Controllers\Frontend\PromotionPageController as PromotionController;
use App\Http\Controllers\Frontend\NewStoreController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\TenantController;
use App\Http\Controllers\Backend\Admin\TenantPhotoController;
use App\Http\Controllers\Backend\Admin\EventController;
use App\Http\Controllers\Backend\Admin\EventPhotoController;
use App\Http\Controllers\Backend\Admin\PromoController;
use App\Http\Controllers\Backend\Admin\ActivityController;
use App\Http\Controllers\Backend\Admin\SettingController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Backend\Tenant\PromoController as TenantPromoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\StatusUserController;

// FRONTEND
Route::controller(LandingPageController::class)->name('frontend.')->group(function () {
    Route::get('/', 'index')->name('landing');
    Route::get('/tenant/{uuid}', 'getTenantDetail')->name('tenant.detail');
    Route::get('/event/{uuid}', 'getEventDetail')->name('event.detail');
});

Route::prefix('/directory')->name('directory.')->name('frontend.')->group(function () {
    Route::get('/', [DirectoryController::class, 'index'])->name('index');
});

Route::prefix('/promotion')->name('promotion.')->name('frontend.')->group(function () {
    Route::get('/', [PromotionController::class, 'index'])->name('index');
});

Route::prefix('/new-store')->name('new-store.')->name('frontend.')->group(function () {
    Route::get('/', [NewStoreController::class, 'index'])->name('index');
});

// ADMIN & SUPERUSER COMMON ROUTES
Route::controller(AdminDashboardController::class)
    ->middleware(['auth', 'verified', 'checkUserStatus', 'role:admin,superuser'])
    ->prefix('/dashboard')
    ->name('admin.')
    ->group(function () {
        // DASHBOARD
        Route::get('/', 'index')->name('dashboard');

        // PROFILE
        Route::controller(ProfileController::class)
            ->prefix('/profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/update', 'update')->name('update');
                Route::post('/change-password', 'updatePassword')->name('password.update');
            });

        // User (RESTRICTED TO SUPERUSER)
        Route::controller(UserController::class)
            ->middleware('superuser')
            ->prefix('/user')
            ->name('user.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}/update', 'update')->name('update');
                Route::put('/{id}/activate', 'activate')->name('activate');
            });

        // CATEGORY
        Route::controller(CategoryController::class)->prefix('/category')
            ->name('category.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{uuid}/edit', 'edit')->name('edit');
                Route::put('/{uuid}/update', 'update')->name('update');
            });

        // TENANT
        Route::controller(TenantController::class)->prefix('/tenant')
            ->name('tenant.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::put('/update/{uuid}', 'update')->name('update');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            });

        // TENANT PHOTO
        Route::controller(TenantPhotoController::class)->prefix('/tenant-photo')
            ->name('tenant.photo.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/bulk-create', 'bulkCreate')->name('bulk.create');
                Route::post('/bulk-store', 'bulkStore')->name('bulk.store');
                Route::post('/store', 'store')->name('store');
                Route::get('/{tenant_id}/edit', 'edit')->name('edit');
                Route::put('/{id}/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

        // EVENT
        Route::controller(EventController::class)->prefix('/event')
            ->name('event.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::put('/update/{uuid}', 'update')->name('update');
            });

        // EVENT PHOTO
        Route::controller(EventPhotoController::class)->prefix('/event-photo')
            ->name('event.photo.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{event_id}/edit', 'edit')->name('edit');
                Route::put('/{id}/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

        // PROMO
        Route::controller(PromoController::class)->prefix('/promo')
            ->name('promo.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::put('/update/{uuid}', 'update')->name('update');
            });

        // Activity (RESTRICTED TO SUPERUSER)
        Route::controller(ActivityController::class)
            ->middleware('superuser')
            ->prefix('/activity')
            ->name('activity.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::delete('/destroy-all', 'destroyAll')->name('destroyAll');
                Route::post('/destroy-selected', 'destroySelected')->name('destroySelected');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

        // Setting (RESTRICTED TO SUPERUSER)
        Route::controller(SettingController::class)
            ->middleware('superuser')
            ->prefix('/setting')
            ->name('setting.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}/update', 'update')->name('update');
                Route::delete('/{id}/destroy', 'destroy')->name('destroy');
            });
    });

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

//LOGIN
//Others default route are handled by Fortify
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
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Route check status user
Route::get('/check-status-user', [StatusUserController::class, 'index'])->name('check-status-user');
