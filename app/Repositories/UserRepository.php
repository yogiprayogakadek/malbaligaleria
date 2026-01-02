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

    public function create(array $data)
    {
        $user = $this->model::create($data);
        return $user;
    }

    public function update(array $data, int $id)
    {
        $user = $this->model::where('id', $id)->firstOrFail();
        return $user->update($data);
    }

    public function delete(string $id)
    {
        $user = $this->model::find($id);
        $user->delete();
    }
}
