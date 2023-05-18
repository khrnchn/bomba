<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OnlinePayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class OnlinePaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the onlinePayment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list onlinepayments');
    }

    /**
     * Determine whether the onlinePayment can view the model.
     */
    public function view(User $user, OnlinePayment $model): bool
    {
        return $user->hasPermissionTo('view onlinepayments');
    }

    /**
     * Determine whether the onlinePayment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create onlinepayments');
    }

    /**
     * Determine whether the onlinePayment can update the model.
     */
    public function update(User $user, OnlinePayment $model): bool
    {
        return $user->hasPermissionTo('update onlinepayments');
    }

    /**
     * Determine whether the onlinePayment can delete the model.
     */
    public function delete(User $user, OnlinePayment $model): bool
    {
        return $user->hasPermissionTo('delete onlinepayments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete onlinepayments');
    }

    /**
     * Determine whether the onlinePayment can restore the model.
     */
    public function restore(User $user, OnlinePayment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the onlinePayment can permanently delete the model.
     */
    public function forceDelete(User $user, OnlinePayment $model): bool
    {
        return false;
    }
}
