<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(protected User $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getUsersByStatus(array $fields, bool $is_active)
    {
        return $this->model::select($fields)->where('is_active', $is_active)->get();
    }

    public function getUsersWithRelationship(array $fields, array $relationship)
    {
        return $this->model::select($fields)->with($relationship)->get();
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
        $category = $this->model::create($data);
        return $category;
    }

    public function update(array $data, string $uuid)
    {
        $category = $this->model::where('uuid', $uuid)->firstOrFail();
        return $category->update($data);
    }

    public function delete(string $uuid)
    {
        $category = $this->model::find($uuid);
        $category->delete();
    }
}
