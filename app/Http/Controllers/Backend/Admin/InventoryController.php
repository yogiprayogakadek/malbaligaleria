<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\InventoryHistory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    // ==========================================
    // INVENTORY ITEMS
    // ==========================================

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = InventoryItem::with(['category', 'parent'])->select('inventory_items.*');

            // Apply filters
            if ($request->filled('category_id')) {
                $items->where('category_id', $request->category_id);
            }
            if ($request->filled('status')) {
                $items->where('status', $request->status);
            }
            if ($request->filled('location')) {
                $items->where('location', 'like', '%' . $request->location . '%');
            }

            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image_path) {
                        return '<img src="' . asset('storage/' . $row->image_path) . '" class="img-thumbnail" style="max-height: 50px; max-width: 50px; object-fit: cover;" />';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->editColumn('category', function ($row) {
                    return $row->category ? $row->category->name : '<span class="text-muted">-</span>';
                })
                ->editColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->name : '<span class="text-muted">None (Parent)</span>';
                })
                ->editColumn('status', function ($row) {
                    $badges = [
                        'active' => 'success',
                        'maintenance' => 'warning',
                        'broken' => 'danger',
                        'stored' => 'secondary'
                    ];
                    $badge = $badges[$row->status] ?? 'info';
                    return '<span class="badge bg-' . $badge . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('inventory.assets.history', $row->id) . '" class="btn btn-sm btn-info me-1" title="View History Log"><i class="ti ti-history"></i> Log</a>';
                    $btn .= '<a href="' . route('inventory.assets.edit', $row->id) . '" class="btn btn-sm btn-primary me-1" title="Edit Item"><i class="ti ti-pencil"></i></a>';
                    $btn .= '<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name) . '" title="Delete Item"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['image', 'category', 'parent', 'status', 'action'])
                ->make(true);
        }

        $categories = InventoryCategory::orderBy('name')->get();
        $locations = InventoryItem::whereNotNull('location')->distinct()->pluck('location')->filter();

        return view('backend.admin.inventory.index', compact('categories', 'locations'));
    }

    public function print(Request $request)
    {
        $query = InventoryItem::with(['category', 'parent']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $items = $query->orderBy('name')->get();
        $layout = $request->input('layout', 'table');

        $commonVars = [
            'category' => $request->filled('category_id') ? InventoryCategory::find($request->category_id) : null,
            'status'   => $request->status,
            'location' => $request->location,
        ];

        // ── Visual Hierarchy Tree (top-down) ──────────────────────────
        if ($layout === 'hierarchy') {
            $itemsMap = [];
            foreach ($items as $item) {
                $item->children = collect();
                $itemsMap[$item->id] = $item;
            }

            $roots = collect();
            foreach ($items as $item) {
                if ($item->parent_id && isset($itemsMap[$item->parent_id])) {
                    $itemsMap[$item->parent_id]->children->push($item);
                } else {
                    $roots->push($item);
                }
            }

            return view('backend.admin.inventory.print.hierarchy', array_merge($commonVars, [
                'roots' => $roots,
            ]));
        }

        // ── Indented Outline (text-based tree) ────────────────────────
        if ($layout === 'outline') {
            $itemsMap = [];
            foreach ($items as $item) {
                $item->children = collect();
                $itemsMap[$item->id] = $item;
            }

            $roots = collect();
            foreach ($items as $item) {
                if ($item->parent_id && isset($itemsMap[$item->parent_id])) {
                    $itemsMap[$item->parent_id]->children->push($item);
                } else {
                    $roots->push($item);
                }
            }

            return view('backend.admin.inventory.print.outline', array_merge($commonVars, [
                'roots' => $roots,
            ]));
        }

        // ── Grouped by Category ───────────────────────────────────────
        if ($layout === 'by_category') {
            $grouped = $items->groupBy(function ($item) {
                return $item->category ? $item->category->name : 'Tanpa Kategori';
            })->sortKeys();

            return view('backend.admin.inventory.print.by_category', array_merge($commonVars, [
                'items'   => $items,
                'grouped' => $grouped,
            ]));
        }

        // ── Grouped by Location ───────────────────────────────────────
        if ($layout === 'by_location') {
            $grouped = $items->groupBy(function ($item) {
                return $item->location ?: 'Tanpa Lokasi';
            })->sortKeys();

            return view('backend.admin.inventory.print.by_location', array_merge($commonVars, [
                'items'   => $items,
                'grouped' => $grouped,
            ]));
        }

        // ── Default: Table List ───────────────────────────────────────
        return view('backend.admin.inventory.print.table', array_merge($commonVars, [
            'items' => $items,
        ]));
    }


    public function create()
    {
        $categories = InventoryCategory::orderBy('name')->get();
        // Get potential parents (e.g. items that can act as parent assets)
        $parentItems = InventoryItem::orderBy('name')->get();

        return view('backend.admin.inventory.create', compact('categories', 'parentItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'nullable|exists:inventory_categories,id',
            'parent_id' => 'nullable|exists:inventory_items,id',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'status' => 'required|string|in:active,maintenance,broken,stored',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'specs_keys' => 'nullable|array',
            'specs_values' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Process specs dynamic array into JSON
        $specs = [];
        if ($request->filled('specs_keys') && $request->filled('specs_values')) {
            foreach ($request->specs_keys as $index => $key) {
                if (trim($key) !== '') {
                    $specs[trim($key)] = $request->specs_values[$index] ?? '';
                }
            }
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('inventory_images', 'public');
            ImageOptimizer::optimize($imagePath);
        }

        $item = InventoryItem::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'location' => $request->location,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'specs' => $specs,
            'notes' => $request->notes,
            'image_path' => $imagePath,
        ]);

        // Log history
        InventoryHistory::create([
            'inventory_item_id' => $item->id,
            'user_id' => Auth::id(),
            'action' => 'create',
            'notes' => 'Inventory item created.',
            'changes' => $item->toArray()
        ]);

        return redirect()->route('inventory.assets.index')->with('success', 'Inventory item created successfully.');
    }

    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        $categories = InventoryCategory::orderBy('name')->get();
        // Prevent setting parent_id to itself
        $parentItems = InventoryItem::where('id', '!=', $id)->orderBy('name')->get();

        return view('backend.admin.inventory.edit', compact('item', 'categories', 'parentItems'));
    }

    public function update(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'nullable|exists:inventory_categories,id',
            'parent_id' => 'nullable|exists:inventory_items,id|different:id',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'status' => 'required|string|in:active,maintenance,broken,stored',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'specs_keys' => 'nullable|array',
            'specs_values' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Process specs dynamic array into JSON
        $specs = [];
        if ($request->filled('specs_keys') && $request->filled('specs_values')) {
            foreach ($request->specs_keys as $index => $key) {
                if (trim($key) !== '') {
                    $specs[trim($key)] = $request->specs_values[$index] ?? '';
                }
            }
        }

        // Handle image upload / removal
        $imagePath = $item->image_path;
        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $imagePath = $request->file('image')->store('inventory_images', 'public');
            ImageOptimizer::optimize($imagePath);
        } elseif ($request->input('remove_image') === '1') {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $imagePath = null;
        }

        $oldData = $item->only(['category_id', 'parent_id', 'name', 'brand', 'model', 'serial_number', 'location', 'status', 'quantity', 'specs', 'notes', 'image_path']);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'location' => $request->location,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'specs' => $specs,
            'notes' => $request->notes,
            'image_path' => $imagePath,
        ]);

        $newData = $item->only(['category_id', 'parent_id', 'name', 'brand', 'model', 'serial_number', 'location', 'status', 'quantity', 'specs', 'notes', 'image_path']);

        $changes = [];
        foreach ($newData as $key => $val) {
            // Compare arrays or normal types
            if (is_array($val) || is_array($oldData[$key])) {
                if (json_encode($val) !== json_encode($oldData[$key])) {
                    $changes[$key] = [
                        'old' => $oldData[$key],
                        'new' => $val
                    ];
                }
            } else {
                if ($oldData[$key] != $val) {
                    $changes[$key] = [
                        'old' => $oldData[$key],
                        'new' => $val
                    ];
                }
            }
        }

        if (!empty($changes)) {
            InventoryHistory::create([
                'inventory_item_id' => $item->id,
                'user_id' => Auth::id(),
                'action' => 'update',
                'changes' => $changes,
                'notes' => 'Inventory item updated.'
            ]);
        }

        return redirect()->route('inventory.assets.index')->with('success', 'Inventory item updated successfully.');
    }

    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        
        InventoryHistory::create([
            'inventory_item_id' => $item->id,
            'user_id' => Auth::id(),
            'action' => 'delete',
            'notes' => 'Inventory item moved to trash.'
        ]);

        $item->delete();

        return response()->json(['success' => 'Inventory item deleted successfully.']);
    }

    public function history($id)
    {
        $item = InventoryItem::findOrFail($id);
        $logs = InventoryHistory::with('user')
            ->where('inventory_item_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.admin.inventory.history', compact('item', 'logs'));
    }

    // ==========================================
    // INVENTORY CATEGORIES
    // ==========================================

    public function categories(Request $request)
    {
        if ($request->ajax()) {
            $categories = InventoryCategory::select(['id', 'uuid', 'name', 'slug', 'description']);

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('inventory.categories.edit', $row->id) . '" class="btn btn-sm btn-primary me-1"><i class="ti ti-pencil"></i></a>';
                    $btn .= '<button type="button" class="btn btn-sm btn-danger btn-delete-cat" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name) . '"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.admin.inventory.category.index');
    }

    public function categoryCreate()
    {
        return view('backend.admin.inventory.category.create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:inventory_categories,name',
            'description' => 'nullable|string',
        ]);

        InventoryCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('inventory.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoryEdit($id)
    {
        $category = InventoryCategory::findOrFail($id);
        return view('backend.admin.inventory.category.edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = InventoryCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:inventory_categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('inventory.categories.index')->with('success', 'Category updated successfully.');
    }

    public function categoryDestroy($id)
    {
        $category = InventoryCategory::findOrFail($id);
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
