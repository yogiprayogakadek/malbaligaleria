<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\JobApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class JobApplicationController extends Controller
{
    protected JobApplicationService $applicationService;

    public function __construct(JobApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $applications = $this->applicationService->getAll(
                ['id', 'uuid', 'job_vacancy_id', 'name', 'email', 'phone', 'status', 'created_at'],
                ['vacancy:id,title,department']
            );

            return DataTables::of($applications)
                ->addIndexColumn()
                ->editColumn('status', fn($row) =>
                    '<span class="badge ' . $row->status_badge . '">' . $row->status_label . '</span>')
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y, H:i'))
                ->addColumn('action', fn($row) =>
                    '<a href="' . route('admin.career.application.show', $row->uuid) . '" class="btn btn-sm bg-info-subtle text-info">
                        <i class="ti ti-eye"></i> Detail
                    </a>'
                )
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.admin.career.application.index');
    }

    public function show(string $uuid)
    {
        $application = $this->applicationService->findByUuid($uuid);
        return view('backend.admin.career.application.show', compact('application'));
    }

    public function updateStatus(Request $request, string $uuid)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,interview,accepted,rejected,on_hold',
            'notes'  => 'nullable|string|max:1000',
            'notify' => 'nullable|boolean',
        ]);

        $application = $this->applicationService->updateStatus($uuid, $request->status, $request->notes);

        if ($request->has('notify') && $request->notify == 1) {
            try {
                \Illuminate\Support\Facades\Mail::to($application->email)
                    ->send(new \App\Mail\JobStatusUpdated($application));
            } catch (\Exception $e) {
                logger()->error('Failed to send status update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.career.application.show', $uuid)
            ->with('success', 'Applicant status successfully updated.');
    }

    public function downloadCv(string $uuid)
    {
        $application = $this->applicationService->findByUuid($uuid);
        $path = storage_path('app/public/' . $application->cv_path);

        if (!file_exists($path)) {
            abort(404, 'CV file not found.');
        }

        $filename = 'CV_' . str_replace(' ', '_', $application->name) . '_' . $application->vacancy->title . '.' . pathinfo($path, PATHINFO_EXTENSION);
        return response()->download($path, $filename);
    }
}
