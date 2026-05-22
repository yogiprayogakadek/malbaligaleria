<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $settings = $this->settingService->getAll(['id', 'name', 'pages', 'description', 'payload', 'is_active']);

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

    public function create()
    {
        $availablePages = $this->settingService->availablePages();
        return view('backend.admin.setting.create', compact('availablePages'));
    }

    public function store(Request $request)
    {
        $validate = [
            'name' => [
                'required',
                'string',
                Rule::unique('settings', 'name')->where('pages', $request->pages)
            ],
            'description' => 'required|string',
        ];

        if ($request->pages == "home") {
            $validate = array_merge($validate, [
                'site_title' => 'nullable|string',
                'hero_background' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
                'hero_title' => 'nullable|string',
                'hero_subtitle' => 'nullable|string',
            ]);
        } elseif ($request->pages == 'others') {
            $validate = array_merge($validate, [
                'company_address' => 'nullable|string',
                'contact_email' => 'nullable|string|email',
                'contact_phone' => 'nullable|numeric',
                'social_facebook' => 'nullable|url',
                'social_instagram' => 'nullable|url',
                'logo' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
                'announcement_active' => 'nullable|in:0,1',
                'announcement_text' => 'nullable|string',
                'announcement_type' => 'nullable|string|in:info,warning,danger,success,primary',
            ]);
        } elseif (in_array($request->pages, ['mal directory', 'event', 'promo'])) {
            $validate = array_merge($validate, [
                'site_title' => 'nullable|string',
                'page_title' => 'nullable|string',
                'page_subtitle' => 'nullable|string',
            ]);
        } elseif ($request->pages == 'gallery') {
            $validate = array_merge($validate, [
                'site_title' => 'nullable|string',
                'page_title' => 'nullable|string',
                'page_subtitle' => 'nullable|string',
                'grid_columns' => 'required|integer|min:1|max:12',
                'initial_images' => 'required|integer|min:1',
                'load_more_increment' => 'required|integer|min:1',
                'enable_zoom' => 'required|in:0,1',
                'enable_download' => 'required|in:0,1',
                'enable_share' => 'required|in:0,1',
            ]);
        }

        $request->validate($validate);

        $isActive = $request->has('is_active');
        if ($isActive) {
            Setting::where('pages', $request->pages)->where('is_active', true)->update(['is_active' => false]);
        } else {
            if (Setting::count() === 0) {
                $isActive = true;
            }
        }

        $data = [
            'pages' => $request->pages,
            'name' => $request->name,
            'description' => $request->description,
            'type' => 'custom',
            'is_active' => $isActive
        ];

        $data['payload'] = collect($this->settingService->availablePages()[$request->pages])->keys()->mapWithKeys(fn($key) => [
            $key => $request[$key] ?? null
        ])->filter(fn($value) => !is_null($value))
            ->toArray();

        // dd($data);

        $this->settingService->create($data);

        return redirect()->route('admin.setting.index')->with('success', 'Setting created successfully.');
    }

    public function store2(Request $request)
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

        // Prepare payload for display (as string for textarea)
        $payloadVal = $setting->payload;
        if (is_array($payloadVal) || is_object($payloadVal)) {
            $payloadVal = json_encode($payloadVal, JSON_PRETTY_PRINT);
        }

        $availablePages = $this->settingService->availablePages();
        $availableKeys = isset($availablePages[$setting->pages]) ? array_keys($availablePages[$setting->pages]) : [];

        return view('backend.admin.setting.edit', compact('setting', 'payloadVal', 'availableKeys'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('settings', 'name')->where('pages', $setting->pages)->ignore($id)
            ],
            'description' => 'required|string',
            'payload_key' => 'required|array',
            'payload_value' => 'required|array',
        ]);

        $isActive = $request->has('is_active');

        // Logic check
        if ($isActive) {
            // Setting this to active -> Deactivate others of the SAME page type
            if (!$setting->is_active) {
                Setting::where('pages', $setting->pages)->where('id', '!=', $id)->update(['is_active' => false]);
            }
        } else {
            // Setting this to inactive
            if ($setting->is_active) {
                // Check if any other is active for the SAME page type?
                $otherActiveCount = Setting::where('pages', $setting->pages)->where('is_active', true)->where('id', '!=', $id)->count();
                if ($otherActiveCount === 0) {
                    return back()->with('error', 'Cannot deactivate the only active setting for ' . $setting->pages . '. At least one setting must be active.');
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
