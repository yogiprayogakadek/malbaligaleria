<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Admin\ActivityController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Admin\TenantController;
use App\Http\Controllers\Backend\Admin\TenantPhotoController;
use App\Http\Controllers\Backend\Admin\EventController;
use App\Http\Controllers\Backend\Admin\EventPhotoController;
use App\Http\Controllers\Backend\Admin\PromoController;
use App\Http\Controllers\Backend\Admin\SettingController;
use App\Http\Controllers\Backend\StatusUserController;
use App\Http\Controllers\Backend\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Backend\Tenant\PromoController as TenantPromoController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\DiningController;
use App\Http\Controllers\Frontend\DirectoryController;
use App\Http\Controllers\Frontend\EventController as FrontendEventController;
use App\Http\Controllers\Frontend\PromotionPageController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\NewStoreController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

// NOTIFICATIONS
Route::controller(\App\Http\Controllers\Backend\NotificationController::class)
    ->middleware(['auth', 'verified'])
    ->prefix('/notifications')
    ->name('notifications.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/latest', 'getLatest')->name('latest');
        Route::post('/{id}/read', 'markAsRead')->name('read');
        Route::post('/read-all', 'markAllAsRead')->name('readAll');
    });

Route::get('/maintenance', function () {
    return view('maintenance.index');
});

// FRONTEND
Route::name('frontend.')
    ->group(function () {
        Route::controller(LandingPageController::class)->group(function () {
            Route::get('/', 'index')->name('landing');
            Route::get('/tenants/{cat}/{isNew}', 'tenantData');
            Route::get('/find/tenants/{tenant_id}', 'findTenantById');
        });

        Route::controller(PromotionPageController::class)
            ->prefix('/promotion')
            ->name('promotion.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/load-promotion', 'loadPromotion')->name('load.promotion');
            });

        Route::controller(FrontendEventController::class)
            ->prefix('/event')
            ->name('event.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{uuid}', 'detail')->name('detail');
            });

        Route::controller(DirectoryController::class)
            ->prefix('/directory')
            ->name('directory.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/category-tenant', 'getCategoryTenant')->name('get.category');
                Route::get('/tenants', 'getTenants')->name('get.tenants');
            });


        // EXAMPLES
        Route::controller(DiningController::class)
            ->prefix('/dining')
            ->name('dining.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
        Route::controller(NewStoreController::class)
            ->prefix('/new-store')
            ->name('new-store.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
    });

// ADMIN
Route::controller(AdminDashboardController::class)
    ->middleware(['auth', 'verified', 'checkUserStatus', 'role:admin'])
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        // DASHBOARD
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', 'index')->name('dashboard');
        });

        // User
        Route::controller(UserController::class)->prefix('/user')
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
            });

        // TENANT PHOTO
        Route::controller(TenantPhotoController::class)->prefix('/tenant-photo')
            ->name('tenant.photo.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
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

        // Activity
        Route::controller(ActivityController::class)->prefix('/activity')
            ->name('activity.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::delete('/destroy-all', 'destroyAll')->name('destroyAll');
                Route::post('/destroy-selected', 'destroySelected')->name('destroySelected');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

        // Setting
        Route::controller(SettingController::class)->prefix('/setting')
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

// Route check status user
Route::controller(StatusUserController::class)
    ->name('status.')
    ->prefix('/status')
    ->group(function () {
        Route::get('/pending', 'pending')->name('pending');
        Route::get('/rejected', 'rejected')->name('rejected');
    })->middleware('auth');


Route::get('/test-email', function () {
    Mail::raw('Email test OK', function ($message) {
        $message->to('info@e-undanganku.my.id')->subject('Email tester');
    });

    return 'Sent!';
});


Route::get('quote', function () {
    return view('backend.admin.quotation');
});

Route::get('quote-v2', function () {
    return view('quotation_v2');
});
