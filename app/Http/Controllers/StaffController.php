<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Station;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Staff::class);

        $search = $request->get('search', '');

        $allStaff = Staff::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_staff.index', compact('allStaff', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Staff::class);

        $users = User::pluck('name', 'id');
        $stations = Station::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.all_staff.create',
            compact('users', 'stations', 'departments')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Staff::class);

        $validated = $request->validated();

        $staff = Staff::create($validated);

        return redirect()
            ->route('all-staff.edit', $staff)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Staff $staff): View
    {
        $this->authorize('view', $staff);

        return view('app.all_staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Staff $staff): View
    {
        $this->authorize('update', $staff);

        $users = User::pluck('name', 'id');
        $stations = Station::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.all_staff.edit',
            compact('staff', 'users', 'stations', 'departments')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StaffUpdateRequest $request,
        Staff $staff
    ): RedirectResponse {
        $this->authorize('update', $staff);

        $validated = $request->validated();

        $staff->update($validated);

        return redirect()
            ->route('all-staff.edit', $staff)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Staff $staff): RedirectResponse
    {
        $this->authorize('delete', $staff);

        $staff->delete();

        return redirect()
            ->route('all-staff.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
