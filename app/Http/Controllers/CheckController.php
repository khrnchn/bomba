<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\Staff;
use App\Models\Program;
use App\Models\Counter;
use Illuminate\View\View;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CheckStoreRequest;
use App\Http\Requests\CheckUpdateRequest;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Check::class);

        $search = $request->get('search', '');

        $checks = Check::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.checks.index', compact('checks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Check::class);

        $programs = Program::pluck('name', 'id');
        $counters = Counter::pluck('name', 'id');
        $allStaff = Staff::pluck('referral_code', 'id');
        $participants = Participant::pluck('id', 'id');

        return view(
            'app.checks.create',
            compact('programs', 'counters', 'allStaff', 'participants')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CheckStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Check::class);

        $validated = $request->validated();

        $check = Check::create($validated);

        return redirect()
            ->route('checks.edit', $check)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Check $check): View
    {
        $this->authorize('view', $check);

        return view('app.checks.show', compact('check'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Check $check): View
    {
        $this->authorize('update', $check);

        $programs = Program::pluck('name', 'id');
        $counters = Counter::pluck('name', 'id');
        $allStaff = Staff::pluck('referral_code', 'id');
        $participants = Participant::pluck('id', 'id');

        return view(
            'app.checks.edit',
            compact('check', 'programs', 'counters', 'allStaff', 'participants')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CheckUpdateRequest $request,
        Check $check
    ): RedirectResponse {
        $this->authorize('update', $check);

        $validated = $request->validated();

        $check->update($validated);

        return redirect()
            ->route('checks.edit', $check)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Check $check): RedirectResponse
    {
        $this->authorize('delete', $check);

        $check->delete();

        return redirect()
            ->route('checks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
