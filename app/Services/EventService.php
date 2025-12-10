<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public function getEventsByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->eventRepository->getEventsByStatus($fields, $is_active);
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
        // if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
        //     $data['logo'] = $this->uploadImage($data['logo']);
        // }

        return $this->eventRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        // $tenant = $this->eventRepository->findByUuid($uuid, ['id', 'logo']);

        // if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
        //     if (!empty($tenant->logo)) {
        //         $this->deleteImage($tenant->logo);
        //     }
        //     $data['logo'] = $this->uploadImage($data['logo']);
        // }
        return $this->eventRepository->update($data, $uuid);
    }

    public function delete(int $id)
    {
        return $this->eventRepository->delete($id);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('event_images', 'public');
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
