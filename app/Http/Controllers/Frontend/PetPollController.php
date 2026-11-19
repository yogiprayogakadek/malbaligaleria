<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitPetPollRequest;
use App\Models\PetPollResponse;
use App\Services\PetPollService;
use Illuminate\Http\Request;

class PetPollController extends Controller
{
    protected PetPollService $petPollService;

    public function __construct(PetPollService $petPollService)
    {
        $this->petPollService = $petPollService;
    }

    public function show(Request $request)
    {
        $poll = $this->petPollService->current();

        $response = null;
        if ($poll) {
            $responseId = $request->session()->get('pet_poll_response_' . $poll->id);
            if ($responseId) {
                $response = PetPollResponse::with('tenant.category')->find($responseId);
            }
        }

        $submitted = (bool) $request->session()->get('pet_poll_submitted', false);
        $isOpen = $poll ? $poll->isOpen() : false;

        return view('frontend.pet-poll.index', compact('poll', 'response', 'submitted', 'isOpen'));
    }

    public function editWithToken(string $token)
    {
        $response = $this->petPollService->findByToken($token);
        if (!$response) {
            abort(404, 'Tautan ubah jawaban tidak valid atau tidak ditemukan.');
        }

        $poll = $response->poll;
        $isOpen = $poll ? $poll->isOpen() : false;
        $isTokenEdit = true;
        $submitted = false;

        return view('frontend.pet-poll.index', compact('poll', 'response', 'isOpen', 'isTokenEdit', 'submitted'));
    }

    public function searchTenants(Request $request)
    {
        $validated = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:80'],
        ]);

        $tenants = $this->petPollService->searchTenants($validated['q'])->map(function ($tenant) {
            return [
                'id' => $tenant->id,
                'name' => $tenant->name,
                'category' => $tenant->category ? $tenant->category->name : null,
            ];
        });

        return response()->json($tenants);
    }

    public function submit(SubmitPetPollRequest $request)
    {
        $poll = $this->petPollService->current();

        if (!$poll || !$poll->isOpen()) {
            return redirect()
                ->route('frontend.pet-poll.show')
                ->with('error', 'Survei sudah ditutup atau belum tersedia.');
        }

        $response = $this->petPollService->submit(
            $poll,
            $request->validated(),
            $request->ip(),
            substr((string) $request->userAgent(), 0, 255)
        );

        $request->session()->put('pet_poll_response_' . $poll->id, $response->id);
        $request->session()->flash('pet_poll_submitted', true);

        return redirect()->route('frontend.pet-poll.show');
    }
}
