<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        // Hanya tampilkan event NON-regular (is_regular = false) yang aktif
        $events = $this->eventService->getEventsWithRelationship(
            ['id', 'uuid', 'name', 'start_date', 'end_date', 'description', 'location', 'is_paid'],
            [
                'primaryPhoto:id,event_id,path',
            ]
        );

        return view('frontend.event.index', compact('events'));
    }

    public function detail($uuid)
    {
        $event = $this->eventService->getEventsWithRelationshipAndCondition(
            ['id', 'uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights', 'is_regular', 'is_exhibition', 'recurring_label'],
            [
                'primaryPhoto:id,event_id,path',
                'photos:id,event_id,path,sort_order'
            ],
            'uuid',
            $uuid
        )->map(function ($e) {
            return [
                'id'              => $e->id,
                'uuid'            => $e->uuid,
                'name'            => $e->name,
                'start_date'      => $e->start_date ? date_format(date_create($e->start_date), 'd M Y') : null,
                'end_date'        => $e->end_date   ? date_format(date_create($e->end_date),   'd M Y') : null,
                'start_time'      => $e->start_time ? date_format(date_create($e->start_time), 'h:i A') : null,
                'end_time'        => $e->end_time   ? date_format(date_create($e->end_time),   'h:i A') : null,
                'description'     => $e->description,
                'location'        => $e->location,
                'organizer'       => $e->organizer,
                'is_paid'         => $e->is_paid,
                'price'           => $e->price,
                'target_audience' => $e->target_audience,
                'highlights'      => $e->highlights,
                'is_regular'      => $e->is_regular,
                'is_exhibition'   => $e->is_exhibition,
                'recurring_label' => $e->recurring_label,
                'primaryPhoto'    => $e->primaryPhoto ? asset('storage/' . $e->primaryPhoto->path) : asset('assets/images/no_image.jpg'),
                'photos'          => $e->photos->map(function ($photos) {
                    return $photos ? asset('storage/' . $photos->path) : asset('assets/images/no_image.jpg');
                })
            ];
        })->first();

        $upcomingEvents = $this->eventService->getUpcomingEvents(
            ['id', 'uuid', 'name', 'start_date'],
            [
                'primaryPhoto:id,event_id,path',
            ],
            $uuid
        );

        return view('frontend.event.detail', compact('event', 'upcomingEvents'));
    }
}
