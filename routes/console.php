<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;

Schedule::command('visitor:archive-daily')->dailyAt('01:00')->timezone('Asia/Makassar');
Schedule::command('app:deactivate-expired-events')->dailyAt('01:10')->timezone('Asia/Makassar');
Schedule::command('app:check-expiring-promos')->dailyAt('01:20')->timezone('Asia/Makassar');

// Clean up raw visitor logs older than 30 days to optimize database size
Schedule::call(function () {
    \App\Models\VisitorLog::where('created_at', '<', now()->subDays(30))->delete();
})->dailyAt('01:30')->timezone('Asia/Makassar');
