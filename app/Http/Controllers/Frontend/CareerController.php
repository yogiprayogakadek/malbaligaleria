<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Mail\JobApplicationConfirmation;
use App\Mail\NewJobApplicationNotification;
use App\Models\VisitorLog;
use App\Services\JobApplicationService;
use App\Services\JobVacancyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    protected JobVacancyService $vacancyService;
    protected JobApplicationService $applicationService;

    public function __construct(
        JobVacancyService $vacancyService,
        JobApplicationService $applicationService
    ) {
        $this->vacancyService    = $vacancyService;
        $this->applicationService = $applicationService;
    }

    public function index()
    {
        $vacancies   = $this->vacancyService->getAllActive();
        $departments = $this->vacancyService->getDepartments();

        $totalVisitors  = VisitorLog::count();
        $todayVisitors  = VisitorLog::whereDate('created_at', today())->count();
        $onlineVisitors = VisitorLog::where('updated_at', '>=', now()->subMinutes(5))->count();

        return view('frontend.career.index', compact(
            'vacancies', 'departments',
            'totalVisitors', 'todayVisitors', 'onlineVisitors'
        ));
    }

    public function show(string $uuid)
    {
        $vacancy = $this->vacancyService->findByUuid($uuid);

        abort_if(!$vacancy->is_active, 404);

        $totalVisitors  = VisitorLog::count();
        $todayVisitors  = VisitorLog::whereDate('created_at', today())->count();
        $onlineVisitors = VisitorLog::where('updated_at', '>=', now()->subMinutes(5))->count();

        return view('frontend.career.show', compact(
            'vacancy',
            'totalVisitors', 'todayVisitors', 'onlineVisitors'
        ));
    }

    public function apply(StoreJobApplicationRequest $request, string $uuid)
    {
        $vacancy = $this->vacancyService->findByUuid($uuid);

        abort_if(!$vacancy->is_active, 403, 'Lowongan ini sudah tidak tersedia.');

        if ($vacancy->isExpired()) {
            return back()->withErrors(['deadline' => 'Maaf, batas pendaftaran untuk posisi ini sudah berakhir.']);
        }

        // Check duplicate application
        if ($this->applicationService->hasApplied($request->email, $vacancy->id)) {
            return back()->withErrors(['email' => 'Email ini sudah pernah melamar untuk posisi yang sama.']);
        }

        $data = [
            'job_vacancy_id' => $vacancy->id,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'cover_letter'   => $request->cover_letter,
            'status'         => 'new',
        ];

        $application = $this->applicationService->create($data, $request->file('cv'));

        // Send applicant confirmation email
        try {
            Mail::to($application->email)->send(new JobApplicationConfirmation($application));
        } catch (\Exception $e) {
            logger()->error('Failed to send applicant confirmation email: ' . $e->getMessage());
            try {
                \App\Models\EmailLog::create([
                    'recipient' => $application->email,
                    'subject' => 'Job Application Confirmation',
                    'body' => 'Failed to send confirmation email to candidate.',
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            } catch (\Exception $dbEx) {
                // Ignore DB logging failure
            }
        }

        // Send HR notification email
        $hrEmail = config('mail.hr_notification_email', env('HR_NOTIFICATION_EMAIL', config('mail.from.address')));
        try {
            Mail::to($hrEmail)->send(new NewJobApplicationNotification($application));
        } catch (\Exception $e) {
            logger()->error('Failed to send HR notification email: ' . $e->getMessage());
            try {
                \App\Models\EmailLog::create([
                    'recipient' => $hrEmail,
                    'subject' => 'New Job Application Received',
                    'body' => 'Failed to send notification email to HR team.',
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            } catch (\Exception $dbEx) {
                // Ignore DB logging failure
            }
        }

        return redirect()->route('frontend.career.show', $uuid)
            ->with('success', 'Your application has been successfully submitted! We will contact you soon.');
    }
}
