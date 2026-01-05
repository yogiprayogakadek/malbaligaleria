<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activity::with('causer')->latest();

            // Filter by Log Name
            if ($request->has('log_name') && !empty($request->log_name)) {
                $activities->where('log_name', $request->log_name);
            }

            // Filter by Date Range
            if ($request->has('date_filter') && !empty($request->date_filter)) {
                $dates = explode(' to ', $request->date_filter);
                if (count($dates) == 2) {
                    $startDate = $dates[0] . ' 00:00:00';
                    $endDate = $dates[1] . ' 23:59:59';
                    $activities->whereBetween('created_at', [$startDate, $endDate]);
                } else {
                    $activities->whereDate('created_at', $dates[0]);
                }
            }

            return DataTables::of($activities)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="checkbox" data-id="' . $row->id . '">';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('causer', function ($row) {
                    $user = $row->causer;
                    if (!$user) return 'System';
                    
                    $name = $user->name;
                    // Check if subject is Tenant model, or if user has tenant relation
                    // But here we want the User's tenant. 
                    // Let's check relation if loaded (we used with('causer') but causer is morph).
                    // We can try to load it or access it if it exists on model.
                    if ($user instanceof \App\Models\User && $user->tenant) {
                        $name .= ' (' . $user->tenant->name . ')';
                    }
                    return $name;
                })
                ->addColumn('properties', function ($row) {
                    $props = '';
                    if (!empty($row->properties)) {
                        foreach ($row->properties as $key => $value) {
                            if (is_string($value) || is_numeric($value)) {
                                $props .= '<strong>' . ucfirst($key) . ':</strong> ' . $value . '<br>';
                            }
                        }
                    }
                    return $props;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'properties', 'action'])
                ->make(true);
        }

        $logNames = Activity::select('log_name')->distinct()->pluck('log_name');

        return view('backend.admin.activity.index', compact('logNames'));
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return response()->json(['success' => 'Activity log deleted successfully.']);
    }

    public function destroyAll()
    {
        Activity::truncate();

        return response()->json(['success' => 'All activity logs deleted successfully.']);
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        Activity::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => 'Selected activity logs deleted successfully.']);
    }
}
