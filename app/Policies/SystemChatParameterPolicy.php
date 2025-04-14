<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SystemChatParameter;
use App\Models\User;

class SystemChatParameterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SystemChatParameter');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('view SystemChatParameter');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SystemChatParameter');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('update SystemChatParameter');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('delete SystemChatParameter');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SystemChatParameter');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('restore SystemChatParameter');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SystemChatParameter');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('replicate SystemChatParameter');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder SystemChatParameter');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SystemChatParameter $systemchatparameter): bool
    {
        return $user->checkPermissionTo('force-delete SystemChatParameter');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SystemChatParameter');
    }
}
