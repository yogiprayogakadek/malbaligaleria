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
        // Tenant Statistics
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('is_active', true)->count();

        // Category Statistics
        $totalCategories = Category::count();

        // Event Statistics
        $totalEvents = Event::count();
        $activeEvents = Event::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->count();
        $upcomingEvents = Event::where('start_date', '>', Carbon::now())->count();

        // Promo Statistics
        $totalPromos = Promo::count();
        $activePromos = Promo::where('is_active', true)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->count();

        // User Statistics
        $totalUsers = User::count();
        $adminUsers = User::role('admin')->count();
        $tenantUsers = User::role('tenant')->count();

        // Recent Activities
        $recentTenants = Tenant::orderBy('created_at', 'desc')->take(5)->get();
        $recentEvents = Event::orderBy('created_at', 'desc')->take(5)->get();
        $recentPromos = Promo::with('tenant')->orderBy('created_at', 'desc')->take(5)->get();

        // Chart Data - Monthly Trends (Last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][] = $month->format('M Y');
            
            // Tenants created in this month
            $monthlyData['tenants'][] = Tenant::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            // Events created in this month
            $monthlyData['events'][] = Event::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            // Promos created in this month
            $monthlyData['promos'][] = Promo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // Category Distribution
        $categoryData = Category::withCount('tenants')
            ->orderBy('tenants_count', 'desc')
            ->take(5)
            ->get()
            ->map(function($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->tenants_count
                ];
            });

        return view('backend.admin.dashboard.index', compact(
            'totalTenants',
            'activeTenants',
            'totalCategories',
            'totalEvents',
            'activeEvents',
            'upcomingEvents',
            'totalPromos',
            'activePromos',
            'totalUsers',
            'adminUsers',
            'tenantUsers',
            'recentTenants',
            'recentEvents',
            'recentPromos',
            'monthlyData',
            'categoryData'
        ));
    }
}
