<?php

namespace App\Services;

use App\Models\JobVacancy;

class JobVacancyService
{
    public function getAll(array $columns = ['*'])
    {
        return JobVacancy::select($columns)->latest()->get();
    }

    public function getAllActive(array $columns = ['*'])
    {
        return JobVacancy::select($columns)
            ->active()
            ->orderBy('sort_order')
            ->latest()
            ->get();
    }

    public function getAllWithRelationship(array $columns = ['*'], array $relations = [])
    {
        return JobVacancy::select($columns)->with($relations)->withCount('applications')->latest();
    }

    public function findByUuid(string $uuid): JobVacancy
    {
        return JobVacancy::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data): JobVacancy
    {
        return JobVacancy::create($data);
    }

    public function update(array $data, string $uuid): JobVacancy
    {
        $vacancy = $this->findByUuid($uuid);
        $vacancy->update($data);
        return $vacancy;
    }

    public function delete(string $uuid): void
    {
        $vacancy = $this->findByUuid($uuid);
        $vacancy->delete();
    }

    public function getDepartments(): array
    {
        return JobVacancy::active()
            ->distinct()
            ->pluck('department')
            ->toArray();
    }
}
