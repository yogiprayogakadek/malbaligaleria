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
use App\Http\Controllers\Backend\Admin\RolePermissionController;
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
        Route::get('/', 'index')->name('dashboard')->middleware('permission:view dashboard');

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
                    Route::get('/', 'index')->name('index')->middleware('permission:view category tenants');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create category tenants');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create category tenants');
                    Route::get('/{uuid}/edit', 'edit')->name('edit')->middleware('permission:edit category tenants');
                    Route::put('/{uuid}/update', 'update')->name('update')->middleware('permission:edit category tenants');
                });

            // TENANT
            Route::controller(TenantController::class)->prefix('/tenant')
                ->name('tenant.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view tenants');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create tenants');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create tenants');
                    Route::get('/edit/{uuid}', 'edit')->name('edit')->middleware('permission:edit tenants');
                    Route::put('/update/{uuid}', 'update')->name('update')->middleware('permission:edit tenants');
                    Route::delete('/destroy/{uuid}', 'destroy')->name('destroy')->middleware('permission:delete tenants');
                });

            // TENANT PHOTO
            Route::controller(TenantPhotoController::class)->prefix('/tenant-photo')
                ->name('tenant.photo.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view tenants');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create tenants');
                    Route::get('/bulk-create', 'bulkCreate')->name('bulk.create')->middleware('permission:create tenants');
                    Route::post('/bulk-store', 'bulkStore')->name('bulk.store')->middleware('permission:create tenants');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create tenants');
                    Route::get('/{tenant_id}/edit', 'edit')->name('edit')->middleware('permission:edit tenants');
                    Route::put('/{id}/update', 'update')->name('update')->middleware('permission:edit tenants');
                    Route::delete('/delete/{id}', 'delete')->name('delete')->middleware('permission:delete tenants');
                });

            // EVENT
            Route::controller(EventController::class)->prefix('/event')
                ->name('event.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view events');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create events');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create events');
                    Route::get('/edit/{uuid}', 'edit')->name('edit')->middleware('permission:edit events');
                    Route::put('/update/{uuid}', 'update')->name('update')->middleware('permission:edit events');
                });

            // EVENT PHOTO
            Route::controller(EventPhotoController::class)->prefix('/event-photo')
                ->name('event.photo.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view events');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create events');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create events');
                    Route::get('/{event_id}/edit', 'edit')->name('edit')->middleware('permission:edit events');
                    Route::put('/{id}/update', 'update')->name('update')->middleware('permission:edit events');
                    Route::delete('/delete/{id}', 'delete')->name('delete')->middleware('permission:delete events');
                });

            // GALLERY
            Route::controller(GalleryController::class)->prefix('/gallery')
                ->name('gallery.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view gallery');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create gallery');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create gallery');
                    Route::get('/{id}/edit', 'edit')->name('edit')->middleware('permission:edit gallery');
                    Route::put('/{id}/update', 'update')->name('update')->middleware('permission:edit gallery');
                    Route::delete('/delete/{id}', 'delete')->name('delete')->middleware('permission:delete gallery');
                    Route::put('/{id}/toggle-active', 'toggleActive')->name('toggle-active')->middleware('permission:edit gallery');
                    Route::post('/batch-status', 'batchStatus')->name('batch-status')->middleware('permission:edit gallery');
                    Route::post('/batch-clear-title', 'batchClearTitle')->name('batch-clear-title')->middleware('permission:edit gallery');
                    Route::post('/batch-clear-sort', 'batchClearSort')->name('batch-clear-sort')->middleware('permission:edit gallery');
                    Route::put('/{id}/update-sort', 'updateSort')->name('update-sort')->middleware('permission:edit gallery');
                });

            // PROMO
            Route::controller(PromoController::class)->prefix('/promo')
                ->name('promo.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view promo');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create promo');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create promo');
                    Route::get('/edit/{uuid}', 'edit')->name('edit')->middleware('permission:edit promo');
                    Route::put('/update/{uuid}', 'update')->name('update')->middleware('permission:edit promo');
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

            // Role & Permission Management (RESTRICTED TO SUPERUSER)
            Route::controller(RolePermissionController::class)
                ->middleware('superuser')
                ->prefix('/role-permission')
                ->name('role-permission.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/update', 'update')->name('update');
                });

            // Setting
            Route::controller(SettingController::class)
                ->prefix('/setting')
                ->name('setting.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view settings');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create settings');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create settings');
                    Route::get('/{id}/edit', 'edit')->name('edit')->middleware('permission:edit settings');
                    Route::put('/{id}/update', 'update')->name('update')->middleware('permission:edit settings');
                    Route::post('/destroy-selected', 'destroySelected')->name('destroySelected')->middleware('permission:delete settings');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy')->middleware('permission:delete settings');
                });

            // Announcement
            Route::controller(AnnouncementController::class)
                ->prefix('/announcement')
                ->name('announcement.')
                ->group(function () {
                    Route::get('/', 'index')->name('index')->middleware('permission:view announcements');
                    Route::get('/create', 'create')->name('create')->middleware('permission:create announcements');
                    Route::post('/store', 'store')->name('store')->middleware('permission:create announcements');
                    Route::get('/{id}/edit', 'edit')->name('edit')->middleware('permission:edit announcements');
                    Route::put('/{id}/update', 'update')->name('update')->middleware('permission:edit announcements');
                    Route::post('/destroy-selected', 'destroySelected')->name('destroySelected')->middleware('permission:delete announcements');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy')->middleware('permission:delete announcements');
                });
        });

        // CAREER — ACCESSIBLE BY ADMIN, SUPERUSER, AND HR (ENFORCED WITH PERMISSIONS)
        Route::controller(JobVacancyController::class)->prefix('/career/vacancy')->name('career.vacancy.')->group(function () {
            Route::get('/', 'index')->name('index')->middleware('permission:view careers');
            Route::get('/create', 'create')->name('create')->middleware('permission:create careers');
            Route::post('/store', 'store')->name('store')->middleware('permission:create careers');
            Route::get('/{uuid}/edit', 'edit')->name('edit')->middleware('permission:edit careers');
            Route::put('/{uuid}/update', 'update')->name('update')->middleware('permission:edit careers');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy')->middleware('permission:delete careers');
        });

        Route::controller(JobApplicationController::class)->prefix('/career/application')->name('career.application.')->group(function () {
            Route::get('/', 'index')->name('index')->middleware('permission:view careers');
            Route::get('/{uuid}', 'show')->name('show')->middleware('permission:view careers');
            Route::get('/{uuid}/print', 'print')->name('print')->middleware('permission:view careers');
            Route::put('/{uuid}/status', 'updateStatus')->name('updateStatus')->middleware('permission:edit careers');
            Route::get('/{uuid}/download-cv', 'downloadCv')->name('downloadCv')->middleware('permission:view careers');
            Route::post('/{uuid}/review', 'storeReview')->name('storeReview')->middleware('permission:edit careers');
        });

        Route::controller(\App\Http\Controllers\Backend\Admin\EmailLogController::class)->prefix('/career/email-logs')->name('career.email-logs.')->group(function () {
            Route::get('/', 'index')->name('index')->middleware('permission:view careers');
            Route::get('/{id}', 'show')->name('show')->middleware('permission:view careers');
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
