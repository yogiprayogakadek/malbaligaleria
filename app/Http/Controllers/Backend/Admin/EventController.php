<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAll(['uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'is_active']);

        return view('backend.admin.event.index', compact('events'));
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
