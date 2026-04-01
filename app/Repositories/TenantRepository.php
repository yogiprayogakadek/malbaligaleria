<?php

namespace App\Repositories;

use App\Models\Tenant;

class TenantRepository
{
    public function __construct(protected Tenant $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getFilteredQuery(array $fields, array $filters)
    {
        $query = $this->model::select($fields)->with('category:id,name,is_active');

        if (isset($filters['floor']) && $filters['floor'] !== '') {
            $floor = $filters['floor'];
            $query->where(function ($q) use ($floor) {
                // Support both integer and string floor values in JSON
                $q->whereJsonContains('map_coords->floor', (int) $floor)
                  ->orWhereJsonContains('map_coords->floor', (string) $floor);
            });
        }

        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }

        if (isset($filters['is_new']) && $filters['is_new'] !== '') {
            $query->where('isNew', $filters['is_new']);
        }

        if (isset($filters['category_id']) && $filters['category_id'] !== '') {
            $query->where('category_id', $filters['category_id']);
        }

        return $query;
    }

    public function getTenantsByStatus(array $fields, bool $is_active)
    {
        return $this->model::select($fields)->where('is_active', $is_active)->get();
    }

    public function getTenantsWithRelationship(array $fields, array $relationship)
    {
        return $this->model::select($fields)->with($relationship)->where('is_active', true)->get();
    }

    public function getTenantsWithRelationshipAndCondition(array $fields, array $relationship, string $column, string $condition)
    {
        return $this->model::select($fields)->with($relationship)->where($column, $condition)->where('is_active', true)->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function findByUuid(string $uuid, array $fields)
    {
        return $this->model::select($fields)->where('uuid', $uuid)->firstOrFail();
    }

    public function findEmptyPhotoTenants(array $fields)
    {
        return $this->model::select($fields)->whereDoesntHave('photos')->get();
    }

    /**
     * Fetch gate-type tenants for a given floor, regardless of isNew value.
     * Gates are often created without isNew input → isNew=NULL in DB,
     * so they are missed by WHERE isNew=false queries.
     */
    public function getGatesByFloor(array $fields, array $relationship, int $floorNumber)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('type', 'gate')
            ->where('is_active', true)
            ->where(function ($q) use ($floorNumber) {
                // floor can be stored as int or string in JSON
                $q->whereJsonContains('map_coords->floor', $floorNumber)
                  ->orWhereJsonContains('map_coords->floor', (string) $floorNumber);
            })
            ->get();
    }

    public function create(array $data)
    {
        $tenant = $this->model::create($data);
        return $tenant;
    }

    public function update(array $data, string $uuid)
    {
        $tenant = $this->model::where('uuid', $uuid);
        return $tenant->update($data);
    }

    public function delete(int $id)
    {
        $tenant = $this->model::find($id);
        $tenant->delete();
    }

    public function deleteByUuid(string $uuid)
    {
        $tenant = $this->model::where('uuid', $uuid)->firstOrFail();
        return $tenant->delete();
    }
}
