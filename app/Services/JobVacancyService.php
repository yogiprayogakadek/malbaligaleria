<?php

namespace App\Services;

use App\Models\JobVacancy;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;
use Illuminate\Http\UploadedFile;

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
        return JobVacancy::where('uuid', $uuid)->orWhere('slug', $uuid)->firstOrFail();
    }

    public function create(array $data): JobVacancy
    {
        if (isset($data['flyer']) && $data['flyer'] instanceof UploadedFile) {
            $data['flyer_path'] = $this->uploadFlyer($data['flyer']);
        }
        return JobVacancy::create($data);
    }

    public function update(array $data, string $uuid): JobVacancy
    {
        $vacancy = $this->findByUuid($uuid);

        if (isset($data['flyer']) && $data['flyer'] instanceof UploadedFile) {
            if ($vacancy->flyer_path) {
                $this->deleteFlyer($vacancy->flyer_path);
            }
            $data['flyer_path'] = $this->uploadFlyer($data['flyer']);
        }

        $vacancy->update($data);
        return $vacancy;
    }

    public function delete(string $uuid): void
    {
        $vacancy = $this->findByUuid($uuid);
        if ($vacancy->flyer_path) {
            $this->deleteFlyer($vacancy->flyer_path);
        }
        $vacancy->delete();
    }

    private function uploadFlyer(UploadedFile $file): string
    {
        $path = $file->store('career/flyers', 'public');
        ImageOptimizer::optimize($path);
        return $path;
    }

    private function deleteFlyer(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function getDepartments(): array
    {
        return JobVacancy::active()
            ->distinct()
            ->pluck('department')
            ->toArray();
    }
}
