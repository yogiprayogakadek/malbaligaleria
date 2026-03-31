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
            ->whereIn('type', ['regular', 'special', 'upcoming'])
            ->orderBy('id', 'desc')
            ->limit(100)
            ->get();
    }

    public function getRegularEvents(array $fields, array $relationship)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('is_active', true)
            ->whereIn('type', ['regular', 'special'])
            ->get();
    }

    public function getExhibitionEvents(array $fields, array $relationship)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('is_active', true)
            ->where('type', 'exhibition')
            ->where('end_date', '>=', today())
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
            ->where('type', 'upcoming')
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
        return $this->model::select($fields)->whereDoesntHave('primaryPhoto')->get();
    }

    public function create(array $data)
    {
        $event = $this->model::create($data);
        return $event;
    }

    public function update(array $data, string $uuid)
    {
        $event = $this->model::where('uuid', $uuid);
        return $event->update($data);
    }

    public function delete(int $id)
    {
        $tenant = $this->model::find($id);
        $tenant->delete();
    }
}
