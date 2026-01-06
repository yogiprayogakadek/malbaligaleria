<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $settings = Setting::latest();

            return DataTables::of($settings)
                ->addIndexColumn()
                ->editColumn('payload', function ($row) {
                    return \Illuminate\Support\Str::limit(json_encode($row->payload), 50);
                })
                ->addColumn('is_active', function ($row) {
                    if ($row->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-secondary">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.setting.edit', $row->id) . '" class="btn btn-sm btn-primary me-2"><i class="ti ti-pencil"></i></a>';
                    $btn .= '<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        return view('backend.admin.setting.index');
    }

    private function getAvailableKeys()
    {
        return [
            'site_title',
            'site_description',
            'company_address',
            'contact_email',
            'contact_phone',
            'social_facebook',
            'social_instagram',
            'maintenance_mode'
        ];
    }

    public function create()
    {
        $availableKeys = $this->getAvailableKeys();
        return view('backend.admin.setting.create', compact('availableKeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:settings,name',
            'description' => 'required|string',
            'payload_key' => 'required|array',
            'payload_value' => 'required|array',
        ]);

        $payload = [];
        if ($request->has('payload_key') && $request->has('payload_value')) {
            foreach ($request->payload_key as $index => $key) {
                if (!empty($key)) {
                    $payload[$key] = $request->payload_value[$index] ?? null;
                }
            }
        }

        $isActive = $request->has('is_active');
        if ($isActive) {
            Setting::where('is_active', true)->update(['is_active' => false]);
        } else {
            if (Setting::count() === 0) {
                 $isActive = true;
            }
        }

        Setting::create([
            'name' => $request->name,
            'description' => $request->description,
            'payload' => $payload,
            'is_active' => $isActive
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Setting created successfully.');
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        $availableKeys = $this->getAvailableKeys();
        
        // Prepare payload for display (as string for textarea)
        $payloadVal = $setting->payload;
        if (is_array($payloadVal) || is_object($payloadVal)) {
            $payloadVal = json_encode($payloadVal, JSON_PRETTY_PRINT);
        }

        return view('backend.admin.setting.edit', compact('setting', 'payloadVal', 'availableKeys'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:settings,name,' . $id,
            'description' => 'required|string',
            'payload_key' => 'required|array',
            'payload_value' => 'required|array',
        ]);

        $setting = Setting::findOrFail($id);
        $isActive = $request->has('is_active');

        // Logic check
        if ($isActive) {
            // Setting this to active -> Deactivate others
            if (!$setting->is_active) {
                Setting::where('id', '!=', $id)->update(['is_active' => false]);
            }
        } else {
            // Setting this to inactive
            if ($setting->is_active) {
                // Check if any other is active? The requirement is "Only 1 setting active". 
                // So if this IS the active one, and we turn it off, then 0 will be active.
                // Requirement: "ketika hanya ada 1 setting yang aktif yang user ingin menonaktifkan semuanya maka tampilkan notifikasi tidak bisa"
                // So if this is the ONLY active one, we prevent it.
                $otherActiveCount = Setting::where('is_active', true)->where('id', '!=', $id)->count();
                if ($otherActiveCount === 0) {
                     return back()->with('error', 'Cannot deactivate the only active setting (Cannot disable all settings). One must be active.');
                }
            }
        }

        $payload = [];
        if ($request->has('payload_key') && $request->has('payload_value')) {
            foreach ($request->payload_key as $index => $key) {
                if (!empty($key)) {
                    $payload[$key] = $request->payload_value[$index] ?? null;
                }
            }
        }

        $setting->update([
            'name' => $request->name,
            'description' => $request->description,
            'payload' => $payload,
            'is_active' => $isActive
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Setting updated successfully.');
    }

    public function destroy($id)
    {
        Setting::findOrFail($id)->delete();
        return response()->json(['success' => 'Setting deleted successfully.']);
    }
}
