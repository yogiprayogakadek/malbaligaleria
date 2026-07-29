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
            $filters = [
                'type' => $request->get('type'),
                'is_active' => $request->get('is_active'),
            ];

            $events = $this->eventService->getFilteredQuery(['uuid', 'name', 'type', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'is_regular', 'is_exhibition', 'recurring_label'], $filters);

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
                    return '<a href="' . route('admin.event.edit', $row->uuid) . '" class="btn btn-primary-subtle text-primary btn-sm me-1">
                            <i class="ti ti-pencil fs-4"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger-subtle text-danger btn-sm delete-btn" data-uuid="' . $row->uuid . '" data-name="' . $row->name . '">
                            <i class="ti ti-trash fs-4"></i> Delete
                        </button>';
                })
                ->rawColumns(['action', 'is_active', 'type'])
                ->make(true);
        }

        return view('backend.admin.event.index');
    }

    public function delete($uuid)
    {
        try {
            $this->eventService->deleteByUuid($uuid);
            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete event: ' . $e->getMessage()
            ], 500);
        }
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
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'description'     => $request->description,
            'location'        => $request->location,
            'organizer'       => $request->organizer,
            'is_paid'         => $request->is_paid,
            'price'           => $request->price,
            'target_audience' => $request->target_audience,
            'highlights'      => $request->highlights,
            'always_show'     => $request->always_show,
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
        $event = $this->eventService->findByUuid($uuid, ['uuid', 'name', 'type', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_active', 'always_show', 'is_regular', 'is_exhibition', 'recurring_days', 'recurring_label', 'specific_dates']);

        return view('backend.admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, $uuid)
    {
        $isRegular = $request->type === 'regular';
        $specificDates = $request->specific_dates ? explode(', ', $request->specific_dates) : null;

        $data = [
            'name'            => $request->name,
            'type'            => $request->type,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
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
            'always_show'     => $request->always_show,
            'is_regular'      => ($request->type === 'regular'),
            'is_exhibition'   => ($request->type === 'exhibition'),
            'recurring_days'  => $isRegular ? $request->recurring_days : null,
            'recurring_label' => $isRegular ? $request->recurring_label : null,
            'specific_dates'  => $isRegular ? $specificDates : null,
        ];

        $this->eventService->update($data, $uuid);

        return redirect()->route('admin.event.index')->with('success', 'Event updated successfully');
    }

    public function board(Request $request)
    {
        $setting = \App\Models\Setting::where('pages', 'dashboard_menu')
            ->where('name', 'calendar_kanban_visibility')
            ->where('is_active', true)
            ->first();

        $allowedRoles = $setting ? ($setting->payload['roles'] ?? []) : [];

        $user = auth()->user();
        $isSuperUser = $user->hasRole('superuser');

        // Check permission: superuser always has access, others only if allowed in settings
        $hasAccess = $isSuperUser || collect($allowedRoles)->contains(function($role) use ($user) {
            return $user->hasRole($role);
        });

        if (!$hasAccess) {
            abort(403, 'Unauthorized action.');
        }

        $allRoles = ['admin', 'hr', 'tenant'];

        return view('backend.admin.event.board', compact('allowedRoles', 'allRoles', 'isSuperUser'));
    }

    public function apiList(Request $request)
    {
        $query = \App\Models\Event::query();

        if ($request->has('start') && $request->has('end')) {
            $start = substr($request->start, 0, 10);
            $end = substr($request->end, 0, 10);
            $query->where(function($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end]);
            });
        }

        $events = $query->get();

        $formattedEvents = $events->map(function ($event) {
            $start = $event->start_date;
            if ($event->start_time) {
                $start .= 'T' . $event->start_time;
            }
            $end = $event->end_date;
            if ($event->end_time) {
                $end .= 'T' . $event->end_time;
            }

            // Colors based on status & type
            if (!$event->is_active) {
                $bg = '#ffebee';
                $border = '#ef5350';
                $text = '#c62828';
            } else {
                switch ($event->type) {
                    case 'regular':
                        $bg = '#fffdf0';
                        $border = '#c9a96e';
                        $text = '#8d703d';
                        break;
                    case 'special':
                        $bg = '#fff8e1';
                        $border = '#ffb300';
                        $text = '#ff8f00';
                        break;
                    case 'exhibition':
                        $bg = '#eef5fc';
                        $border = '#4a6fa5';
                        $text = '#2c4b75';
                        break;
                    default: // upcoming
                        $bg = '#f5f5f5';
                        $border = '#9e9e9e';
                        $text = '#424242';
                        break;
                }
            }

            return [
                'id' => $event->uuid,
                'title' => $event->name,
                'start' => $start,
                'end' => $end,
                'allDay' => empty($event->start_time),
                'backgroundColor' => $bg,
                'borderColor' => $border,
                'textColor' => $text,
                'extendedProps' => [
                    'uuid' => $event->uuid,
                    'type' => $event->type,
                    'location' => $event->location,
                    'organizer' => $event->organizer,
                    'is_active' => $event->is_active,
                    'description' => strip_tags($event->description),
                ]
            ];
        });

        return response()->json($formattedEvents);
    }

    public function apiUpdateDate(Request $request, $uuid)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $event = \App\Models\Event::where('uuid', $uuid)->firstOrFail();

        $startStr = $request->start_date;
        $endStr = $request->end_date;

        $startDate = substr($startStr, 0, 10);
        $startTime = strpos($startStr, 'T') !== false ? substr($startStr, 11, 8) : null;

        $event->start_date = $startDate;
        if ($startTime) {
            $event->start_time = $startTime;
        }

        if ($endStr) {
            $endDate = substr($endStr, 0, 10);
            $endTime = strpos($endStr, 'T') !== false ? substr($endStr, 11, 8) : null;
            $event->end_date = $endDate;
            if ($endTime) {
                $event->end_time = $endTime;
            }
        } else {
            $event->end_date = $startDate;
        }

        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event dates updated successfully.'
        ]);
    }

    public function apiUpdateKanban(Request $request, $uuid)
    {
        $request->validate([
            'column' => 'required|in:draft,regular,special,exhibition,upcoming'
        ]);

        $event = \App\Models\Event::where('uuid', $uuid)->firstOrFail();
        $column = $request->column;

        if ($column === 'draft') {
            $event->is_active = false;
        } else {
            $event->is_active = true;
            $event->type = $column;
            $event->is_regular = ($column === 'regular');
            $event->is_exhibition = ($column === 'exhibition');
        }

        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event status and type updated successfully.'
        ]);
    }

    public function saveSettings(Request $request)
    {
        if (!auth()->user()->hasRole('superuser')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }

        $roles = $request->input('roles', []);

        $setting = \App\Models\Setting::updateOrCreate(
            [
                'pages' => 'dashboard_menu',
                'name' => 'calendar_kanban_visibility',
            ],
            [
                'description' => 'Dashboard visibility for Event Board (Calendar & Kanban)',
                'type' => 'custom',
                'is_active' => true,
                'payload' => ['roles' => $roles]
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Visibility settings updated successfully.'
        ]);
    }
}

