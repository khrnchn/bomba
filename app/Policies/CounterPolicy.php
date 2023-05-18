<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Counter;
use Illuminate\Auth\Access\HandlesAuthorization;

class CounterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the counter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list counters');
    }

    /**
     * Determine whether the counter can view the model.
     */
    public function view(User $user, Counter $model): bool
    {
        return $user->hasPermissionTo('view counters');
    }

    /**
     * Determine whether the counter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create counters');
    }

    /**
     * Determine whether the counter can update the model.
     */
    public function update(User $user, Counter $model): bool
    {
        return $user->hasPermissionTo('update counters');
    }

    /**
     * Determine whether the counter can delete the model.
     */
    public function delete(User $user, Counter $model): bool
    {
        return $user->hasPermissionTo('delete counters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete counters');
    }

    /**
     * Determine whether the counter can restore the model.
     */
    public function restore(User $user, Counter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the counter can permanently delete the model.
     */
    public function forceDelete(User $user, Counter $model): bool
    {
        return false;
    }
}
