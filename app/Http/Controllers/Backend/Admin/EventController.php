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
            $events = $this->eventService->getAll(['uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'is_regular', 'is_exhibition', 'recurring_label']);

            return DataTables::of($events)
                ->addIndexColumn()
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('is_regular', function ($row) {
                    if ($row->is_exhibition) {
                        return '<span class="badge" style="background:#4a6fa5;color:#fff;"><i class="ti ti-building-store me-1"></i>Exhibition</span>';
                    }
                    return $row->is_regular
                        ? '<span class="badge" style="background:#c9a96e;color:#fff;"><i class="ti ti-repeat me-1"></i>Regular</span>'
                        : '<span class="badge bg-secondary">One-time</span>';
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
                ->rawColumns(['action', 'is_active', 'is_regular'])
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
        $isRegular = $request->boolean('is_regular');

        $data = [
            'name'            => $request->name,
            'start_date'      => $isRegular ? null : $request->start_date,
            'end_date'        => $isRegular ? null : $request->end_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'description'     => $request->description,
            'location'        => $request->location,
            'organizer'       => $request->organizer,
            'is_paid'         => $request->is_paid,
            'price'           => $request->price,
            'target_audience' => $request->target_audience,
            'highlights'      => $request->highlights,
            'is_regular'      => $isRegular,
            'is_exhibition'   => $request->boolean('is_exhibition'),
            'recurring_days'  => $isRegular ? $request->recurring_days : null,
            'recurring_label' => $isRegular ? $request->recurring_label : null,
        ];

        $this->eventService->create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event saved successfully');
    }

    public function edit($uuid)
    {
        $event = $this->eventService->findByUuid($uuid, ['uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'is_regular', 'is_exhibition', 'recurring_days', 'recurring_label']);

        return view('backend.admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, $uuid)
    {
        $isRegular = $request->boolean('is_regular');

        $data = [
            'name'            => $request->name,
            'start_date'      => $isRegular ? null : $request->start_date,
            'end_date'        => $isRegular ? null : $request->end_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'description'     => $request->description,
            'location'        => $request->location,
            'organizer'       => $request->organizer,
            'is_paid'         => $request->is_paid,
            'price'           => $request->price,
            'target_audience' => $request->target_audience,
            'highlights'      => $request->highlights,
            'is_active'       => $request->is_active,
            'is_regular'      => $isRegular,
            'is_exhibition'   => $request->boolean('is_exhibition'),
            'recurring_days'  => $isRegular ? $request->recurring_days : null,
            'recurring_label' => $isRegular ? $request->recurring_label : null,
        ];

        $this->eventService->update($data, $uuid);

        return redirect()->route('admin.event.index')->with('success', 'Event updated successfully');
    }
}
