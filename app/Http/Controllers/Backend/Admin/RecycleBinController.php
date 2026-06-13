<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Tenant;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\Promo;
use App\Models\Gallery;

class RecycleBinController extends Controller
{
    public function index()
    {
        $counts = [
            'tenants' => Tenant::onlyTrashed()->count(),
            'categories' => Category::onlyTrashed()->count(),
            'events' => Event::onlyTrashed()->count(),
            'event_photos' => EventPhoto::onlyTrashed()->count(),
            'promos' => Promo::onlyTrashed()->count(),
            'galleries' => Gallery::onlyTrashed()->count(),
        ];

        return view('backend.admin.recycle-bin.index', compact('counts'));
    }

    public function data(Request $request)
    {
        $type = $request->get('type');

        switch ($type) {
            case 'categories':
                $query = Category::onlyTrashed()->select(['id', 'uuid', 'name', 'color_zone', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->editColumn('color_zone', function ($row) {
                        if ($row->color_zone) {
                            return '<div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 25px; height: 25px; background-color: ' . $row->color_zone . '; border: 2px solid #ddd; border-radius: 4px;"></div>
                                <span style="font-family: monospace; font-weight: 600;">' . strtoupper($row->color_zone) . '</span>
                            </div>';
                        }
                        return '<span class="text-muted">-</span>';
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox', 'color_zone'])
                    ->make(true);

            case 'tenants':
                $query = Tenant::onlyTrashed()->with('category')->select(['id', 'uuid', 'name', 'type', 'category_id', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->addColumn('category', function ($row) {
                        return $row->category->name ?? '-';
                    })
                    ->editColumn('type', function ($row) {
                        return ucfirst($row->type);
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox'])
                    ->make(true);

            case 'events':
                $query = Event::onlyTrashed()->select(['id', 'uuid', 'name', 'type', 'start_date', 'end_date', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->editColumn('type', function ($row) {
                        return ucfirst($row->type);
                    })
                    ->editColumn('start_date', function ($row) {
                        return date_format(date_create($row->start_date), 'd M Y');
                    })
                    ->editColumn('end_date', function ($row) {
                        return date_format(date_create($row->end_date), 'd M Y');
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox'])
                    ->make(true);

            case 'event_photos':
                $query = EventPhoto::onlyTrashed()->with('event')->select(['id', 'event_id', 'path', 'caption', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->addColumn('event', function ($row) {
                        return $row->event->name ?? '-';
                    })
                    ->addColumn('photo', function ($row) {
                        return '<img src="' . asset('storage/' . $row->path) . '" class="rounded-1" style="max-width: 100px; max-height: 100px; object-fit: cover;">';
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox', 'photo'])
                    ->make(true);

            case 'promos':
                $query = Promo::onlyTrashed()->with('tenant')->select(['id', 'tenant_id', 'name', 'start_date', 'end_date', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->addColumn('tenant', function ($row) {
                        return $row->tenant->name ?? '-';
                    })
                    ->editColumn('start_date', function ($row) {
                        return date_format(date_create($row->start_date), 'd M Y');
                    })
                    ->editColumn('end_date', function ($row) {
                        return date_format(date_create($row->end_date), 'd M Y');
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox'])
                    ->make(true);

            case 'galleries':
                $query = Gallery::onlyTrashed()->select(['id', 'path', 'title', 'deleted_at']);
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input select-item" value="' . $row->id . '">';
                    })
                    ->addColumn('photo', function ($row) {
                        return '<img src="' . asset('storage/' . $row->path) . '" class="rounded-1" style="max-width: 100px; max-height: 100px; object-fit: cover;">';
                    })
                    ->editColumn('deleted_at', function ($row) {
                        return $row->deleted_at->format('d M Y H:i');
                    })
                    ->rawColumns(['checkbox', 'photo'])
                    ->make(true);

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
    }

    public function restore(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $type = $request->input('type');
        $ids = $request->input('ids');

        $modelClass = $this->getModelClass($type);
        if (!$modelClass) {
            return response()->json(['success' => false, 'message' => 'Invalid model type.'], 400);
        }

        try {
            $items = $modelClass::onlyTrashed()->whereIn('id', $ids)->get();
            foreach ($items as $item) {
                $item->restore();
            }

            return response()->json([
                'success' => true,
                'message' => 'Selected items restored successfully.',
                'counts' => [
                    'tenants' => Tenant::onlyTrashed()->count(),
                    'categories' => Category::onlyTrashed()->count(),
                    'events' => Event::onlyTrashed()->count(),
                    'event_photos' => EventPhoto::onlyTrashed()->count(),
                    'promos' => Promo::onlyTrashed()->count(),
                    'galleries' => Gallery::onlyTrashed()->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore items: ' . $e->getMessage()
            ], 500);
        }
    }

    public function forceDelete(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $type = $request->input('type');
        $ids = $request->input('ids');

        $modelClass = $this->getModelClass($type);
        if (!$modelClass) {
            return response()->json(['success' => false, 'message' => 'Invalid model type.'], 400);
        }

        try {
            $items = $modelClass::onlyTrashed()->whereIn('id', $ids)->get();
            foreach ($items as $item) {
                $item->forceDelete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Selected items permanently deleted.',
                'counts' => [
                    'tenants' => Tenant::onlyTrashed()->count(),
                    'categories' => Category::onlyTrashed()->count(),
                    'events' => Event::onlyTrashed()->count(),
                    'event_photos' => EventPhoto::onlyTrashed()->count(),
                    'promos' => Promo::onlyTrashed()->count(),
                    'galleries' => Gallery::onlyTrashed()->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete items: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getModelClass($type)
    {
        switch ($type) {
            case 'categories': return Category::class;
            case 'tenants': return Tenant::class;
            case 'events': return Event::class;
            case 'event_photos': return EventPhoto::class;
            case 'promos': return Promo::class;
            case 'galleries': return Gallery::class;
            default: return null;
        }
    }
}
