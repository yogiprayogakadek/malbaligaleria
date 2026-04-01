<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PromoteUpcomingEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:promote-upcoming-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promote upcoming events to special event if they start in the current month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now();
        $month = $today->month;
        $year = $today->year;

        $this->info("Checking for upcoming events in month $month, year $year...");

        $promotedCount = \App\Models\Event::where('type', 'upcoming')
            ->where('is_active', true)
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', $month)
            ->update(['type' => 'special']);

        if ($promotedCount > 0) {
            $this->info("Successfully promoted $promotedCount upcoming events to special event.");
            \Illuminate\Support\Facades\Log::info("Promoted $promotedCount upcoming events to special event for month $month/$year.");
        } else {
            $this->info("No upcoming events found for promotion this month.");
        }
    }
}
