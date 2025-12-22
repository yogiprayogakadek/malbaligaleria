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

    public function findByTenantId(int $tenant_id, bool $is_primary = false, array $fields = ['*'])
    {
        return $this->tenantPhotoRepository->findByTenantId($tenant_id, $is_primary, $fields);
    }

    public function getPhotoIsPrimary(int $tenant_id, bool $is_primary = false, array $fields = ['*'])
    {
        return $this->tenantPhotoRepository->getPhotoIsPrimary($tenant_id, $is_primary, $fields);
    }

    public function getByTenantId(int $tenant_id, array $fields = ['*'])
    {
        return $this->tenantPhotoRepository->getByTenantId($tenant_id, $fields);
    }

    public function create(array $data)
    {
        $tenantId = $data['tenant_id'];
        $caption = $data['caption'] ?? 'tenant image';
        $results = [];

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            $primaryData = [
                'tenant_id'  => $tenantId,
                'caption'    => $caption,
                'is_primary' => true,
                'path'       => $this->uploadImage($data['path'])
            ];
            $results[] = $this->tenantPhotoRepository->create($primaryData);
        }

        if (isset($data['album']) && is_array($data['album'])) {
            foreach ($data['album'] as $file) {
                if ($file instanceof UploadedFile) {
                    $albumData = [
                        'tenant_id'  => $tenantId,
                        'caption'    => $caption,
                        'is_primary' => false,
                        'path'       => $this->uploadImage($file)
                    ];
                    $results[] = $this->tenantPhotoRepository->create($albumData);
                }
            }
        }

        return $results;
    }

    public function update(array $data, int $tenant_id)
    {
        $album = $this->tenantPhotoRepository->getPhotoIsPrimary($tenant_id, false, ['id', 'path']);
        $tenantPhotoPrimary = $this->tenantPhotoRepository->findByTenantId($tenant_id, true, ['id', 'path']);

        $caption = $data['caption'];
        $results = [];

        if (isset($data['path']) && $data['path'] instanceof UploadedFile) {
            if (!empty($tenantPhoto->path)) {
                $this->deleteImage($tenantPhotoPrimary->path);
            }
            $data['path'] = $this->uploadImage($data['path']);
            $results[] = $this->tenantPhotoRepository->update($data, $tenantPhotoPrimary->id);
        }

        if (isset($data['album']) && is_array($data['album'])) {
            foreach ($album as $al) {
                $this->deleteImage($al->path);
                $this->delete($al->id);
            }

            foreach ($data['album'] as $file) {
                if ($file instanceof UploadedFile) {
                    $albumData = [
                        'tenant_id'  => $tenant_id,
                        'caption'    => $caption,
                        'is_primary' => false,
                        'path'       => $this->uploadImage($file)
                    ];
                    $results[] = $this->tenantPhotoRepository->create($albumData);
                }
            }
        }

        return $results;
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
