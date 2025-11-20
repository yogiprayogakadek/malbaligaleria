<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/tenant', function () {
    return view('frontend.tenant.index');
});

Route::get('/directory', function () {
    return view('frontend.directory.index');
});
