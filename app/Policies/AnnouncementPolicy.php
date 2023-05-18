<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the announcement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list announcements');
    }

    /**
     * Determine whether the announcement can view the model.
     */
    public function view(User $user, Announcement $model): bool
    {
        return $user->hasPermissionTo('view announcements');
    }

    /**
     * Determine whether the announcement can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create announcements');
    }

    /**
     * Determine whether the announcement can update the model.
     */
    public function update(User $user, Announcement $model): bool
    {
        return $user->hasPermissionTo('update announcements');
    }

    /**
     * Determine whether the announcement can delete the model.
     */
    public function delete(User $user, Announcement $model): bool
    {
        return $user->hasPermissionTo('delete announcements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete announcements');
    }

    /**
     * Determine whether the announcement can restore the model.
     */
    public function restore(User $user, Announcement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the announcement can permanently delete the model.
     */
    public function forceDelete(User $user, Announcement $model): bool
    {
        return false;
    }
}
