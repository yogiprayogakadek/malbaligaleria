<?php

namespace App\Services;

use App\Repositories\EventPhotoRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class EventPhotoService
{

    protected $eventPhotoRepository;

    public function __construct(EventPhotoRepository $eventPhotoRepository)
    {
        $this->eventPhotoRepository = $eventPhotoRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->eventPhotoRepository->getAll($fields);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->eventPhotoRepository->findById($id, $fields);
    }

    public function findByEventId(int $event_id, bool $is_primary = false, array $fields = ['*'])
    {
        return $this->eventPhotoRepository->findByEventId($event_id, $is_primary, $fields);
    }

    public function getPhotoIsPrimary(int $event_id, bool $is_primary = false, array $fields = ['*'])
    {
        return $this->eventPhotoRepository->getPhotoIsPrimary($event_id, $is_primary, $fields);
    }

    public function create(array $data)
    {
        $eventId = $data['event_id'];
        $caption = $data['caption'] ?? 'event image';
        $results = [];

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            $primaryData = [
                'event_id'  => $eventId,
                'caption'    => $caption,
                'is_primary' => true,
                'path'       => $this->uploadImage($data['path'])
            ];
            $results[] = $this->eventPhotoRepository->create($primaryData);
        }

        if (isset($data['album']) && is_array($data['album'])) {
            foreach ($data['album'] as $index => $file) {
                if ($file instanceof UploadedFile) {
                    $albumData = [
                        'event_id'   => $eventId,
                        'caption'    => $caption,
                        'is_primary' => false,
                        'sort_order' => $index,
                        'path'       => $this->uploadImage($file)
                    ];
                    $results[] = $this->eventPhotoRepository->create($albumData);
                }
            }
        }

        return $results;
    }

    public function update(array $data, int $event_id)
    {
        $album = $this->eventPhotoRepository->getPhotoIsPrimary($event_id, false, ['id', 'path']);
        $eventPhotoPrimary = $this->eventPhotoRepository->findByEventId($event_id, true, ['id', 'path']);

        $caption = $data['caption'];
        $results = [];

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            if (!empty($eventPhotoPrimary->path)) {
                $this->deleteImage($eventPhotoPrimary->path);
            }
            $data['path'] = $this->uploadImage($data['path']);
            $results[] = $this->eventPhotoRepository->update($data, $eventPhotoPrimary->id);
        }

        if (isset($data['album']) && is_array($data['album'])) {
            foreach ($album as $al) {
                $al->forceDelete();
            }

            foreach ($data['album'] as $index => $file) {
                if ($file instanceof UploadedFile) {
                    $albumData = [
                        'event_id'   => $event_id,
                        'caption'    => $caption,
                        'is_primary' => false,
                        'sort_order' => $index,
                        'path'       => $this->uploadImage($file)
                    ];
                    $results[] = $this->eventPhotoRepository->create($albumData);
                }
            }
        }

        return $results;
    }

    public function delete(int $id)
    {
        return $this->eventPhotoRepository->delete($id);
    }

    public function deleteByEventId(int $eventId)
    {
        return $this->eventPhotoRepository->deleteByEventId($eventId);
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
