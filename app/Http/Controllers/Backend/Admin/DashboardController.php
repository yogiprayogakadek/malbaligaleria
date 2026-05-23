<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\Event;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $now = Carbon::now();

        // 1. HR DASHBOARD (ONLY CAREER DATA)
        if ($user->hasRole('hr')) {
            $totalVacancies    = \App\Models\JobVacancy::count();
            $activeVacancies   = \App\Models\JobVacancy::where('is_active', true)->count();
            $totalApplications = \App\Models\JobApplication::count();
            $newApplications   = \App\Models\JobApplication::where('status', 'new')->count();

            $recentApplications = \App\Models\JobApplication::with('vacancy')
                ->latest()
                ->take(10)
                ->get();

            return view('backend.admin.dashboard.hr', compact(
                'totalVacancies', 'activeVacancies', 'totalApplications', 'newApplications', 'recentApplications'
            ));
        }

        // 2. ADMIN & SUPERUSER (MALL DATA)
        // Self-healing visitor log archiving
        $firstLog = \App\Models\VisitorLog::orderBy('created_at', 'asc')->first();
        if ($firstLog) {
            $start = Carbon::parse($firstLog->created_at)->startOfDay();
            $end = Carbon::yesterday()->startOfDay();

            // Only run self-healing if there are days to archive
            if ($start->lessThanOrEqualTo($end)) {
                // Get all existing dates in the daily_visitors table
                $existingDates = \App\Models\DailyVisitor::whereBetween('date', [$start->toDateString(), $end->toDateString()])
                    ->pluck('date')
                    ->map(fn($d) => Carbon::parse($d)->toDateString())
                    ->toArray();

                $current = $start->copy();
                $insertData = [];

                while ($current->lessThanOrEqualTo($end)) {
                    $dateStr = $current->toDateString();
                    if (!in_array($dateStr, $existingDates)) {
                        $count = \App\Models\VisitorLog::whereDate('created_at', $dateStr)->count();
                        $insertData[] = [
                            'date' => $dateStr,
                            'visit_count' => $count,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    $current->addDay();
                }

                if (!empty($insertData)) {
                    \App\Models\DailyVisitor::insert($insertData);
                }
            }
        }

        // Statistics
        $totalTenants  = Tenant::count();
        $activeTenants = Tenant::where('is_active', true)->count();
        $totalCategories = Category::count();
        $totalEvents   = Event::count();
        $activeEvents  = Event::where('start_date', '<=', $now)->where('end_date', '>=', $now)->count();
        $upcomingEvents = Event::where('start_date', '>', $now)->where('is_active', true)->count();
        $expiredEvents  = Event::where('end_date', '<', $now)->count();
        $eventsWithoutPhoto = Event::whereDoesntHave('photos')->count();
        $totalPromos  = Promo::count();
        $activePromos = Promo::where('is_active', true)->where('start_date', '<=', $now)->where('end_date', '>=', $now)->count();
        $expiringPromos = Promo::where('is_active', true)->whereBetween('end_date', [$now->toDateString(), $now->copy()->addDays(7)->toDateString()])->count();

        // Admin & Superuser shared collections
        $recentTenants = Tenant::with(['category', 'primaryPhoto'])->latest()->take(5)->get();
        $recentEvents = Event::with(['primaryPhoto'])->latest()->take(5)->get();
        $recentPromos = Promo::with('tenant')->latest()->take(5)->get();

        // Monthly Trends
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][]  = $month->format('M Y');
            $monthlyData['tenants'][] = Tenant::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyData['events'][]  = Event::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyData['promos'][]  = Promo::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            
            // Get visitor count robustly (archived monthly sum + active logs for that month since last archive)
            $archivedMonthSum = (int) \App\Models\DailyVisitor::whereYear('date', $month->year)->whereMonth('date', $month->month)->sum('visit_count');
            $lastArchivedDate = \App\Models\DailyVisitor::max('date');
            
            if ($lastArchivedDate) {
                $activeMonthLogs = \App\Models\VisitorLog::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->where('created_at', '>', Carbon::parse($lastArchivedDate)->endOfDay())
                    ->count();
            } else {
                $activeMonthLogs = \App\Models\VisitorLog::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }
            
            $monthlyData['visitors'][] = $archivedMonthSum + $activeMonthLogs;
        }

        // Fetch all daily visits ordered by date desc
        $dailyVisits = \App\Models\DailyVisitor::orderBy('date', 'desc')->get();

        // Also get today's live visitor count to include
        $todayDate = $now->toDateString();
        $todayCount = \App\Models\VisitorLog::whereDate('created_at', $todayDate)->count();

        // Group daily visits by year and month
        $groupedVisits = [];
        foreach ($dailyVisits as $visit) {
            $carbonDate = Carbon::parse($visit->date);
            $monthKey = $carbonDate->format('Y-m');
            $monthName = $carbonDate->format('F Y');

            if (!isset($groupedVisits[$monthKey])) {
                $groupedVisits[$monthKey] = [
                    'name' => $monthName,
                    'total' => 0,
                    'days' => []
                ];
            }

            $groupedVisits[$monthKey]['total'] += $visit->visit_count;
            $groupedVisits[$monthKey]['days'][] = (object) [
                'date' => $carbonDate->format('d M Y'),
                'count' => $visit->visit_count,
                'is_today' => false
            ];
        }

        // Add today's live counts to the current month group
        $todayCarbon = Carbon::today();
        $currentMonthKey = $todayCarbon->format('Y-m');
        $currentMonthName = $todayCarbon->format('F Y');
        
        if (!isset($groupedVisits[$currentMonthKey])) {
            $groupedVisits[$currentMonthKey] = [
                'name' => $currentMonthName,
                'total' => 0,
                'days' => []
            ];
        }
        
        $groupedVisits[$currentMonthKey]['total'] += $todayCount;
        array_unshift($groupedVisits[$currentMonthKey]['days'], (object) [
            'date' => $todayCarbon->format('d M Y') . ' (Today)',
            'count' => $todayCount,
            'is_today' => true
        ]);

        // Daily visits for last 15 days (line chart)
        $last15Days = ['labels' => [], 'data' => []];
        for ($i = 14; $i >= 0; $i--) {
            $targetDate = Carbon::today()->subDays($i);
            $targetDateStr = $targetDate->toDateString();
            
            $archived = \App\Models\DailyVisitor::where('date', $targetDateStr)->first();
            if ($archived) {
                $count = $archived->visit_count;
            } else {
                $count = \App\Models\VisitorLog::whereDate('created_at', $targetDateStr)->count();
            }
            
            $last15Days['labels'][] = $targetDate->format('d M');
            $last15Days['data'][] = $count;
        }

        // Growth
        $lastMonth = Carbon::now()->subMonth();
        $thisMonthEvents = Event::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $lastMonthEvents = Event::whereYear('created_at', $lastMonth->year)->whereMonth('created_at', $lastMonth->month)->count();
        $eventGrowth = $lastMonthEvents > 0 ? round((($thisMonthEvents - $lastMonthEvents) / $lastMonthEvents) * 100) : null;

        $thisMonthTenants = Tenant::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $lastMonthTenants = Tenant::whereYear('created_at', $lastMonth->year)->whereMonth('created_at', $lastMonth->month)->count();
        $tenantGrowth = $lastMonthTenants > 0 ? round((($thisMonthTenants - $lastMonthTenants) / $lastMonthTenants) * 100) : null;

        $categoryData = Category::withCount('tenants')->orderBy('tenants_count', 'desc')->take(5)->get()->map(fn($c) => ['name' => $c->name, 'count' => $c->tenants_count]);

        // DATA ONLY FOR SUPERUSER
        $totalUsers  = 0;
        $adminUsers  = 0;
        $tenantUsers = 0;
        $totalVacancies = 0;
        $activeVacancies = 0;
        $totalApplications = 0;
        $newApplications = 0;

        if ($user->hasRole('superuser')) {
            $totalUsers  = User::count();
            $adminUsers  = User::role('admin')->count();
            $tenantUsers = User::role('tenant')->count();

            // Superuser also sees career stats
            $totalVacancies    = \App\Models\JobVacancy::count();
            $activeVacancies   = \App\Models\JobVacancy::where('is_active', true)->count();
            $totalApplications = \App\Models\JobApplication::count();
            $newApplications   = \App\Models\JobApplication::where('status', 'new')->count();
        }

        // Top Countries and Cities visitor demographics
        $topCountries = \App\Models\VisitorLog::select('country', \DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        $topCities = \App\Models\VisitorLog::select('city', \DB::raw('count(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        $countryChart = [
            'labels' => $topCountries->pluck('country')->map(fn($c) => $c ?: 'Unknown')->toArray(),
            'data' => $topCountries->pluck('count')->toArray(),
        ];

        $cityChart = [
            'labels' => $topCities->pluck('city')->map(fn($c) => $c ?: 'Unknown')->toArray(),
            'data' => $topCities->pluck('count')->toArray(),
        ];

        return view('backend.admin.dashboard.index', compact(
            'totalTenants', 'activeTenants', 'totalCategories',
            'totalEvents', 'activeEvents', 'upcomingEvents', 'expiredEvents', 'eventsWithoutPhoto',
            'totalPromos', 'activePromos', 'expiringPromos',
            'totalUsers', 'adminUsers', 'tenantUsers',
            'totalVacancies', 'activeVacancies', 'totalApplications', 'newApplications',
            'recentTenants', 'recentEvents', 'recentPromos',
            'monthlyData', 'categoryData', 'eventGrowth', 'tenantGrowth', 'groupedVisits', 'last15Days',
            'topCountries', 'topCities', 'countryChart', 'cityChart'
        ));
    }
}
