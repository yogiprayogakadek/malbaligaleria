<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function __construct(protected Setting $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getById(int $id, array $fields)
    {
        return $this->model->select($fields)->where('id', $id)->first();
    }

    public function getByPage(string $page, array $fields)
    {
        return $this->model->select($fields)->where('pages', $page)->where('is_active', true)->first();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        $setting = $this->model::find($id);
        return $setting->delete();
    }
}
