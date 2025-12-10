<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventPhotoRequest;
use App\Http\Requests\UpdateEventPhotoRequest;
use App\Services\EventService;
use App\Services\EventPhotoService;
use Illuminate\Http\Request;

class EventPhotoController extends Controller
{
    protected $eventPhotoService, $eventService;

    public function __construct(EventPhotoService $eventPhotoService, EventService $eventService)
    {
        $this->eventPhotoService = $eventPhotoService;
        $this->eventService = $eventService;
    }

    public function index()
    {
        $eventPhotos = $this->eventPhotoService->getAll();

        return view('backend.admin.event-photo.index', compact('eventPhotos'));
    }

    public function create()
    {
        $events = $this->eventService->findEmptyPhotoEvents(['id', 'uuid', 'name']);

        return view('backend.admin.event-photo.create', compact('events'));
    }

    public function store(StoreEventPhotoRequest $request)
    {
        $data = [
            'event_id' => $request->event_id,
            'caption'   => $request->caption,
            'is_primary'    => true,
            'path'      => $request->path
        ];

        $this->eventPhotoService->create($data);

        return redirect()->route('admin.event.photo.index')->with('success', 'Photo saved successfully');
    }

    public function edit($id)
    {
        $eventPhoto = $this->eventPhotoService->findById($id);

        return view('backend.admin.event-photo.edit', compact('eventPhoto'));
    }

    public function update(UpdateEventPhotoRequest $request, $id)
    {
        $data = [
            'caption'   => $request->caption,
            // 'path'      => $request->path
        ];

        if ($request->path != '') {
            $data['path'] = $request->path;
        }

        $this->eventPhotoService->update($data, $id);
        return redirect()->route('admin.event.photo.index')->with('success', 'Photo updated successfully');
    }

    public function delete($id)
    {
        $this->eventPhotoService->delete($id);
    }
}
