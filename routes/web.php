<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Admin\TenantController;
use App\Http\Controllers\Backend\Admin\TenantPhotoController;
use App\Http\Controllers\Backend\Admin\EventController;
use App\Http\Controllers\Backend\Admin\EventPhotoController;
use App\Http\Controllers\Backend\StatusUserController;
use App\Http\Controllers\Backend\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Frontend\PromotionPageController;
use App\Http\Controllers\Frontend\LandingPageController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// landing fix

Route::get('/maintenance', function () {
    return view('maintenance');
});
Route::get('/tenant', function () {
    return view('frontend.tenant.index');
})->name('tenant');
Route::get('/event', function () {
    return view('frontend.event.index');
})->name('event');

Route::get('/directory', function () {
    return view('frontend.directory.index');
})->name('directory');


// FRONTEND
Route::name('frontend.')
    ->group(function () {
        Route::controller(LandingPageController::class)->group(function () {
            Route::get('/', 'index')->name('landing');
            Route::get('/tenant/{cat}', 'tenantData');
            Route::get('/find/tenant/{tenant_id}', 'findTenantById');
        });

        Route::controller(PromotionPageController::class)
            ->prefix('/promotion')
            ->name('promotion.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::controller(PromotionPageController::class)
            ->prefix('/promotion')
            ->name('promotion.')
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
