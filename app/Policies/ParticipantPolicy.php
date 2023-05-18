<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the participant can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list participants');
    }

    /**
     * Determine whether the participant can view the model.
     */
    public function view(User $user, Participant $model): bool
    {
        return $user->hasPermissionTo('view participants');
    }

    /**
     * Determine whether the participant can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create participants');
    }

    /**
     * Determine whether the participant can update the model.
     */
    public function update(User $user, Participant $model): bool
    {
        return $user->hasPermissionTo('update participants');
    }

    /**
     * Determine whether the participant can delete the model.
     */
    public function delete(User $user, Participant $model): bool
    {
        return $user->hasPermissionTo('delete participants');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete participants');
    }

    /**
     * Determine whether the participant can restore the model.
     */
    public function restore(User $user, Participant $model): bool
    {
        return false;
    }

    /**
     * Determine whether the participant can permanently delete the model.
     */
    public function forceDelete(User $user, Participant $model): bool
    {
        return false;
    }
}
