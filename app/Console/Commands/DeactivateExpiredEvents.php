<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class DeactivateExpiredEvents extends Command
{
    protected $signature = 'app:deactivate-expired-events';

    protected $description = 'Deactivate events whose end_date has passed';

    public function handle()
    {
        $this->info('Checking for expired events...');

        $expiredCount = Event::where('is_active', true)
            ->whereDate('end_date', '<', now('Asia/Makassar')->toDateString())
            ->update(['is_active' => false]);

        $this->info("Deactivated {$expiredCount} expired event(s).");
        $this->info('Done.');
    }
}
