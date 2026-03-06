<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventPhotoRequest;
use App\Http\Requests\UpdateEventPhotoRequest;
use App\Services\EventService;
use App\Services\EventPhotoService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventPhotoController extends Controller
{
    protected $eventPhotoService, $eventService;

    public function __construct(EventPhotoService $eventPhotoService, EventService $eventService)
    {
        $this->eventPhotoService = $eventPhotoService;
        $this->eventService = $eventService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $eventPhotos = $this->eventPhotoService->getAll();

            return DataTables::of($eventPhotos)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src="' . asset("storage/" . $row->path) . '"
                    alt="' . $row->caption . '" class="rounded-1"
                    style="width: 200px; height: 200px">';
                })
                ->addColumn('name', function ($row) {
                    return $row->event->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.event.photo.edit', $row->event_id) . '">
                        <button type="button"
                            class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                            <i class="ti ti-pencil fs-4 me-2"></i>
                            Edit
                        </button>
                    </a>

                    <button type="button"
                        class="justify-content-center w-80 btn mb-1 bg-danger-subtle text-danger btn-delete"
                        data-id="' . $row->event_id . '">
                        <i class="ti ti-trash fs-4 me-2"></i>
                        Delete
                    </button>
                    ';
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }


        return view('backend.admin.event-photo.index');
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
            'path'      => $request->path,
            'album'     => $request->file('album')
        ];

        $this->eventPhotoService->create($data);

        return redirect()->route('admin.event.photo.index')->with('success', 'Photo saved successfully');
    }

    public function edit($event_id)
    {
        $eventPhoto = $this->eventPhotoService->findByEventId($event_id, true);

        $album = $this->eventPhotoService->getPhotoIsPrimary($event_id, false)->map(function ($photo) {
            return [
                'path' => asset('storage/' . $photo->path),
                'id' => $photo->id
            ];
        });


        return view('backend.admin.event-photo.edit', compact('eventPhoto', 'album'));
    }

    public function update(UpdateEventPhotoRequest $request, $event_id)
    {
        $data = [
            'caption'   => $request->caption,
            'album'     => $request->file('album')
        ];

        if ($request->path != '') {
            $data['path'] = $request->path;
        }

        $this->eventPhotoService->update($data, $event_id);
        return redirect()->route('admin.event.photo.index')->with('success', 'Photo updated successfully');
    }

    public function delete($id)
    {
        $this->eventPhotoService->delete($id);
    }
}
