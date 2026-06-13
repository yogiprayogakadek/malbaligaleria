<?php

namespace App\Services;

use App\Repositories\TenantRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

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

    public function getFilteredQuery(array $fields = ['*'], array $filters = [])
    {
        return $this->tenantRepository->getFilteredQuery($fields, $filters);
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

    public function deleteByUuid(string $uuid)
    {
        return $this->tenantRepository->deleteByUuid($uuid);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('tenant_images', 'public');
        ImageOptimizer::optimize($path);
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

        // Filter by floor
        if (!$isNew) {
            $floorNumber = str_contains($cat, '1st') ? '1' : (str_contains($cat, '2nd') ? '2' : null);
            if ($floorNumber) {
                $query = $query->filter(function ($tenant) use ($floorNumber) {
                    $tenantFloor = data_get($tenant, 'map_coords.floor');
                    return $tenantFloor == $floorNumber;
                });

                // Also fetch gate-type tenants separately.
                // Gates are created without an isNew input → isNew=NULL in DB.
                // WHERE isNew=false misses NULL rows, so we query them independently.
                $gateFields = array_unique(array_merge($fields, ['id', 'name', 'type', 'map_coords', 'path_coords', 'logo', 'isNew']));
                $gates = $this->tenantRepository->getGatesByFloor($gateFields, $relationship, (int) $floorNumber);

                // Merge gates into $query, avoiding duplicates by id
                $existingIds = $query->pluck('id')->toArray();
                $gates = $gates->filter(fn($g) => !in_array($g->id, $existingIds));

                $query = $query->concat($gates);
            }
        }

        $tenants = $query->map(function ($tenant) {
            $data = [
                'id' => $tenant->id,
                'name' => $tenant->name,
                'category' => $tenant->category->name ?? 'Gate',
                'floor' => $tenant->isNew
                    ? 'New Store'
                    : (
                        ($floor = data_get($tenant, 'map_coords.floor'))
                        ? ($floor == 1 ? '1st Floor' : '2nd Floor')
                        : '-'
                    ),
                'unit' => data_get($tenant, 'map_coords.unit') ?? '-',
                'logo' => !empty($tenant->logo)
                    ? (str_starts_with($tenant->logo, 'assets')
                        ? asset($tenant->logo)
                        : asset('storage/' . $tenant->logo)
                    )
                    : asset('assets/images/no_image.jpg'),
                'type' => $tenant->type ?? 'tenant',
                'path_coords' => $tenant->path_coords,
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
