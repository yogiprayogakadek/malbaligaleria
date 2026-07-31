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

    public function getFilteredQuery(array $fields, array $filters)
    {
        $query = $this->model::select($fields);

        if (isset($filters['type']) && $filters['type'] !== '') {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }

        return $query;
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
            ->whereIn('type', ['regular', 'special'])
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
            ->where(function ($query) {
                // Must not be past the end_date if end_date is set
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', today());
            })
            ->where(function ($query) {
                // Show if always_show is enabled OR start_date has been reached (start_date <= today())
                $query->where('always_show', true)
                    ->orWhere('start_date', '<=', today());
            })
            ->get();
    }

    public function getExhibitionEvents(array $fields, array $relationship)
    {
        return $this->model::select($fields)
            ->with($relationship)
            ->where('is_active', true)
            ->where('type', 'exhibition')
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', today());
            })
            ->where(function ($query) {
                // Show if always_show is enabled OR start_date has been reached (start_date <= today())
                $query->where('always_show', true)
                    ->orWhere('start_date', '<=', today());
            })
            ->get();
    }

    public function getEventsWithRelationshipAndCondition(array $fields, array $relationship, string $column, string $condition)
    {
        return $this->model::select($fields)->with($relationship)->where($column, $condition)->where('is_active', true)->get();
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

    public function deleteByUuid(string $uuid)
    {
        $event = $this->model::where('uuid', $uuid)->firstOrFail();
        $event->delete();
    }
}
