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
            $announcements = Announcement::select(['id', 'title', 'type', 'start_date', 'end_date', 'is_active', 'image', 'link']);

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
                    return $row->start_date ? $row->start_date->format('d M Y H:i') : '-';
                })
                ->editColumn('end_date', function ($row) {
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
                ->rawColumns(['checkbox', 'type', 'is_active', 'action'])
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
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'type' => 'required|string|in:info,warning,danger,success,primary',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'link' => 'nullable|url',
            'is_active' => 'nullable|in:0,1',
            'target_page' => 'required|string|in:all,homepage,career,promo,event',
            'frequency' => 'required|string|in:always,once_session,once_day,once_week',
        ]);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'link' => $request->link,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : false,
            'target_page' => $request->target_page,
            'frequency' => $request->frequency,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
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
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'type' => 'required|string|in:info,warning,danger,success,primary',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'link' => 'nullable|url',
            'is_active' => 'nullable|in:0,1',
            'target_page' => 'required|string|in:all,homepage,career,promo,event',
            'frequency' => 'required|string|in:always,once_session,once_day,once_week',
        ]);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'link' => $request->link,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : false,
            'target_page' => $request->target_page,
            'frequency' => $request->frequency,
        ];

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                $this->deleteImage($announcement->image);
            }
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($announcement->image) {
            $this->deleteImage($announcement->image);
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
                $this->deleteImage($announcement->image);
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
