<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\OnlinePayment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OnlinePaymentStoreRequest;
use App\Http\Requests\OnlinePaymentUpdateRequest;

class OnlinePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', OnlinePayment::class);

        $search = $request->get('search', '');

        $onlinePayments = OnlinePayment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.online_payments.index',
            compact('onlinePayments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', OnlinePayment::class);

        return view('app.online_payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OnlinePaymentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', OnlinePayment::class);

        $validated = $request->validated();

        $onlinePayment = OnlinePayment::create($validated);

        return redirect()
            ->route('online-payments.edit', $onlinePayment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, OnlinePayment $onlinePayment): View
    {
        $this->authorize('view', $onlinePayment);

        return view('app.online_payments.show', compact('onlinePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, OnlinePayment $onlinePayment): View
    {
        $this->authorize('update', $onlinePayment);

        return view('app.online_payments.edit', compact('onlinePayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OnlinePaymentUpdateRequest $request,
        OnlinePayment $onlinePayment
    ): RedirectResponse {
        $this->authorize('update', $onlinePayment);

        $validated = $request->validated();

        $onlinePayment->update($validated);

        return redirect()
            ->route('online-payments.edit', $onlinePayment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        OnlinePayment $onlinePayment
    ): RedirectResponse {
        $this->authorize('delete', $onlinePayment);

        $onlinePayment->delete();

        return redirect()
            ->route('online-payments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
