<?php

namespace App\Repositories;

use App\Models\TenantPhoto;

class TenantPhotoRepository
{
    public function __construct(protected TenantPhoto $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->where('is_primary', true)->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function findByTenantId(int $tenant_id, bool $is_primary, array $fields)
    {
        return $this->model::select($fields)->where('tenant_id', $tenant_id)->where('is_primary', $is_primary)->firstOrFail();
    }

    public function getByTenantId(int $tenant_id, array $fields)
    {
        return $this->model::select($fields)->where('tenant_id', $tenant_id)->get();
    }

    public function getPhotoIsPrimary(int $tenant_id, bool $is_primary, array $fields)
    {
        return $this->model::select($fields)->where('tenant_id', $tenant_id)->where('is_primary', $is_primary)->get();
    }

    public function create(array $data)
    {
        $tenant = $this->model::create($data);
        return $tenant;
    }

    public function update(array $data, int $id)
    {
        $tenant = $this->model::find($id);
        return $tenant->update($data);
    }

    public function delete(int $id)
    {
        $tenant = $this->model::find($id);
        $tenant->delete();
    }
}
