<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Helpers\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $announcements = Announcement::select(['id', 'title', 'type', 'start_date', 'end_date', 'active_dates', 'start_time', 'end_time', 'is_active', 'image', 'link']);

            return DataTables::of($announcements)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="checkbox" data-id="' . $row->id . '">';
                })
                ->editColumn('type', function ($row) {
                    $class = $row->type === 'danger' ? 'danger' : ($row->type === 'warning' ? 'warning' : ($row->type === 'success' ? 'success' : ($row->type === 'primary' ? 'primary' : 'info')));
                    return '<span class="badge bg-' . $class . '">' . ucfirst($row->type) . '</span>';
                })
                ->editColumn('start_date', function ($row) {
                    $timeSuffix = '';
                    if ($row->start_time && $row->end_time) {
                        $timeSuffix = '<br><small class="text-muted"><i class="ti ti-clock"></i> ' . date('H:i', strtotime($row->start_time)) . ' - ' . date('H:i', strtotime($row->end_time)) . '</small>';
                    }
                    if (!empty($row->active_dates) && is_array($row->active_dates)) {
                        $ranges = [];
                        foreach ($row->active_dates as $r) {
                            if (is_array($r) && isset($r['start']) && isset($r['end'])) {
                                if ($r['start'] === $r['end']) {
                                    $ranges[] = date('d M Y', strtotime($r['start']));
                                } else {
                                    $ranges[] = date('d M Y', strtotime($r['start'])) . ' - ' . date('d M Y', strtotime($r['end']));
                                }
                            } elseif (is_string($r)) {
                                $ranges[] = date('d M Y', strtotime($r));
                            }
                        }
                        return '<span class="badge bg-primary text-white" data-bs-toggle="tooltip" data-bs-html="true" title="' . implode('<br>', $ranges) . '">' . count($ranges) . ' Date Slot(s)</span>' . $timeSuffix;
                    }
                    return ($row->start_date ? $row->start_date->format('d M Y H:i') : '-') . $timeSuffix;
                })
                ->editColumn('end_date', function ($row) {
                    if (!empty($row->active_dates) && is_array($row->active_dates)) {
                        return '-';
                    }
                    return $row->end_date ? $row->end_date->format('d M Y H:i') : '-';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.announcement.edit', $row->id) . '" class="btn btn-sm btn-primary me-2"><i class="ti ti-pencil"></i></a>';
                    $btn .= '<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'type', 'is_active', 'start_date', 'action'])
                ->make(true);
        }

        return view('backend.admin.announcement.index');
    }

    public function create()
    {
        return view('backend.admin.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'mimes:png,jpg,jpeg,webp|max:2048',
            'type' => 'required|string|in:info,warning,danger,success,primary',
            'date_type' => 'required|string|in:range,multiple',
            'start_date' => 'nullable|required_if:date_type,range|date',
            'end_date' => 'nullable|required_if:date_type,range|date|after_or_equal:start_date',
            'active_date_ranges' => 'nullable|required_if:date_type,multiple|array',
            'active_date_ranges.*' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|required_with:start_time|date_format:H:i',
            'link' => 'nullable|url',
            'is_active' => 'nullable|in:0,1',
            'target_page' => 'required|array|min:1',
            'target_page.*' => 'required|string|in:all,homepage,career,promo,event,directory,new_store,gallery',
            'frequency' => 'required|string|in:always,once_session,once_day,once_week',
        ]);

        $activeDates = null;
        if ($request->date_type === 'multiple' && $request->filled('active_date_ranges')) {
            $activeDates = [];
            foreach ($request->active_date_ranges as $rangeStr) {
                if (empty($rangeStr)) continue;
                $parts = explode(' to ', $rangeStr);
                $start = trim($parts[0]);
                $end = isset($parts[1]) ? trim($parts[1]) : $start;
                if ($start) {
                    $activeDates[] = [
                        'start' => $start,
                        'end' => $end
                    ];
                }
            }
        }

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'start_date' => $request->date_type === 'range' ? $request->start_date : null,
            'end_date' => $request->date_type === 'range' ? $request->end_date : null,
            'active_dates' => $request->date_type === 'multiple' ? $activeDates : null,
            'start_time' => $request->filled('start_time') ? $request->start_time : null,
            'end_time' => $request->filled('end_time') ? $request->end_time : null,
            'link' => $request->link,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : false,
            'target_page' => $request->target_page,
            'frequency' => $request->frequency,
        ];

        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $imageFile) {
                $uploadedImages[] = $this->uploadImage($imageFile);
            }
            $data['image'] = json_encode($uploadedImages);
        }

        Announcement::create($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Announcement created successfully.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('backend.admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'mimes:png,jpg,jpeg,webp|max:2048',
            'type' => 'required|string|in:info,warning,danger,success,primary',
            'date_type' => 'required|string|in:range,multiple',
            'start_date' => 'nullable|required_if:date_type,range|date',
            'end_date' => 'nullable|required_if:date_type,range|date|after_or_equal:start_date',
            'active_date_ranges' => 'nullable|required_if:date_type,multiple|array',
            'active_date_ranges.*' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|required_with:start_time|date_format:H:i',
            'link' => 'nullable|url',
            'is_active' => 'nullable|in:0,1',
            'target_page' => 'required|array|min:1',
            'target_page.*' => 'required|string|in:all,homepage,career,promo,event,directory,new_store,gallery',
            'frequency' => 'required|string|in:always,once_session,once_day,once_week',
        ]);

        $activeDates = null;
        if ($request->date_type === 'multiple' && $request->filled('active_date_ranges')) {
            $activeDates = [];
            foreach ($request->active_date_ranges as $rangeStr) {
                if (empty($rangeStr)) continue;
                $parts = explode(' to ', $rangeStr);
                $start = trim($parts[0]);
                $end = isset($parts[1]) ? trim($parts[1]) : $start;
                if ($start) {
                    $activeDates[] = [
                        'start' => $start,
                        'end' => $end
                    ];
                }
            }
        }

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'start_date' => $request->date_type === 'range' ? $request->start_date : null,
            'end_date' => $request->date_type === 'range' ? $request->end_date : null,
            'active_dates' => $request->date_type === 'multiple' ? $activeDates : null,
            'start_time' => $request->filled('start_time') ? $request->start_time : null,
            'end_time' => $request->filled('end_time') ? $request->end_time : null,
            'link' => $request->link,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : false,
            'target_page' => $request->target_page,
            'frequency' => $request->frequency,
        ];

        $existingImages = $request->input('existing_images');
        $finalImages = [];

        // Delete any existing images that were removed by the user
        if ($announcement->image) {
            $keptExisting = is_array($existingImages) ? $existingImages : [];
            foreach ($announcement->images as $oldImage) {
                if (!in_array($oldImage, $keptExisting)) {
                    $this->deleteImage($oldImage);
                }
            }
        }

        // Keep existing images in their user-defined reordered sequence
        if (is_array($existingImages)) {
            foreach ($existingImages as $imgPath) {
                // Ensure the image path belongs to this announcement for security
                if (in_array($imgPath, $announcement->images)) {
                    $finalImages[] = $imgPath;
                }
            }
        }

        // Upload and append new images in their reordered sequence
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $finalImages[] = $this->uploadImage($imageFile);
            }
        }

        if (count($finalImages) > 0) {
            $data['image'] = json_encode(array_values($finalImages));
        } else {
            $data['image'] = null;
        }

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($announcement->image) {
            foreach ($announcement->images as $oldImage) {
                $this->deleteImage($oldImage);
            }
        }
        $announcement->delete();

        return response()->json(['success' => 'Announcement deleted successfully.']);
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $announcements = Announcement::whereIn('id', $request->ids)->get();
        foreach ($announcements as $announcement) {
            if ($announcement->image) {
                foreach ($announcement->images as $oldImage) {
                    $this->deleteImage($oldImage);
                }
            }
            $announcement->delete();
        }

        return response()->json(['success' => 'Selected announcements deleted successfully.']);
    }

    private function uploadImage(UploadedFile $file)
    {
        $path = $file->store('announcement_images', 'public');
        ImageOptimizer::optimize($path);
        return $path;
    }

    private function deleteImage(string $imagePath)
    {
        $relativePath = 'announcement_images/' . basename($imagePath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
