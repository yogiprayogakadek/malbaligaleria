<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CategoryService
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->categoryRepository->getAll($fields);
    }

    public function getCategoriesByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->categoryRepository->getCategoriesByStatus($fields, $is_active);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->categoryRepository->findById($id, $fields);
    }

    public function findByUuid(string $uuid, array $fields = ['*'])
    {
        return $this->categoryRepository->findByUuid($uuid, $fields);
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        return $this->categoryRepository->update($data, $uuid);
    }

    public function delete(string $uuid)
    {
        return $this->categoryRepository->delete($uuid);
    }
}
