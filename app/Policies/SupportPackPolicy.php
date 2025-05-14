<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\SupportPack;
use App\Models\User;

final class SupportPackPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SupportPack');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('view SupportPack');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SupportPack');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('update SupportPack');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('delete SupportPack');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SupportPack');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('restore SupportPack');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SupportPack');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('replicate SupportPack');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder SupportPack');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SupportPack $supportpack): bool
    {
        return $user->checkPermissionTo('force-delete SupportPack');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SupportPack');
    }
}
