<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class EventService
{

    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->eventRepository->getAll($fields);
    }

    public function getFilteredQuery(array $fields = ['*'], array $filters = [])
    {
        return $this->eventRepository->getFilteredQuery($fields, $filters);
    }

    public function getEventsByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->eventRepository->getEventsByStatus($fields, $is_active);
    }

    public function getEventsWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->eventRepository->getEventsWithRelationship($fields, $relationship);
    }

    public function getRegularEvents(array $fields = ['*'], array $relationship)
    {
        return $this->eventRepository->getRegularEvents($fields, $relationship);
    }

    public function getExhibitionEvents(array $fields = ['*'], array $relationship)
    {
        return $this->eventRepository->getExhibitionEvents($fields, $relationship);
    }

    public function getEventsWithRelationshipAndCondition(array $fields = ['*'], array $relationship, string $column, string $condition)
    {
        return $this->eventRepository->getEventsWithRelationshipAndCondition($fields, $relationship, $column, $condition);
    }

    public function getUpcomingEvents(array $fields = ['*'], array $relationship, string $uuid)
    {
        return $this->eventRepository->getUpcomingEvents($fields, $relationship, $uuid);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->eventRepository->findById($id, $fields);
    }

    public function findByUuid(string $uuid, array $fields = ['*'])
    {
        return $this->eventRepository->findByUuid($uuid, $fields);
    }

    public function findEmptyPhotoEvents(array $fields = ['*'])
    {
        return $this->eventRepository->findEmptyPhotoEvents($fields);
    }

    public function create(array $data)
    {
        return $this->eventRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        return $this->eventRepository->update($data, $uuid);
    }

    public function delete(int $id)
    {
        return $this->eventRepository->delete($id);
    }

    public function deleteByUuid(string $uuid)
    {
        return $this->eventRepository->deleteByUuid($uuid);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('event_images', 'public');
        ImageOptimizer::optimize($path);
        return $path;
    }

    public function deleteImage(string $imagePath)
    {
        $relativePath = 'event_images/' . basename($imagePath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
