<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class DiningController extends Controller
{
    public function index()
    {
        // Category ID 1 = Food (from database check)
        $tenants = Tenant::where('category_id', 1)
            ->where('is_active', true)
            ->with(['category', 'primaryPhoto'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.dining.index', compact('tenants'));
    }
}
