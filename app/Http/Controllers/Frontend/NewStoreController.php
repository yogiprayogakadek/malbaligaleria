<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class NewStoreController extends Controller
{
    public function index()
    {
        // Fetch latest active tenants
        $tenants = Tenant::where('is_active', true)
            ->with(['category', 'primaryPhoto'])
            ->orderBy('created_at', 'desc')
            ->take(12) // Limit to latest 12
            ->get();

        return view('frontend.new-store.index', compact('tenants'));
    }
}
