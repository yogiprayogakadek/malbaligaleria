<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArchiveMonthlyVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitor:archive-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive visitor logs into monthly statistics summaries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting visitor history archiving...');

        // Find the earliest visitor log date to build history
        $firstLog = \App\Models\VisitorLog::orderBy('created_at', 'asc')->first();
        if (!$firstLog) {
            $this->warn('No visitor logs found to archive.');
            return 0;
        }

        $start = \Carbon\Carbon::parse($firstLog->created_at)->startOfMonth();
        
        // We only archive closed months, which means months before the current month
        $end = \Carbon\Carbon::now()->subMonth()->startOfMonth();

        $current = $start->copy();
        while ($current->lessThanOrEqualTo($end)) {
            $year = $current->year;
            $month = $current->month;

            // Count visitor logs (unique per day, as recorded by the middleware) in this month
            $count = \App\Models\VisitorLog::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            // Save or update
            \App\Models\MonthlyVisitor::updateOrCreate(
                ['year' => $year, 'month' => $month],
                ['visit_count' => $count]
            );

            $this->info("Archived {$current->format('M Y')}: {$count} visits.");
            $current->addMonth();
        }

        $this->info('Visitor history archiving completed successfully.');
        return 0;
    }
}
