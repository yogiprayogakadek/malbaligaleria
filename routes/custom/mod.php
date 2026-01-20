<?php

use App\Http\Controllers\Backend\Admin\ModController;
use Illuminate\Support\Facades\Route;

Route::domain('mod.malbaligaleria.com')->group(function () {
    Route::get('/', [ModController::class, 'index'])->name('mod.index');
});
