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

    public function getTenantsByStatus(array $fields, bool $is_active)
    {
        return $this->model::select($fields)->where('is_active', $is_active)->get();
    }

    public function getTenantsWithRelationship(array $fields, array $relationship)
    {
        return $this->model::select($fields)->with($relationship)->where('is_active', true)->get();
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
}
