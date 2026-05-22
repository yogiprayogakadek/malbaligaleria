<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyVisitor;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        // Get the date of the first log recorded
        $firstLog = VisitorLog::orderBy('created_at', 'asc')->first();
        $start = $firstLog ? Carbon::parse($firstLog->created_at)->startOfMonth() : Carbon::now()->startOfMonth();
        $end = Carbon::now()->startOfMonth();

        $months = [];
        $current = $start->copy();

        while ($current->lessThanOrEqualTo($end)) {
            $year = $current->year;
            $month = $current->month;
            
            // Calculate total visits for this month
            $isCurrentMonth = ($year === Carbon::now()->year && $month === Carbon::now()->month);
            if ($isCurrentMonth) {
                $total = VisitorLog::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
            } else {
                $total = (int) DailyVisitor::whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->sum('visit_count');
            }

            $months[] = (object) [
                'year' => $year,
                'month' => $month,
                'name' => $current->format('F Y'),
                'total_visits' => $total,
                'is_current' => $isCurrentMonth
            ];

            $current->addMonth();
        }

        // Sort descending so the most recent month shows first
        $months = array_reverse($months);

        return view('backend.admin.visitors.index', compact('months'));
    }

    public function detail($year, $month)
    {
        $targetMonth = Carbon::createFromDate($year, $month, 1);
        $isCurrentMonth = ($year == Carbon::now()->year && $month == Carbon::now()->month);

        // Fetch archived daily records
        $daysQuery = DailyVisitor::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($item) {
                return (object) [
                    'date' => Carbon::parse($item->date)->format('d F Y'),
                    'count' => $item->visit_count,
                    'is_today' => false
                ];
            })->toArray();

        // If it is the current month, prepend today's live visitor count
        if ($isCurrentMonth) {
            $today = Carbon::today();
            $todayCount = VisitorLog::whereDate('created_at', $today->toDateString())->count();
            
            array_unshift($daysQuery, (object) [
                'date' => $today->format('d F Y') . ' (Today)',
                'count' => $todayCount,
                'is_today' => true
            ]);
        }

        return view('backend.admin.visitors.partials.detail_rows', [
            'days' => $daysQuery,
            'monthName' => $targetMonth->format('F Y')
        ]);
    }
}
