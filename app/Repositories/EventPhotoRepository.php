<?php

namespace App\Repositories;

use App\Models\EventPhoto;

class EventPhotoRepository
{
    public function __construct(protected EventPhoto $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->where('is_primary', true)->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
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
