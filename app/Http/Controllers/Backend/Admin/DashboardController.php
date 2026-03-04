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
        $now = Carbon::now();

        // Tenant Statistics
        $totalTenants  = Tenant::count();
        $activeTenants = Tenant::where('is_active', true)->count();

        // Category Statistics
        $totalCategories = Category::count();

        // Event Statistics
        $totalEvents   = Event::count();
        $activeEvents  = Event::where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->count();
        $upcomingEvents = Event::where('start_date', '>', $now)
            ->where('is_active', true)
            ->count();
        $expiredEvents  = Event::where('end_date', '<', $now)->count();
        $eventsWithoutPhoto = Event::whereDoesntHave('photos')->count();

        // Promo Statistics
        $totalPromos  = Promo::count();
        $activePromos = Promo::where('is_active', true)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->count();
        $expiringPromos = Promo::where('is_active', true)
            ->whereBetween('end_date', [$now->toDateString(), $now->copy()->addDays(7)->toDateString()])
            ->count();

        // User Statistics
        $totalUsers  = User::count();
        $adminUsers  = User::role('admin')->count();
        $tenantUsers = User::role('tenant')->count();

        // Recent Activities
        $recentTenants = Tenant::with(['category', 'primaryPhoto'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentEvents = Event::with(['primaryPhoto'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentPromos = Promo::with('tenant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Chart Data - Monthly Trends (Last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][]  = $month->format('M Y');
            $monthlyData['tenants'][] = Tenant::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyData['events'][]  = Event::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyData['promos'][]  = Promo::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
        }

        // Month-over-month growth
        $lastMonth       = Carbon::now()->subMonth();
        $thisMonthEvents  = Event::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $lastMonthEvents  = Event::whereYear('created_at', $lastMonth->year)->whereMonth('created_at', $lastMonth->month)->count();
        $eventGrowth      = $lastMonthEvents > 0 ? round((($thisMonthEvents - $lastMonthEvents) / $lastMonthEvents) * 100) : null;

        $thisMonthTenants = Tenant::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $lastMonthTenants = Tenant::whereYear('created_at', $lastMonth->year)->whereMonth('created_at', $lastMonth->month)->count();
        $tenantGrowth     = $lastMonthTenants > 0 ? round((($thisMonthTenants - $lastMonthTenants) / $lastMonthTenants) * 100) : null;

        // Category Distribution
        $categoryData = Category::withCount('tenants')
            ->orderBy('tenants_count', 'desc')
            ->take(5)
            ->get()
            ->map(fn($c) => ['name' => $c->name, 'count' => $c->tenants_count]);

        return view('backend.admin.dashboard.index', compact(
            'totalTenants', 'activeTenants',
            'totalCategories',
            'totalEvents', 'activeEvents', 'upcomingEvents', 'expiredEvents', 'eventsWithoutPhoto',
            'totalPromos', 'activePromos', 'expiringPromos',
            'totalUsers', 'adminUsers', 'tenantUsers',
            'recentTenants', 'recentEvents', 'recentPromos',
            'monthlyData', 'categoryData',
            'eventGrowth', 'tenantGrowth'
        ));
    }
}
