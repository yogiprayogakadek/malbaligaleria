<?php

namespace App\Repositories;

use App\Models\Gallery;

class GalleryRepository
{
    public function __construct(protected Gallery $model) {}

    public function getAll(array $fields = ['*'])
    {
        return $this->model::select($fields)->orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();
    }

    public function getActive(array $fields = ['*'])
    {
        return $this->model::select($fields)->where('is_active', true)->orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(array $data, int $id)
    {
        $gallery = $this->model::where('id', $id)->firstOrFail();
        $gallery->update($data);
        return $gallery;
    }

    public function delete(int $id)
    {
        $gallery = $this->model::where('id', $id)->firstOrFail();
        $gallery->delete();
    }
}
