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
                // Logika untuk tipe 'special' (sudah lewat end_date tidak muncul)
                $query->where(function ($q) {
                    $q->where('type', 'special')
                        ->where('end_date', '>=', today());
                })
                // Logika untuk tipe 'regular'
                ->orWhere(function ($q) {
                    $q->where('type', 'regular')
                        ->where(function ($sub) {
                            $sub->whereNull('end_date')
                                ->orWhere('end_date', '>=', today());
                        })
                        ->where(function ($sub) {
                            // Munculkan jika specific_dates null, array kosong [], atau mengandung hari ini
                            $sub->whereNull('specific_dates')
                                ->orWhereJsonLength('specific_dates', 0)
                                ->orWhereJsonContains('specific_dates', today()->format('Y-m-d'));
                        });
                });
            })
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
        return $this->model::select($fields)->with($relationship)->where($column, $condition)->where('is_active',true)->get();
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
