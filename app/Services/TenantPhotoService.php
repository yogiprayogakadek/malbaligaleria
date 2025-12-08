<?php

namespace App\Services;

use App\Repositories\TenantPhotoRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TenantPhotoService
{

    protected $tenantPhotoRepository;

    public function __construct(TenantPhotoRepository $tenantPhotoRepository)
    {
        $this->tenantPhotoRepository = $tenantPhotoRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->tenantPhotoRepository->getAll($fields);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->tenantPhotoRepository->findById($id, $fields);
    }

    public function create(array $data)
    {
        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            $data['path'] = $this->uploadImage($data['path']);
        }

        return $this->tenantPhotoRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        $tenantPhoto = $this->tenantPhotoRepository->findById($id, ['id', 'path']);

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            if (!empty($tenantPhoto->path)) {
                $this->deleteImage($tenantPhoto->path);
            }
            $data['path'] = $this->uploadImage($data['path']);
        }
        return $this->tenantPhotoRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        $tenantPhoto = $this->findById($id);
        if (!empty($tenantPhoto->path)) {
            $this->deleteImage($tenantPhoto);
        }

        return $this->tenantPhotoRepository->delete($id);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('tenant_images', 'public');
        return $path;
    }

    public function deleteImage(string $imagePath)
    {
        $relativePath = 'tenant_images/' . basename($imagePath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
