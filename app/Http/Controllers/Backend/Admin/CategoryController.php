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
            $categories = $this->categoryService->getCategoriesByStatus(['uuid', 'name', 'is_active'], true);

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Not Active</span>';
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
                ->rawColumns(['action', 'is_active'])
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
            'name' => $request->name
        ];

        $this->categoryService->create($data);

        return redirect()->route('admin.category.index')->with('success', 'Category saved successfully');
    }

    public function edit($uuid)
    {
        $category = $this->categoryService->findByUuid($uuid, ['name', 'uuid']);
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $uuid)
    {
        $data = [
            'name' => $request->name
        ];

        $this->categoryService->update($data, $uuid);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    // public
}
