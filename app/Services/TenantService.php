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

    public function getTenantsByStatus(array $fields = ['*'], bool $is_active)
    {
        return $this->tenantRepository->getTenantsByStatus($fields, $is_active);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->tenantRepository->findById($id, $fields);
    }

    public function create(array $data)
    {
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $data['logo'] = $this->uploadImage($data['logo']);
        }

        return $this->tenantRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->tenantRepository->update($data, $id);
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
