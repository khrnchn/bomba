<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ParticipantStoreRequest;
use App\Http\Requests\ParticipantUpdateRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Participant::class);

        $search = $request->get('search', '');

        $participants = Participant::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.participants.index',
            compact('participants', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Participant::class);

        return view('app.participants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Participant::class);

        $validated = $request->validated();

        $participant = Participant::create($validated);

        return redirect()
            ->route('participants.edit', $participant)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Participant $participant): View
    {
        $this->authorize('view', $participant);

        return view('app.participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Participant $participant): View
    {
        $this->authorize('update', $participant);

        return view('app.participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ParticipantUpdateRequest $request,
        Participant $participant
    ): RedirectResponse {
        $this->authorize('update', $participant);

        $validated = $request->validated();

        $participant->update($validated);

        return redirect()
            ->route('participants.edit', $participant)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Participant $participant
    ): RedirectResponse {
        $this->authorize('delete', $participant);

        $participant->delete();

        return redirect()
            ->route('participants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
