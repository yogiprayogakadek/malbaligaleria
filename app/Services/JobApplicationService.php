<?php

namespace App\Services;

use App\Models\JobApplication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JobApplicationService
{
    public function getAll(array $columns = ['*'], array $relations = [])
    {
        return JobApplication::select($columns)->with($relations)->latest();
    }

    public function getByVacancy(int $vacancyId)
    {
        return JobApplication::where('job_vacancy_id', $vacancyId)->latest();
    }

    public function findByUuid(string $uuid): JobApplication
    {
        return JobApplication::where('uuid', $uuid)->with('vacancy')->firstOrFail();
    }

    public function create(array $data, UploadedFile $cvFile): JobApplication
    {
        $cvPath = $cvFile->store('career/cv', 'public');
        $data['cv_path'] = $cvPath;

        return JobApplication::create($data);
    }

    public function updateStatus(string $uuid, string $status, ?string $notes = null): JobApplication
    {
        $application = $this->findByUuid($uuid);
        $application->update([
            'status' => $status,
            'notes'  => $notes,
        ]);
        return $application;
    }

    public function delete(string $uuid): void
    {
        $application = $this->findByUuid($uuid);
        if ($application->cv_path) {
            Storage::disk('public')->delete($application->cv_path);
        }
        $application->delete();
    }

    public function hasApplied(string $email, int $vacancyId): bool
    {
        return JobApplication::where('email', $email)
            ->where('job_vacancy_id', $vacancyId)
            ->exists();
    }
}
