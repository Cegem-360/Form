<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ProjectCommission;
use App\Models\User;

class ProjectCommissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ProjectCommission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('view ProjectCommission');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ProjectCommission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('update ProjectCommission');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('delete ProjectCommission');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ProjectCommission');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('restore ProjectCommission');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ProjectCommission');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('replicate ProjectCommission');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ProjectCommission');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProjectCommission $projectcommission): bool
    {
        return $user->checkPermissionTo('force-delete ProjectCommission');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ProjectCommission');
    }
}
