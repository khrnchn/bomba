<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Check;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the check can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list checks');
    }

    /**
     * Determine whether the check can view the model.
     */
    public function view(User $user, Check $model): bool
    {
        return $user->hasPermissionTo('view checks');
    }

    /**
     * Determine whether the check can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create checks');
    }

    /**
     * Determine whether the check can update the model.
     */
    public function update(User $user, Check $model): bool
    {
        return $user->hasPermissionTo('update checks');
    }

    /**
     * Determine whether the check can delete the model.
     */
    public function delete(User $user, Check $model): bool
    {
        return $user->hasPermissionTo('delete checks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete checks');
    }

    /**
     * Determine whether the check can restore the model.
     */
    public function restore(User $user, Check $model): bool
    {
        return false;
    }

    /**
     * Determine whether the check can permanently delete the model.
     */
    public function forceDelete(User $user, Check $model): bool
    {
        return false;
    }
}
