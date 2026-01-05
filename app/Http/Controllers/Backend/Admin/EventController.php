<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $events = $this->eventService->getAll(['uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'is_active']);

            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Not Active</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.event.edit', $row->uuid) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>                    ';
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }

        return view('backend.admin.event.index');
    }

    public function create()
    {
        return view('backend.admin.event.create');
    }

    public function store(StoreEventRequest $request)
    {
        $data = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            // 'is_active' => $request->is_active
        ];

        $this->eventService->create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event saved successfully');
    }

    public function edit($uuid)
    {
        $event = $this->eventService->findByUuid($uuid, ['uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'is_active']);

        return view('backend.admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, $uuid)
    {
        $data = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            'is_active' => $request->is_active
        ];

        $this->eventService->update($data, $uuid);

        return redirect()->route('admin.event.index')->with('success', 'Event updated successfully');
    }
}
