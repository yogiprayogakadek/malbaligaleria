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

// Clean up activity logs older than 90 days to optimize database size
Schedule::call(function () {
    \Spatie\Activitylog\Models\Activity::where('created_at', '<', now()->subDays(90))->delete();
})->dailyAt('01:40')->timezone('Asia/Makassar');

// Weekly database backup and pruning backup files older than 30 days
Schedule::call(function () {
    try {
        app(\App\Http\Controllers\Backend\Admin\BackupController::class)->run();
    } catch (\Exception $e) {
        logger()->error('Auto-backup failed: ' . $e->getMessage());
    }

    $disk = \Illuminate\Support\Facades\Storage::disk('local');
    $backupPath = 'backups';
    if ($disk->exists($backupPath)) {
        $files = $disk->files($backupPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $lastModified = $disk->lastModified($file);
                if (time() - $lastModified > 30 * 24 * 60 * 60) {
                    $disk->delete($file);
                }
            }
        }
    }
})->weeklyOn(7, '02:00')->timezone('Asia/Makassar');
