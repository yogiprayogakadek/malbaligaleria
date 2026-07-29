<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\Backend\Admin\RecycleBinController;
use App\Http\Controllers\Backend\Admin\RolePermissionController;
use App\Http\Controllers\Backend\Admin\JobVacancyController;
use App\Http\Controllers\Backend\Admin\JobApplicationController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FrontendMenuController;
// InventoryController moved to routes/inventory.php
use App\Http\Controllers\Backend\Admin\VisitorController;
use App\Http\Controllers\Backend\Admin\GalleryController;
use App\Http\Controllers\Backend\Admin\LogViewerController;
use App\Http\Controllers\Backend\Admin\BackupController;
use App\Http\Controllers\Backend\Admin\MediaCleanupController;
use App\Http\Controllers\Backend\Admin\ImageCompressionController;
use App\Http\Controllers\Backend\Admin\SubdomainAccessController;
use App\Http\Controllers\Backend\Admin\IpWhitelistController;

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
                    Route::delete('/delete/{uuid}', 'delete')->name('delete')->middleware('permission:delete category tenants');
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
                    Route::delete('/delete/{uuid}', 'delete')->name('delete')->middleware('permission:delete events');
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
                    Route::delete('/delete/{uuid}', 'delete')->name('delete')->middleware('permission:delete promo');
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

            // RECYCLE BIN
            Route::controller(RecycleBinController::class)
                ->prefix('/recycle-bin')
                ->name('recycle-bin.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/data', 'data')->name('data');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::post('/force-delete', 'forceDelete')->name('force-delete');
                    Route::post('/empty', 'emptyBin')->name('empty');
                });

            // INVENTORY MANAGEMENT → moved to routes/inventory/

            // SUBDOMAIN ACCESS MANAGEMENT
            Route::controller(SubdomainAccessController::class)
                ->prefix('/subdomain-access')
                ->name('subdomain-access.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::patch('/{id}/toggle', 'toggle')->name('toggle');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                });

            // IP WHITELIST MANAGEMENT
            Route::controller(IpWhitelistController::class)
                ->prefix('/ip-whitelist')
                ->name('ip-whitelist.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::patch('/{id}/toggle', 'toggle')->name('toggle');
                    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
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

// EVENT BOARD ROUTES (ACCESSIBLE BY SUPERUSER + ROLES/USERS CONFIGURED IN SETTINGS)
Route::middleware(['auth', 'verified', 'checkUserStatus'])
    ->prefix('/dashboard/event-board')
    ->name('admin.event-board.')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'board'])->name('index');
        Route::get('/api/list', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiList'])->name('api.list');
        Route::post('/api/store', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiStore'])->name('api.store');
        Route::put('/api/update/{uuid}', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiUpdate'])->name('api.update');
        Route::post('/api/update-date/{uuid}', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiUpdateDate'])->name('api.update-date');
        Route::post('/api/update-kanban/{uuid}', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiUpdateKanban'])->name('api.update-kanban');
        Route::delete('/api/delete/{uuid}', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'apiDelete'])->name('api.delete');
        Route::post('/save-settings', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'saveSettings'])->name('save-settings');
        Route::get('/search-users', [\App\Http\Controllers\Backend\Admin\BoardScheduleController::class, 'searchUsers'])->name('search-users');
    });


