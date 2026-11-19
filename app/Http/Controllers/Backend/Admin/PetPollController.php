<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\PetPollService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PetPollController extends Controller
{
    protected PetPollService $petPollService;

    public function __construct(PetPollService $petPollService)
    {
        $this->petPollService = $petPollService;
    }

    public function index(Request $request)
    {
        $poll = $this->petPollService->current();
        $stats = $poll ? $this->petPollService->stats($poll) : [
            'total' => 0, 'answered' => 0, 'allowed' => 0, 'denied' => 0, 'unanswered' => 0, 'percentage' => 0,
        ];

        $filter = (string) $request->get('filter', 'all');
        $search = $request->get('search');

        $responses = null;
        $unansweredTenants = null;

        if ($poll) {
            if ($filter === 'unanswered') {
                $unansweredTenants = $this->petPollService->unansweredTenantQuery($poll, $search)
                    ->paginate(20)
                    ->withQueryString();
            } else {
                $responses = $this->petPollService->responseQuery($poll, $filter, $search)
                    ->paginate(20)
                    ->withQueryString();
            }
        }

        return view('backend.admin.pet-poll.index', compact('poll', 'stats', 'filter', 'search', 'responses', 'unansweredTenants'));
    }

    public function export(Request $request): StreamedResponse
    {
        $poll = $this->petPollService->current();
        if (!$poll) {
            abort(404, 'Survei belum dibuat.');
        }

        $filter = (string) $request->get('filter', 'all');
        $search = $request->get('search');

        $fileName = 'pet-poll-recap-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($poll, $filter, $search) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            if ($filter === 'unanswered') {
                fputcsv($handle, ['Tenant', 'Kategori', 'Status']);
                $query = $this->petPollService->unansweredTenantQuery($poll, $search);
                $query->chunk(100, function ($tenants) use ($handle) {
                    foreach ($tenants as $t) {
                        fputcsv($handle, [
                            $t->name,
                            $t->category ? $t->category->name : '-',
                            'Belum menjawab',
                        ]);
                    }
                });
            } else {
                fputcsv($handle, ['Tenant', 'Kategori', 'Jawaban', 'Catatan', 'Waktu (WITA)']);
                $query = $this->petPollService->responseQuery($poll, $filter, $search);
                $query->chunk(100, function ($responses) use ($handle) {
                    foreach ($responses as $r) {
                        fputcsv($handle, [
                            $r->tenant ? $r->tenant->name : '-',
                            ($r->tenant && $r->tenant->category) ? $r->tenant->category->name : '-',
                            $r->allows_pets ? 'Mengizinkan' : 'Tidak Mengizinkan',
                            $r->note ?? '-',
                            $r->responded_at ? $r->responded_at->timezone('Asia/Makassar')->format('d/m/Y H:i') : '-',
                        ]);
                    }
                });
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function store(Request $request)
    {
        return back();
    }

    public function settings()
    {
        return response('settings');
    }

    public function updateSettings(Request $request)
    {
        return back();
    }

    public function toggleStatus(Request $request)
    {
        return back();
    }
}
