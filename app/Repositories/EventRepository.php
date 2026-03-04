<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    public function __construct(protected Event $model) {}

    public function getAll(array $fields)
    {
        return $this->model::select($fields)->get();
    }

    public function getEventsByStatus(array $fields, bool $is_active)
    {
        return $this->model::select($fields)->where('is_active', $is_active)->get();
    }

    public function getEventsWithRelationship(array $fields, array $relationship)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('is_active', true)
            ->where('is_regular', false)
            ->where('end_date', '>=', today())
            ->get();
    }

    public function getRegularEvents(array $fields, array $relationship)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('is_active', true)
            ->where('is_regular', true)
            ->get();
    }

    public function getEventsWithRelationshipAndCondition(array $fields, array $relationship, string $column, string $condition)
    {
        return $this->model::select($fields)->with($relationship)->where($column, $condition)->get();
    }

    public function getUpcomingEvents(array $fields, array $relationship, string $uuid)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('uuid', '!=', $uuid)
            ->where('is_active', true)
            ->where('is_regular', false)
            ->get();
    }

    public function findById(int $id, array $fields)
    {
        return $this->model::select($fields)->where('id', $id)->firstOrFail();
    }

    public function findByUuid(string $uuid, array $fields)
    {
        return $this->model::select($fields)->where('uuid', $uuid)->firstOrFail();
    }

    public function findEmptyPhotoEvents(array $fields)
    {
        return $this->model::select($fields)->whereDoesntHave('photos')->get();
    }

    public function create(array $data)
    {
        $tenant = $this->model::create($data);
        return $tenant;
    }

    public function update(array $data, string $uuid)
    {
        $tenant = $this->model::where('uuid', $uuid);
        return $tenant->update($data);
    }

    public function delete(int $id)
    {
        $tenant = $this->model::find($id);
        $tenant->delete();
    }
}
