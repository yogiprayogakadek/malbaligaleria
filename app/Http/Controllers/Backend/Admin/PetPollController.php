<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePetPollRequest;
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

    public function store(Request $request)
    {
        $existing = $this->petPollService->current();
        if ($existing) {
            return redirect()->route('admin.pet-poll.index')->with('error', 'Survei sudah ada.');
        }

        $this->petPollService->createDefault(auth()->id());

        return redirect()->route('admin.pet-poll.index')->with('success', 'Survei pet friendly berhasil dibuat.');
    }

    public function settings()
    {
        $poll = $this->petPollService->current();
        if (!$poll) {
            return redirect()->route('admin.pet-poll.index')->with('error', 'Buat survei terlebih dahulu.');
        }

        $hasResponses = $this->petPollService->hasResponses($poll);
        $responseCount = $poll->responses()->count();

        return view('backend.admin.pet-poll.settings', compact('poll', 'hasResponses', 'responseCount'));
    }

    public function updateSettings(UpdatePetPollRequest $request)
    {
        $poll = $this->petPollService->current();
        if (!$poll) {
            return redirect()->route('admin.pet-poll.index')->with('error', 'Survei tidak ditemukan.');
        }

        $data = $request->validated();
        $hasResponses = $this->petPollService->hasResponses($poll);

        $attemptedQuestionChange = ($data['question'] !== $poll->question);
        $attemptedScopeChange = ($data['pet_scope'] !== $poll->pet_scope);

        if ($hasResponses && ($attemptedQuestionChange || $attemptedScopeChange)) {
            // Simpan hanya title & closes_at, tolak pertanyaan & cakupan
            $poll->update([
                'title' => $data['title'],
                'closes_at' => $data['closes_at'],
            ]);

            return redirect()
                ->route('admin.pet-poll.settings')
                ->withErrors([
                    'question' => 'Pertanyaan dan cakupan pet terkunci karena sudah ada jawaban dari tenant.',
                ])
                ->with('success', 'Judul dan tenggat waktu berhasil diperbarui, namun pertanyaan tetap terkunci.');
        }

        $poll->update($data);

        return redirect()->route('admin.pet-poll.settings')->with('success', 'Pengaturan survei berhasil disimpan.');
    }

    public function toggleStatus(Request $request)
    {
        $poll = $this->petPollService->current();
        if (!$poll) {
            return redirect()->route('admin.pet-poll.index')->with('error', 'Survei tidak ditemukan.');
        }

        $poll->update(['is_open' => !$poll->is_open]);

        $message = $poll->is_open ? 'Survei berhasil dibuka kembali.' : 'Survei berhasil ditutup.';

        return redirect()->route('admin.pet-poll.index')->with('success', $message);
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
}
