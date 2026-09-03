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
                ->addColumn('checkbox', fn($row) =>
                    '<input type="checkbox" class="form-check-input select-applicant" value="' . $row->uuid . '">'
                )
                ->editColumn('status', fn($row) =>
                    '<span class="badge ' . $row->status_badge . '">' . $row->status_label . '</span>')
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y, H:i'))
                ->addColumn('action', fn($row) =>
                    '<a href="' . route('admin.career.application.show', $row->uuid) . '" class="btn btn-sm bg-info-subtle text-info me-1" title="Detail">
                        <i class="ti ti-eye"></i> Detail
                    </a>
                    <a href="' . route('admin.career.application.downloadCv', $row->uuid) . '" class="btn btn-sm bg-success-subtle text-success" title="Download CV">
                        <i class="ti ti-download"></i> CV
                    </a>'
                )
                ->rawColumns(['checkbox', 'status', 'action'])
                ->make(true);
        }

        return view('backend.admin.career.application.index');
    }

    public function show(string $uuid)
    {
        $application = $this->applicationService->findByUuid($uuid);
        $application->load(['reviews.user']);
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
                try {
                    \App\Models\EmailLog::create([
                        'recipient' => $application->email,
                        'subject' => 'Job Status Updated',
                        'body' => 'Failed to send status update notification: ' . ($request->notes ?? ''),
                        'status' => 'failed',
                        'error_message' => $e->getMessage(),
                    ]);
                } catch (\Exception $dbEx) {
                    // Ignore DB logging failure
                }
            }
        }

        return redirect()->route('admin.career.application.show', $uuid)
            ->with('success', 'Applicant status successfully updated.');
    }

    public function print(string $uuid)
    {
        $application = $this->applicationService->findByUuid($uuid);
        return view('backend.admin.career.application.print', compact('application'));
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

    public function storeReview(Request $request, string $uuid)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'notes'  => 'required|string|max:2000',
        ]);

        $application = $this->applicationService->findByUuid($uuid);

        \App\Models\JobApplicationReview::create([
            'job_application_id' => $application->id,
            'user_id'            => auth()->id(),
            'rating'             => $request->rating,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('admin.career.application.show', $uuid)
            ->with('success', 'Review and notes successfully added.');
    }

    public function bulkDownloadCv(Request $request)
    {
        $request->validate([
            'uuids'   => 'required|array',
            'uuids.*' => 'string|exists:job_applications,uuid',
        ]);

        $applications = $this->applicationService->getByUuids($request->uuids);

        if ($applications->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pelamar yang dipilih.');
        }

        if (!class_exists('ZipArchive')) {
            return redirect()->back()->with('error', 'Ekstensi ZipArchive tidak tersedia pada server PHP.');
        }

        $zip = new \ZipArchive();
        $zipFileName = 'Bulk_CV_' . date('Ymd_His') . '.zip';
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $zipFilePath = $tempDir . '/' . $zipFileName;

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }

        $addedCount = 0;
        foreach ($applications as $application) {
            if (!$application->cv_path) {
                continue;
            }

            $path = storage_path('app/public/' . $application->cv_path);
            if (file_exists($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $sanitizedApplicantName = \Illuminate\Support\Str::slug($application->name, '_');
                $sanitizedVacancyTitle = \Illuminate\Support\Str::slug($application->vacancy->title ?? 'Position', '_');
                $fileNameInZip = 'CV_' . $sanitizedApplicantName . '_' . $sanitizedVacancyTitle . '_' . substr($application->uuid, 0, 6) . '.' . $ext;

                $zip->addFile($path, $fileNameInZip);
                $addedCount++;
            }
        }

        $zip->close();

        if ($addedCount === 0) {
            if (file_exists($zipFilePath)) {
                @unlink($zipFilePath);
            }
            return redirect()->back()->with('error', 'Tidak ada file CV yang ditemukan pada pelamar terpilih.');
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }
}
