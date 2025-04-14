<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RequestQuoteFunctionality;
use App\Models\User;

class RequestQuoteFunctionalityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('view RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('update RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('delete RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('restore RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('replicate RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RequestQuoteFunctionality $requestquotefunctionality): bool
    {
        return $user->checkPermissionTo('force-delete RequestQuoteFunctionality');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any RequestQuoteFunctionality');
    }
}
