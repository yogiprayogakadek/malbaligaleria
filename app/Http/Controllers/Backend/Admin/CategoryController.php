<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = $this->categoryService->getAll(['uuid', 'name', 'color_zone', 'is_active'], true);

            return DataTables::of($categories)
                ->addIndexColumn()
                ->editColumn('color_zone', function ($row) {
                    if ($row->color_zone) {
                        return '<div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 30px; height: 30px; background-color: ' . $row->color_zone . '; border: 2px solid #ddd; border-radius: 6px;"></div>
                            <span style="font-family: monospace; font-weight: 600;">' . strtoupper($row->color_zone) . '</span>
                        </div>';
                    }
                    return '<span class="text-muted">-</span>';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.category.edit', $row->uuid) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>';
                })
                ->rawColumns(['action', 'is_active', 'color_zone'])
                ->make(true);
        }
        return view('backend.admin.category.index');
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'color_zone' => $request->color_zone,
        ];

        $this->categoryService->create($data);

        return redirect()->route('admin.category.index')->with('success', 'Category saved successfully');
    }

    public function edit($uuid)
    {
        $category = $this->categoryService->findByUuid($uuid, ['name', 'color_zone', 'uuid', 'is_active']);
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $uuid)
    {
        $data = [
            'name' => $request->name,
            'color_zone' => $request->color_zone,
            'is_active' => $request->is_active
        ];

        $this->categoryService->update($data, $uuid);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }
}
