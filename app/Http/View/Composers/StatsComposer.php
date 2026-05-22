<?php

namespace App\Http\View\Composers;

use App\Models\VisitorLog;
use Illuminate\View\View;

class StatsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Calculate total visitors robustly (archived history + active logs since last archive)
        $lastArchivedDate = \App\Models\DailyVisitor::max('date');
        if ($lastArchivedDate) {
            $archivedSum = (int) \App\Models\DailyVisitor::sum('visit_count');
            $activeLogsCount = VisitorLog::where('created_at', '>', \Carbon\Carbon::parse($lastArchivedDate)->endOfDay())->count();
            $totalVisitors = $archivedSum + $activeLogsCount;
        } else {
            $totalVisitors = VisitorLog::count();
        }

        $todayVisitors = VisitorLog::where('created_at', '>=', now()->startOfDay())->count();
        
        $onlineVisitors = VisitorLog::where('updated_at', '>=', now()->subMinutes(5))
            ->distinct('session_id')
            ->count('session_id');

        if ($onlineVisitors < 1) {
            $onlineVisitors = 1;
        }

        $view->with([
            'totalVisitors' => $totalVisitors,
            'todayVisitors' => $todayVisitors,
            'onlineVisitors' => $onlineVisitors,
        ]);
    }
}
