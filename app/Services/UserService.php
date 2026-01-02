<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->userRepository->getAll($fields);
    }

    public function getCategoriesByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->userRepository->getUsersByStatus($fields, $is_active);
    }

    public function getUsersWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->userRepository->getUsersWithRelationship($fields, $relationship);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->userRepository->findById($id, $fields);
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }
}
