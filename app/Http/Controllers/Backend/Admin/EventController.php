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
            $events = $this->eventService->getAll(['uuid', 'name', 'type', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'is_regular', 'is_exhibition', 'recurring_label']);

            return DataTables::of($events)
                ->addIndexColumn()
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == true
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('type', function ($row) {
                    $badges = [
                        'regular'    => '<span class="badge" style="background:#c9a96e;color:#fff;"><i class="ti ti-repeat me-1"></i>Regular</span>',
                        'special'    => '<span class="badge" style="background:#e6b94d;color:#fff;"><i class="ti ti-star me-1"></i>Special</span>',
                        'exhibition' => '<span class="badge" style="background:#4a6fa5;color:#fff;"><i class="ti ti-building-store me-1"></i>Exhibition</span>',
                        'upcoming'   => '<span class="badge bg-secondary">Upcoming</span>',
                    ];
                    return $badges[$row->type] ?? $row->type;
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
                ->rawColumns(['action', 'is_active', 'type'])
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
        $isRegular = $request->type === 'regular';
        $specificDates = $request->specific_dates ? explode(', ', $request->specific_dates) : null;
        
        $data = [
            'name'            => $request->name,
            'type'            => $request->type,
            'start_date'      => ($request->type === 'regular' && !$request->start_date) ? null : $request->start_date,
            'end_date'        => ($request->type === 'regular' && !$request->end_date) ? null : $request->end_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'description'     => $request->description,
            'location'        => $request->location,
            'organizer'       => $request->organizer,
            'is_paid'         => $request->is_paid,
            'price'           => $request->price,
            'target_audience' => $request->target_audience,
            'highlights'      => $request->highlights,
            'is_regular'      => ($request->type === 'regular'),
            'is_exhibition'   => ($request->type === 'exhibition'),
            'recurring_days'  => $isRegular ? $request->recurring_days : null,
            'recurring_label' => $isRegular ? $request->recurring_label : null,
            'specific_dates'  => $isRegular ? $specificDates : null,
        ];

        $this->eventService->create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event saved successfully');
    }

    public function edit($uuid)
    {
        $event = $this->eventService->findByUuid($uuid, ['uuid', 'name', 'type', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'is_regular', 'is_exhibition', 'recurring_days', 'recurring_label', 'specific_dates']);

        return view('backend.admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, $uuid)
    {
        $isRegular = $request->type === 'regular';
        $specificDates = $request->specific_dates ? explode(', ', $request->specific_dates) : null;

        $data = [
            'name'            => $request->name,
            'type'            => $request->type,
            'start_date'      => ($request->type === 'regular' && !$request->start_date) ? null : $request->start_date,
            'end_date'        => ($request->type === 'regular' && !$request->end_date) ? null : $request->end_date,
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
            'is_regular'      => ($request->type === 'regular'),
            'is_exhibition'   => ($request->type === 'exhibition'),
            'recurring_days'  => $isRegular ? $request->recurring_days : null,
            'recurring_label' => $isRegular ? $request->recurring_label : null,
            'specific_dates'  => $isRegular ? $specificDates : null,
        ];

        $this->eventService->update($data, $uuid);

        return redirect()->route('admin.event.index')->with('success', 'Event updated successfully');
    }
}
