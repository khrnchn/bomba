<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reference;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReferencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reference can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list references');
    }

    /**
     * Determine whether the reference can view the model.
     */
    public function view(User $user, Reference $model): bool
    {
        return $user->hasPermissionTo('view references');
    }

    /**
     * Determine whether the reference can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create references');
    }

    /**
     * Determine whether the reference can update the model.
     */
    public function update(User $user, Reference $model): bool
    {
        return $user->hasPermissionTo('update references');
    }

    /**
     * Determine whether the reference can delete the model.
     */
    public function delete(User $user, Reference $model): bool
    {
        return $user->hasPermissionTo('delete references');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete references');
    }

    /**
     * Determine whether the reference can restore the model.
     */
    public function restore(User $user, Reference $model): bool
    {
        return false;
    }

    /**
     * Determine whether the reference can permanently delete the model.
     */
    public function forceDelete(User $user, Reference $model): bool
    {
        return false;
    }
}
