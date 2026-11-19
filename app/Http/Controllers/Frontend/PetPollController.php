<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

    public function searchTenants(Request $request)
    {
        return response()->json([]);
    }

    public function submit(Request $request)
    {
        return back();
    }
}
