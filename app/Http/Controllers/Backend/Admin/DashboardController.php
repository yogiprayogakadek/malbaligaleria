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
            $activeVacancies   = \App\Models\JobVacancy::where('status', 'open')->count();
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
            $activeVacancies   = \App\Models\JobVacancy::where('status', 'open')->count();
            $totalApplications = \App\Models\JobApplication::count();
            $newApplications   = \App\Models\JobApplication::where('status', 'new')->count();
        }

        return view('backend.admin.dashboard.index', compact(
            'totalTenants', 'activeTenants', 'totalCategories',
            'totalEvents', 'activeEvents', 'upcomingEvents', 'expiredEvents', 'eventsWithoutPhoto',
            'totalPromos', 'activePromos', 'expiringPromos',
            'totalUsers', 'adminUsers', 'tenantUsers',
            'totalVacancies', 'activeVacancies', 'totalApplications', 'newApplications',
            'recentTenants', 'recentEvents', 'recentPromos',
            'monthlyData', 'categoryData', 'eventGrowth', 'tenantGrowth'
        ));
    }
}
