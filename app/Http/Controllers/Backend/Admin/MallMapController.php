<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MallMapController extends Controller
{
    public function index()
    {
        $setting = Setting::where('pages', 'mall_map')->first();

        $mapData = null;
        if ($setting && !empty($setting->payload['file_path'])) {
            $filePath = $setting->payload['file_path'];
            $mapData = [
                'file_path' => $filePath,
                'url' => asset('storage/' . $filePath),
                'file_name' => $setting->payload['file_name'] ?? basename($filePath),
                'file_type' => $setting->payload['file_type'] ?? pathinfo($filePath, PATHINFO_EXTENSION),
                'updated_at' => $setting->payload['updated_at'] ?? $setting->updated_at->format('d M Y H:i'),
            ];
        }

        return view('backend.admin.mall_map.index', compact('mapData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'map_file' => 'required|file|mimes:pdf,png,jpg,jpeg,webp|max:20480',
        ], [
            'map_file.required' => 'Silakan pilih file peta yang ingin diunggah.',
            'map_file.mimes' => 'Format file harus berupa PDF, PNG, JPG, JPEG, atau WEBP.',
            'map_file.max' => 'Ukuran file tidak boleh melebihi 20MB.',
        ]);

        $file = $request->file('map_file');
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = 'mall_map_' . time() . '.' . $extension;

        // Find existing setting
        $setting = Setting::where('pages', 'mall_map')->first();

        // Delete old file if exists
        if ($setting && !empty($setting->payload['file_path'])) {
            if (Storage::disk('public')->exists($setting->payload['file_path'])) {
                Storage::disk('public')->delete($setting->payload['file_path']);
            }
        }

        // Store new file in storage/app/public/maps
        $filePath = $file->storeAs('maps', $filename, 'public');

        $payload = [
            'file_path' => $filePath,
            'file_name' => $originalName,
            'file_type' => $extension,
            'updated_at' => now()->format('d M Y H:i'),
        ];

        Setting::updateOrCreate(
            ['pages' => 'mall_map'],
            [
                'name' => 'mall_map_file',
                'description' => 'Official Mall Map file for mobile download',
                'payload' => $payload,
                'is_active' => true,
                'type' => 'file',
            ]
        );

        return redirect()->back()->with('success', 'Peta Mal berhasil diunggah.');
    }

    public function destroy()
    {
        $setting = Setting::where('pages', 'mall_map')->first();

        if ($setting) {
            if (!empty($setting->payload['file_path']) && Storage::disk('public')->exists($setting->payload['file_path'])) {
                Storage::disk('public')->delete($setting->payload['file_path']);
            }
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Peta Mal berhasil dihapus.');
    }
}
