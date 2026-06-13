<?php

namespace App\Repositories;

use App\Models\EventPhoto;

class EventPhotoRepository
{
    public function __construct(protected EventPhoto $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->whereHas('event')->where('is_primary', true)->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function findByEventId(int $event_id, bool $is_primary, array $fields)
    {
        return $this->model::select($fields)->where('event_id', $event_id)->where('is_primary', $is_primary)->firstOrFail();
    }

    public function getPhotoIsPrimary(int $event_id, bool $is_primary, array $fields)
    {
        return $this->model::select($fields)->where('event_id', $event_id)->where('is_primary', $is_primary)->orderBy('sort_order')->get();
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

    public function getByEventId(int $event_id, array $fields)
    {
        return $this->model::select($fields)->where('event_id', $event_id)->get();
    }

    public function delete(int $id)
    {
        $tenant = $this->model::find($id);
        $tenant->delete();
    }

    public function deleteByEventId(int $eventId)
    {
        $this->model::where('event_id', $eventId)->delete();
    }
}
