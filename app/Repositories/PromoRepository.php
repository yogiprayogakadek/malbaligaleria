<?php

namespace App\Repositories;

use App\Models\Promo;

class PromoRepository
{
    public function __construct(protected Promo $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getPromoWithRelationship(array $fields, array $relationship)
    {
        return $this->model::select($fields)->with($relationship)->where('is_active', true)->get();
    }

    public function getPromoByStatus(array $fields, bool $is_active)
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
        $promo = $this->model::create($data);
        return $promo;
    }

    public function update(array $data, string $uuid)
    {
        $promo = $this->model::where('uuid', $uuid)->firstOrFail();
        return $promo->update($data);
    }

    public function delete(string $uuid)
    {
        $promo = $this->model::find($uuid);
        $promo->delete();
    }
}
