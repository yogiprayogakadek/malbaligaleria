<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:check-expiring-promos')->dailyAt('09:00');
Schedule::command('app:deactivate-expired-events')->dailyAt('06:00')->timezone('Asia/Makassar');
Schedule::command('app:promote-upcoming-events')->dailyAt('00:01')->timezone('Asia/Makassar');
Schedule::command('visitor:archive-daily')->dailyAt('00:05')->timezone('Asia/Makassar');
