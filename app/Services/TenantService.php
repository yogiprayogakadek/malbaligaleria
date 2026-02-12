<?php

namespace App\Services;

use App\Repositories\TenantRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
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

    public function getTenantsWithRelationshipAndCondition(array $fields = ['*'], array $relationship, string $column, string $condition)
    {
        return $this->tenantRepository->getTenantsWithRelationshipAndCondition($fields, $relationship, $column, $condition);
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

    // Custom
    // public function getDataByFloor(array $fields, array $relationship, string $cat, bool $isNew)
    // {
    //     $cacheKey = "tenant_floor_{$cat}_{$isNew}";

    //     return Cache::remember(
    //         $cacheKey,
    //         now()->addMinutes(10),
    //         function () use ($fields, $relationship, $cat, $isNew) {
    //             $tenants = $this->getTenantsWithRelationshipAndCondition($fields, $relationship, 'isNew', $isNew)->map(function ($tenant) {
    //                 $data = [
    //                     'id' => $tenant['id'],
    //                     'name' => $tenant['name'],
    //                     'category' => $tenant['category']['name'],
    //                     'floor' => $tenant['isNew']
    //                         ? 'New Store'
    //                         : (
    //                             ($floor = data_get($tenant, 'map_coords.floor'))
    //                             ? ($floor == 1 ? '1st Floor' : '2nd Floor')
    //                             : '-'
    //                         ),
    //                     'unit' => $tenant['map_coords']['unit'] ?? '-',
    //                     'logo' => !empty($tenant['logo'])
    //                         ? (str_starts_with($tenant['logo'], 'assets')
    //                             ? asset($tenant['logo'])
    //                             : asset('storage/' . $tenant['logo'])
    //                         )
    //                         : asset('assets/images/no_image.jpg'),
    //                     // 'logo' => !empty($tenant['logo'])
    //                     //     ? asset('storage/' . $tenant['logo'])
    //                     //     : asset('assets/images/no_image.jpg'),
    //                     'hours' => "10:00 AM - 10:00 PM",
    //                     'album' => optional($tenant->albumPhoto)->map(function ($photo) {
    //                         return [
    //                             'id' => $photo->id,
    //                             'path' => $photo->path,
    //                             'caption' => $photo->caption,
    //                         ];
    //                     }) ?? [],
    //                 ];

    //                 return $data;
    //             });

    //             return $tenants;
    //         }
    //     );
    // }


    public function getDataByFloor(array $fields, array $relationship, string $cat, bool $isNew)
    {
        $query = $this->getTenantsWithRelationshipAndCondition($fields, $relationship, 'isNew', $isNew);

        // Filter by floor if not "New Store"
        if (!$isNew) {
            $floorNumber = str_contains($cat, '1st') ? '1' : (str_contains($cat, '2nd') ? '2' : null);
            if ($floorNumber) {
                $query = $query->filter(function ($tenant) use ($floorNumber) {
                    return data_get($tenant, 'map_coords.floor') == $floorNumber;
                });
            }
        }

        $tenants = $query->map(function ($tenant) {
            $data = [
                'id' => $tenant['id'],
                'name' => $tenant['name'],
                'category' => $tenant['category']['name'],
                'floor' => $tenant['isNew']
                    ? 'New Store'
                    : (
                        ($floor = data_get($tenant, 'map_coords.floor'))
                        ? ($floor == 1 ? '1st Floor' : '2nd Floor')
                        : '-'
                    ),
                'unit' => $tenant['map_coords']['unit'] ?? '-',
                'logo' => !empty($tenant['logo'])
                    ? (str_starts_with($tenant['logo'], 'assets')
                        ? asset($tenant['logo'])
                        : asset('storage/' . $tenant['logo'])
                    )
                    : asset('assets/images/no_image.jpg'),
                // 'logo' => !empty($tenant['logo'])
                //     ? asset('storage/' . $tenant['logo'])
                //     : asset('assets/images/no_image.jpg'),
                'hours' => "10:00 AM - 10:00 PM",
                'album' => optional($tenant->albumPhoto)->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'path' => $photo->path,
                        'caption' => $photo->caption,
                    ];
                }) ?? [],
            ];

            return $data;
        });

        return $tenants;
    }
}
