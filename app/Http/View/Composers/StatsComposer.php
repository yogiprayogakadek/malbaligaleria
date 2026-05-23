<?php

namespace App\Http\View\Composers;

use App\Models\VisitorLog;
use Illuminate\View\View;
use Carbon\Carbon;

class StatsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $request = request();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            try {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                
                $archivedSum = (int) \App\Models\DailyVisitor::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])->sum('visit_count');
                
                $lastArchivedDate = \App\Models\DailyVisitor::max('date');
                if ($lastArchivedDate) {
                    $activeLogsCount = VisitorLog::whereBetween('created_at', [$startDate, $endDate])
                        ->where('created_at', '>', Carbon::parse($lastArchivedDate)->endOfDay())
                        ->count();
                } else {
                    $activeLogsCount = VisitorLog::whereBetween('created_at', [$startDate, $endDate])->count();
                }
                
                $totalVisitors = $archivedSum + $activeLogsCount;
                
                // If today is inside the range, count today's visitors
                if (Carbon::today()->between($startDate, $endDate)) {
                    $todayVisitors = VisitorLog::where('created_at', '>=', Carbon::today())->count();
                } else {
                    $todayVisitors = 0;
                }
            } catch (\Exception $e) {
                $totalVisitors = 0;
                $todayVisitors = 0;
            }
        } else {
            // Default: All time total visitors
            $lastArchivedDate = \App\Models\DailyVisitor::max('date');
            if ($lastArchivedDate) {
                $archivedSum = (int) \App\Models\DailyVisitor::sum('visit_count');
                $activeLogsCount = VisitorLog::where('created_at', '>', Carbon::parse($lastArchivedDate)->endOfDay())->count();
                $totalVisitors = $archivedSum + $activeLogsCount;
            } else {
                $totalVisitors = VisitorLog::count();
            }
            $todayVisitors = VisitorLog::where('created_at', '>=', now()->startOfDay())->count();
        }
        
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
