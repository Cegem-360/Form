<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RequestQuote;
use App\Models\User;

class RequestQuotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any RequestQuote');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('view RequestQuote');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create RequestQuote');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('update RequestQuote');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('delete RequestQuote');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any RequestQuote');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('restore RequestQuote');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any RequestQuote');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('replicate RequestQuote');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder RequestQuote');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RequestQuote $requestquote): bool
    {
        return $user->checkPermissionTo('force-delete RequestQuote');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any RequestQuote');
    }
}
