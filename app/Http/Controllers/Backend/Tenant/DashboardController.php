<?php

namespace App\Http\Controllers\Backend\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = Auth::user()->tenant_id;
        
        // Get promo statistics
        $totalPromos = Promo::where('tenant_id', $tenantId)->count();
        $activePromos = Promo::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->count();
        $expiredPromos = Promo::where('tenant_id', $tenantId)
            ->where('end_date', '<', Carbon::now())
            ->count();
        $upcomingPromos = Promo::where('tenant_id', $tenantId)
            ->where('start_date', '>', Carbon::now())
            ->count();
        
        // Get recent promos (last 5)
        $recentPromos = Promo::where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Chart Data - Monthly Promo Trends (Last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][] = $month->format('M Y');
            
            $monthlyData['promos'][] = Promo::where('tenant_id', $tenantId)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        
        return view('backend.tenant.dashboard.index', compact(
            'totalPromos',
            'activePromos',
            'expiredPromos',
            'upcomingPromos',
            'recentPromos',
            'monthlyData'
        ));
    }
}
