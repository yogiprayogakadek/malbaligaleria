<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class NewStoreController extends Controller
{
    public function index()
    {
        // Fetch tenants that are marked as new, have a launched_at date,
        // and launched within the last 7 days.
        $tenants = Tenant::where('is_active', true)
            ->where('isNew', true)
            ->whereNotNull('launched_at')
            ->where('launched_at', '>=', now()->subDays(7))
            ->with(['category', 'primaryPhoto'])
            ->orderBy('launched_at', 'desc')
            ->get();

        return view('frontend.new-store.index', compact('tenants'));
    }
}
