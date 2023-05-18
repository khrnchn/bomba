<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Program;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CounterStoreRequest;
use App\Http\Requests\CounterUpdateRequest;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Counter::class);

        $search = $request->get('search', '');

        $counters = Counter::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.counters.index', compact('counters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Counter::class);

        $programs = Program::pluck('name', 'id');

        return view('app.counters.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CounterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Counter::class);

        $validated = $request->validated();

        $counter = Counter::create($validated);

        return redirect()
            ->route('counters.edit', $counter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Counter $counter): View
    {
        $this->authorize('view', $counter);

        return view('app.counters.show', compact('counter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Counter $counter): View
    {
        $this->authorize('update', $counter);

        $programs = Program::pluck('name', 'id');

        return view('app.counters.edit', compact('counter', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CounterUpdateRequest $request,
        Counter $counter
    ): RedirectResponse {
        $this->authorize('update', $counter);

        $validated = $request->validated();

        $counter->update($validated);

        return redirect()
            ->route('counters.edit', $counter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Counter $counter
    ): RedirectResponse {
        $this->authorize('delete', $counter);

        $counter->delete();

        return redirect()
            ->route('counters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
