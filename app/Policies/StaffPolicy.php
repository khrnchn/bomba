<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the staff can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allstaff');
    }

    /**
     * Determine whether the staff can view the model.
     */
    public function view(User $user, Staff $model): bool
    {
        return $user->hasPermissionTo('view allstaff');
    }

    /**
     * Determine whether the staff can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allstaff');
    }

    /**
     * Determine whether the staff can update the model.
     */
    public function update(User $user, Staff $model): bool
    {
        return $user->hasPermissionTo('update allstaff');
    }

    /**
     * Determine whether the staff can delete the model.
     */
    public function delete(User $user, Staff $model): bool
    {
        return $user->hasPermissionTo('delete allstaff');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allstaff');
    }

    /**
     * Determine whether the staff can restore the model.
     */
    public function restore(User $user, Staff $model): bool
    {
        return false;
    }

    /**
     * Determine whether the staff can permanently delete the model.
     */
    public function forceDelete(User $user, Staff $model): bool
    {
        return false;
    }
}
