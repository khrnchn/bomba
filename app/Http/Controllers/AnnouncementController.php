<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Requests\AnnouncementUpdateRequest;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Announcement::class);

        $search = $request->get('search', '');

        $announcements = Announcement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.announcements.index',
            compact('announcements', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Announcement::class);

        return view('app.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Announcement::class);

        $validated = $request->validated();

        $announcement = Announcement::create($validated);

        return redirect()
            ->route('announcements.edit', $announcement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Announcement $announcement): View
    {
        $this->authorize('view', $announcement);

        return view('app.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Announcement $announcement): View
    {
        $this->authorize('update', $announcement);

        return view('app.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AnnouncementUpdateRequest $request,
        Announcement $announcement
    ): RedirectResponse {
        $this->authorize('update', $announcement);

        $validated = $request->validated();

        $announcement->update($validated);

        return redirect()
            ->route('announcements.edit', $announcement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Announcement $announcement
    ): RedirectResponse {
        $this->authorize('delete', $announcement);

        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
