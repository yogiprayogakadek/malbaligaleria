<?php

namespace App\Services;

use App\Repositories\EventPhotoRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public function create(array $data)
    {
        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            $data['path'] = $this->uploadImage($data['path']);
        }

        return $this->eventPhotoRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        $tenantPhoto = $this->eventPhotoRepository->findById($id, ['id', 'path']);

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            if (!empty($tenantPhoto->path)) {
                $this->deleteImage($tenantPhoto->path);
            }
            $data['path'] = $this->uploadImage($data['path']);
        }
        return $this->eventPhotoRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        $tenantPhoto = $this->findById($id);
        if (!empty($tenantPhoto->path)) {
            $this->deleteImage($tenantPhoto);
        }

        return $this->eventPhotoRepository->delete($id);
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
