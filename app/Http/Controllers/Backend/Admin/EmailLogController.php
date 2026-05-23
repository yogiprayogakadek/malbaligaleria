<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function index(Request $request)
    {
        $query = EmailLog::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('recipient', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('backend.admin.career.email-logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = EmailLog::findOrFail($id);
        return view('backend.admin.career.email-logs.show', compact('log'));
    }
}
