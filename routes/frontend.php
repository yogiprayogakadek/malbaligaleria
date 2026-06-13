<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\DirectoryController;
use App\Http\Controllers\Frontend\PromotionPageController as PromotionController;
use App\Http\Controllers\Frontend\NewStoreController;
use App\Http\Controllers\Frontend\EventController as FrontendEventController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;

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
