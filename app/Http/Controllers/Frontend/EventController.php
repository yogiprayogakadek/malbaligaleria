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
        $events = $this->eventService->getEventsWithRelationshipAndCondition(
            ['id', 'uuid', 'name', 'start_date'],
            [
                'primaryPhoto:id,event_id,path',
            ],
            'is_active',
            true
        );

        return view('frontend.event.index', compact('events'));
    }

    public function detail($uuid)
    {
        $event = $this->eventService->getEventsWithRelationshipAndCondition(
            ['id', 'uuid', 'name', 'start_date', 'end_date', 'start_time', 'end_time', 'description', 'location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights'],
            [
                'primaryPhoto:id,event_id,path',
                'photos:id,event_id,path'
            ],
            'uuid',
            $uuid
        )->map(function ($e) {
            return [
                'id' => $e->id,
                'uuid' => $e->uuid,
                'name' => $e->name,
                'start_date' => date_format(date_create($e->start_date), 'd M Y'),
                'end_date' => date_format(date_create($e->end_date), 'd M Y'),
                'start_time' => date_format(date_create($e->start_time), 'h:i A'),
                'end_time' => date_format(date_create($e->end_time), 'h:i A'),
                'description' => $e->description,
                'location' => $e->location,
                'organizer' => $e->organizer,
                'is_paid' => $e->is_paid,
                'price' => $e->price,
                'target_audience' => $e->target_audience,
                'highlights' => $e->highlights,
                'primaryPhoto' => $e->primaryPhoto ? asset('storage/' . $e->primaryPhoto->path) : asset('assets/images/no_image.jpg'),
                'photos' => $e->photos->map(function ($photos) {
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
