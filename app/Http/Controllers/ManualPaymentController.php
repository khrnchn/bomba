<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ManualPayment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ManualPaymentStoreRequest;
use App\Http\Requests\ManualPaymentUpdateRequest;

class ManualPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ManualPayment::class);

        $search = $request->get('search', '');

        $manualPayments = ManualPayment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.manual_payments.index',
            compact('manualPayments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ManualPayment::class);

        return view('app.manual_payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManualPaymentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ManualPayment::class);

        $validated = $request->validated();

        $manualPayment = ManualPayment::create($validated);

        return redirect()
            ->route('manual-payments.edit', $manualPayment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ManualPayment $manualPayment): View
    {
        $this->authorize('view', $manualPayment);

        return view('app.manual_payments.show', compact('manualPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ManualPayment $manualPayment): View
    {
        $this->authorize('update', $manualPayment);

        return view('app.manual_payments.edit', compact('manualPayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ManualPaymentUpdateRequest $request,
        ManualPayment $manualPayment
    ): RedirectResponse {
        $this->authorize('update', $manualPayment);

        $validated = $request->validated();

        $manualPayment->update($validated);

        return redirect()
            ->route('manual-payments.edit', $manualPayment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ManualPayment $manualPayment
    ): RedirectResponse {
        $this->authorize('delete', $manualPayment);

        $manualPayment->delete();

        return redirect()
            ->route('manual-payments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
