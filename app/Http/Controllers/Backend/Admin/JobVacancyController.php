<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobVacancyRequest;
use App\Http\Requests\UpdateJobVacancyRequest;
use App\Services\JobVacancyService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JobVacancyController extends Controller
{
    protected JobVacancyService $vacancyService;

    public function __construct(JobVacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $vacancies = $this->vacancyService->getAllWithRelationship(
                ['id', 'uuid', 'title', 'department', 'type', 'deadline', 'closing_date', 'is_active', 'created_at']
            );

            return DataTables::of($vacancies)
                ->addIndexColumn()
                ->editColumn('type', fn($row) => $row->type_label)
                ->editColumn('deadline', function($row) {
                    $out = '';
                    if ($row->deadline) {
                        $out .= '<div class="small text-muted">DL: ' . $row->deadline->format('d M Y') . '</div>';
                    }
                    if ($row->closing_date) {
                        $out .= '<div class="small text-danger fw-semibold">Close: ' . $row->closing_date->format('d M Y') . '</div>';
                    }
                    return $out ?: '<span class="text-muted fst-italic">No Limit</span>';
                })
                ->editColumn('is_active', fn($row) => $row->is_active
                    ? ($row->isExpired() ? '<span class="badge bg-warning text-dark">Expired</span>' : '<span class="badge bg-success">Active</span>')
                    : '<span class="badge bg-danger">Inactive</span>')
                ->addColumn('applications_count', fn($row) => '<span class="badge bg-info">' . $row->applications_count . ' applicants</span>')
                ->addColumn('action', fn($row) =>
                '<a href="' . route('admin.career.vacancy.edit', $row->uuid) . '" class="btn btn-sm bg-primary-subtle text-primary me-1">
                        <i class="ti ti-pencil"></i> Edit
                    </a>
                    <form action="' . route('admin.career.vacancy.destroy', $row->uuid) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this vacancy?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm bg-danger-subtle text-danger">
                            <i class="ti ti-trash"></i> Delete
                        </button>
                    </form>'
                )
                ->rawColumns(['deadline', 'is_active', 'applications_count', 'action'])
                ->make(true);
        }

        return view('backend.admin.career.vacancy.index');
    }

    public function create()
    {
        return view('backend.admin.career.vacancy.create');
    }

    public function store(StoreJobVacancyRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $this->vacancyService->create($data);

        return redirect()->route('admin.career.vacancy.index')
            ->with('success', 'Vacancy successfully added.');
    }

    public function edit(string $uuid)
    {
        $vacancy = $this->vacancyService->findByUuid($uuid);
        return view('backend.admin.career.vacancy.edit', compact('vacancy'));
    }

    public function update(UpdateJobVacancyRequest $request, string $uuid)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);
        $this->vacancyService->update($data, $uuid);

        return redirect()->route('admin.career.vacancy.index')
            ->with('success', 'Vacancy successfully updated.');
    }

    public function destroy(string $uuid)
    {
        $this->vacancyService->delete($uuid);
        return redirect()->route('admin.career.vacancy.index')
            ->with('success', 'Vacancy successfully deleted.');
    }
}
