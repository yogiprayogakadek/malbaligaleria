<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArchiveDailyVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitor:archive-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive daily visitor logs into daily statistics summaries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily visitor history archiving...');

        // Find the earliest visitor log date to build history
        $firstLog = \App\Models\VisitorLog::orderBy('created_at', 'asc')->first();
        if (!$firstLog) {
            $this->warn('No visitor logs found to archive.');
            return 0;
        }

        $start = \Carbon\Carbon::parse($firstLog->created_at)->startOfDay();
        $end = \Carbon\Carbon::yesterday()->startOfDay();

        $current = $start->copy();
        while ($current->lessThanOrEqualTo($end)) {
            $dateString = $current->toDateString();

            // Count logs for this specific day
            $count = \App\Models\VisitorLog::whereDate('created_at', $dateString)->count();

            // Save or update daily visitor entry
            \App\Models\DailyVisitor::updateOrCreate(
                ['date' => $dateString],
                ['visit_count' => $count]
            );

            $this->info("Archived {$dateString}: {$count} visits.");
            $current->addDay();
        }

        $this->info('Daily visitor history archiving completed successfully.');
        return 0;
    }
}
