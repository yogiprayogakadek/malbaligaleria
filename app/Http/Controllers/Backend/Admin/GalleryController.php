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
            $query = \App\Models\Gallery::query();

            if ($request->filled('status')) {
                if ($request->status === 'active') {
                    $query->where('is_active', true);
                } elseif ($request->status === 'inactive') {
                    $query->where('is_active', false);
                }
            }

            $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="form-check-input select-photo" value="' . $row->id . '">';
                })
                ->addColumn('photo', function ($row) {
                    return '<img src="' . asset("storage/" . $row->path) . '"
                    alt="' . ($row->title ?? 'Gallery Photo') . '" class="rounded-1"
                    style="max-width: 150px; max-height: 150px; object-fit: cover;">';
                })
                ->editColumn('sort_order', function ($row) {
                    return '<input type="number" class="form-control form-control-sm text-center input-sort-order" value="' . $row->sort_order . '" data-id="' . $row->id . '" style="width: 80px; margin: 0 auto;" min="0">';
                })
                ->addColumn('status', function ($row) {
                    $activeClass = $row->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger';
                    $activeLabel = $row->is_active ? 'Active' : 'Inactive';
                    return '<button type="button" class="btn-toggle-status badge ' . $activeClass . ' border-0 py-1 px-2" data-id="' . $row->id . '" style="cursor: pointer;">' . $activeLabel . '</button>';
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
                ->rawColumns(['checkbox', 'photo', 'sort_order', 'status', 'action'])
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
            'image_files' => 'required|array',
            'image_files.*' => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $files = $request->file('image_files');
        $isActive = (bool) $request->is_active;

        // If a sort order is specified, use it as starting value, otherwise start from max + 1
        $startSortOrder = $request->sort_order;
        if (is_null($startSortOrder)) {
            $startSortOrder = (\App\Models\Gallery::max('sort_order') ?? 0) + 1;
        }

        foreach ($files as $index => $file) {
            $currentSortOrder = $startSortOrder + $index;

            if ($request->title) {
                $currentTitle = count($files) > 1 ? $request->title . ' - ' . ($index + 1) : $request->title;
            } else {
                $currentTitle = null;
            }

            $data = [
                'image_file' => $file,
                'title' => $currentTitle,
                'is_active' => $isActive,
                'sort_order' => $currentSortOrder,
            ];

            $this->galleryService->create($data);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photo(s) saved successfully.');
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

    public function toggleActive($id)
    {
        $gallery = $this->galleryService->findById($id);
        $newStatus = !$gallery->is_active;
        $this->galleryService->update(['is_active' => $newStatus], $id);

        return response()->json([
            'success' => true,
            'message' => 'Gallery photo status updated successfully.',
            'is_active' => $newStatus
        ]);
    }

    public function batchStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:galleries,id',
            'is_active' => 'required|boolean'
        ]);

        \App\Models\Gallery::whereIn('id', $request->ids)->update(['is_active' => $request->is_active]);

        $statusText = $request->is_active ? 'enabled' : 'disabled';
        return response()->json([
            'success' => true,
            'message' => "Successfully {$statusText} selected photos."
        ]);
    }

    public function batchClearTitle(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:galleries,id',
        ]);

        \App\Models\Gallery::whereIn('id', $request->ids)->update(['title' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully cleared titles for selected photos.'
        ]);
    }

    public function batchClearSort(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:galleries,id',
        ]);

        \App\Models\Gallery::whereIn('id', $request->ids)->update(['sort_order' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully reset sort order to 0 for selected photos.'
        ]);
    }

    public function updateSort(Request $request, $id)
    {
        $request->validate([
            'sort_order' => 'required|integer|min:0'
        ]);

        $this->galleryService->update(['sort_order' => (int) $request->sort_order], $id);

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
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
