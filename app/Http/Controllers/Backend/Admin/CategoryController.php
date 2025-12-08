<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getCategoriesByStatus(['uuid', 'name', 'is_active'], true);
        return view('backend.admin.category.index', compact('categories'));
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
