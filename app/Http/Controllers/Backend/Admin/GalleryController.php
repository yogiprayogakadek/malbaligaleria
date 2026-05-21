<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $galleries = $this->galleryService->getAll();

            return DataTables::of($galleries)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src="' . asset("storage/" . $row->path) . '"
                    alt="' . ($row->title ?? 'Gallery Photo') . '" class="rounded-1"
                    style="max-width: 150px; max-height: 150px; object-fit: cover;">';
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_active) {
                        return '<span class="badge bg-success-subtle text-success">Active</span>';
                    }
                    return '<span class="badge bg-danger-subtle text-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.gallery.edit', $row->id) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>

                    <button type="button"
                        class="justify-content-center w-80 btn mb-1 bg-danger-subtle text-danger btn-delete"
                        data-id="' . $row->id . '">
                        <i class="ti ti-trash fs-4 me-2"></i>
                        Delete
                    </button>
                    ';
                })
                ->rawColumns(['photo', 'status', 'action'])
                ->make(true);
        }

        return view('backend.admin.gallery.index');
    }

    public function create()
    {
        return view('backend.admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $data = [
            'image_file' => $request->file('image_file'),
            'title' => $request->title,
            'is_active' => (bool) $request->is_active,
            'sort_order' => (int) $request->sort_order,
        ];

        $this->galleryService->create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photo saved successfully.');
    }

    public function edit($id)
    {
        $gallery = $this->galleryService->findById($id);
        return view('backend.admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'is_active' => (bool) $request->is_active,
            'sort_order' => (int) $request->sort_order,
        ];

        if ($request->hasFile('image_file')) {
            $data['image_file'] = $request->file('image_file');
        }

        $this->galleryService->update($data, $id);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photo updated successfully.');
    }

    public function delete($id)
    {
        $this->galleryService->delete($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Gallery photo deleted successfully.'
        ]);
    }
}
