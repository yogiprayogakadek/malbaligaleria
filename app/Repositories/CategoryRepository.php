<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct(protected Category $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getCategoriesByStatus(array $fields, bool $is_active)
    {
        return $this->model::select($fields)->where('is_active', $is_active)->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function findByUuid(string $uuid, array $fields)
    {
        return $this->model::select($fields)->where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data)
    {
        $tenant = $this->model::create($data);
        return $tenant;
    }

    public function update(array $data, string $uuid)
    {
        $tenant = $this->model::where('uuid', $uuid)->firstOrFail();
        return $tenant->update($data);
    }

    public function delete(string $uuid)
    {
        $tenant = $this->model::find($uuid);
        $tenant->delete();
    }
}
