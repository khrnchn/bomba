<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrganizerStoreRequest;
use App\Http\Requests\OrganizerUpdateRequest;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Organizer::class);

        $search = $request->get('search', '');

        $organizers = Organizer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.organizers.index', compact('organizers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Organizer::class);

        return view('app.organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Organizer::class);

        $validated = $request->validated();

        $organizer = Organizer::create($validated);

        return redirect()
            ->route('organizers.edit', $organizer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Organizer $organizer): View
    {
        $this->authorize('view', $organizer);

        return view('app.organizers.show', compact('organizer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Organizer $organizer): View
    {
        $this->authorize('update', $organizer);

        return view('app.organizers.edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OrganizerUpdateRequest $request,
        Organizer $organizer
    ): RedirectResponse {
        $this->authorize('update', $organizer);

        $validated = $request->validated();

        $organizer->update($validated);

        return redirect()
            ->route('organizers.edit', $organizer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Organizer $organizer
    ): RedirectResponse {
        $this->authorize('delete', $organizer);

        $organizer->delete();

        return redirect()
            ->route('organizers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
