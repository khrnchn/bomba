<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ManualPayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManualPaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the manualPayment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list manualpayments');
    }

    /**
     * Determine whether the manualPayment can view the model.
     */
    public function view(User $user, ManualPayment $model): bool
    {
        return $user->hasPermissionTo('view manualpayments');
    }

    /**
     * Determine whether the manualPayment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create manualpayments');
    }

    /**
     * Determine whether the manualPayment can update the model.
     */
    public function update(User $user, ManualPayment $model): bool
    {
        return $user->hasPermissionTo('update manualpayments');
    }

    /**
     * Determine whether the manualPayment can delete the model.
     */
    public function delete(User $user, ManualPayment $model): bool
    {
        return $user->hasPermissionTo('delete manualpayments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete manualpayments');
    }

    /**
     * Determine whether the manualPayment can restore the model.
     */
    public function restore(User $user, ManualPayment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the manualPayment can permanently delete the model.
     */
    public function forceDelete(User $user, ManualPayment $model): bool
    {
        return false;
    }
}
