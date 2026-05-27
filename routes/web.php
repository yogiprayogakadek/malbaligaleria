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
use App\Http\Controllers\Frontend\EventController as FrontendEventController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\TenantController;
use App\Http\Controllers\Backend\Admin\TenantPhotoController;
use App\Http\Controllers\Backend\Admin\EventController;
use App\Http\Controllers\Backend\Admin\EventPhotoController;
use App\Http\Controllers\Backend\Admin\PromoController;
use App\Http\Controllers\Backend\Admin\ActivityController;
use App\Http\Controllers\Backend\Admin\SettingController;
use App\Http\Controllers\Backend\Admin\AnnouncementController;
use App\Http\Controllers\Backend\Admin\JobVacancyController;
use App\Http\Controllers\Backend\Admin\JobApplicationController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FrontendMenuController;
use App\Http\Controllers\Backend\Admin\VisitorController;
use App\Http\Controllers\Backend\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Backend\Tenant\PromoController as TenantPromoController;
use App\Http\Controllers\Backend\Admin\GalleryController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\StatusUserController;
use App\Http\Controllers\Backend\Admin\LogViewerController;
use App\Http\Controllers\Backend\Admin\BackupController;
use App\Http\Controllers\Backend\Admin\MediaCleanupController;
use App\Http\Controllers\Backend\Admin\ImageCompressionController;

// FRONTEND
Route::controller(LandingPageController::class)->name('frontend.')->group(function () {
    Route::get('/', 'index')->name('landing');
    Route::get('/tenant/{uuid}', 'getTenantDetail')->name('tenant.detail');
    Route::get('/event/{uuid}', 'getEventDetail')->name('event.detail');
    Route::get('/find/tenants/{id}', 'findTenantById')->name('find.tenant');
    Route::get('/find/events/{uuid}', 'findEventByUuid')->name('find.event');
    Route::get('/tenants/{floor}/{isNew}', 'tenantData')->name('tenants.data');
});

Route::name('frontend.')->group(function () {
    Route::prefix('/directory')->name('directory.')->group(function () {
        Route::get('/', [DirectoryController::class, 'index'])->name('index');
        Route::get('/category-tenant', [DirectoryController::class, 'getCategoryTenant'])->name('category-tenant');
        Route::get('/tenants', [DirectoryController::class, 'getTenants'])->name('tenants');
    });

    Route::prefix('/promotion')->name('promotion.')->group(function () {
        Route::get('/', [PromotionController::class, 'index'])->name('index');
        Route::get('/load-promotion', [PromotionController::class, 'loadPromotion'])->name('load-promotion');
    });

    Route::prefix('/new-store')->name('new-store.')->group(function () {
        Route::get('/', [NewStoreController::class, 'index'])->name('index');
    });

    Route::prefix('/events')->name('event.')->group(function () {
        Route::get('/', [FrontendEventController::class, 'index'])->name('index');
    });

    Route::prefix('/career')->name('career.')->group(function () {
        Route::get('/', [CareerController::class, 'index'])->name('index');
        Route::get('/{uuid}', [CareerController::class, 'show'])->name('show');
        Route::post('/{uuid}/apply', [CareerController::class, 'apply'])->name('apply');
    });

    Route::prefix('/gallery')->name('gallery.')->group(function () {
        Route::get('/', [FrontendGalleryController::class, 'index'])->name('index');
    });
});

// ADMIN & SUPERUSER COMMON ROUTES
Route::controller(AdminDashboardController::class)
    ->middleware(['auth', 'verified', 'checkUserStatus', 'role:admin,superuser,hr'])
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

        // Restricted to Admin & Superuser Only
        Route::middleware(['role:admin,superuser'])->group(function () {
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
                    Route::put('/{id}/toggle-verify', 'toggleVerify')->name('toggle-verify');
                });

            // Frontend Menu Visibility Management (RESTRICTED TO SUPERUSER)
            Route::controller(FrontendMenuController::class)
                ->middleware('superuser')
                ->prefix('/menu')
                ->name('menu.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::put('/{id}/toggle-active', 'toggleActive')->name('toggle-active');
                });

            // Visitor Logs (RESTRICTED TO SUPERUSER)
            Route::controller(VisitorController::class)
                ->middleware('superuser')
                ->prefix('/visitors')
                ->name('visitors.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{year}/{month}', 'detail')->name('detail');
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

            // GALLERY
            Route::controller(GalleryController::class)->prefix('/gallery')
                ->name('gallery.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                    Route::put('/{id}/toggle-active', 'toggleActive')->name('toggle-active');
                    Route::post('/batch-status', 'batchStatus')->name('batch-status');
                    Route::post('/batch-clear-title', 'batchClearTitle')->name('batch-clear-title');
                    Route::post('/batch-clear-sort', 'batchClearSort')->name('batch-clear-sort');
                    Route::put('/{id}/update-sort', 'updateSort')->name('update-sort');
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

            // Log Viewer (RESTRICTED TO SUPERUSER)
            Route::controller(LogViewerController::class)
                ->middleware('superuser')
                ->prefix('/logs')
                ->name('logs.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::delete('/clear', 'clear')->name('clear');
                });

            // Backup (RESTRICTED TO SUPERUSER)
            Route::controller(BackupController::class)
                ->middleware('superuser')
                ->prefix('/backup')
                ->name('backup.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/run', 'run')->name('run');
                    Route::get('/download/{filename}', 'download')->name('download');
                    Route::delete('/delete/{filename}', 'delete')->name('delete');
                });

            // Media Cleanup (RESTRICTED TO SUPERUSER)
            Route::controller(MediaCleanupController::class)
                ->middleware('superuser')
                ->prefix('/media-cleanup')
                ->name('media-cleanup.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::delete('/destroy', 'destroy')->name('destroy');
                    Route::delete('/destroy-mass', 'destroyMass')->name('destroy-mass');
                });

            // Image Compressor (RESTRICTED TO SUPERUSER)
            Route::controller(ImageCompressionController::class)
                ->middleware('superuser')
                ->prefix('/image-compression')
                ->name('image-compression.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/compress', 'compress')->name('compress');
                    Route::post('/compress-selected', 'compressSelected')->name('compress-selected');
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
                    Route::post('/destroy-selected', 'destroySelected')->name('destroySelected');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                });

            // Announcement (RESTRICTED TO SUPERUSER)
            Route::controller(AnnouncementController::class)
                ->middleware('superuser')
                ->prefix('/announcement')
                ->name('announcement.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::post('/destroy-selected', 'destroySelected')->name('destroySelected');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                });
        });

        // CAREER — ACCESSIBLE BY ADMIN, SUPERUSER, AND HR
        Route::controller(JobVacancyController::class)->prefix('/career/vacancy')->name('career.vacancy.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/update', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });

        Route::controller(JobApplicationController::class)->prefix('/career/application')->name('career.application.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/print', 'print')->name('print');
            Route::put('/{uuid}/status', 'updateStatus')->name('updateStatus');
            Route::get('/{uuid}/download-cv', 'downloadCv')->name('downloadCv');
            Route::post('/{uuid}/review', 'storeReview')->name('storeReview');
        });

        Route::controller(\App\Http\Controllers\Backend\Admin\EmailLogController::class)->prefix('/career/email-logs')->name('career.email-logs.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
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
