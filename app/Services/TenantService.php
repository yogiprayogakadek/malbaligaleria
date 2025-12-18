<?php

namespace App\Services;

use App\Repositories\TenantRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TenantService
{

    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->tenantRepository->getAll($fields);
    }

    public function getTenantsByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->tenantRepository->getTenantsByStatus($fields, $is_active);
    }

    public function getTenantsWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->tenantRepository->getTenantsWithRelationship($fields, $relationship);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->tenantRepository->findById($id, $fields);
    }

    public function findByUuid(string $uuid, array $fields = ['*'])
    {
        return $this->tenantRepository->findByUuid($uuid, $fields);
    }

    public function findEmptyPhotoTenants(array $fields = ['*'])
    {
        return $this->tenantRepository->findEmptyPhotoTenants($fields);
    }

    public function create(array $data)
    {
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $data['logo'] = $this->uploadImage($data['logo']);
        }

        return $this->tenantRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        $tenant = $this->tenantRepository->findByUuid($uuid, ['id', 'logo']);

        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            if (!empty($tenant->logo)) {
                $this->deleteImage($tenant->logo);
            }
            $data['logo'] = $this->uploadImage($data['logo']);
        }
        return $this->tenantRepository->update($data, $uuid);
    }

    public function delete(int $id)
    {
        return $this->tenantRepository->delete($id);
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
