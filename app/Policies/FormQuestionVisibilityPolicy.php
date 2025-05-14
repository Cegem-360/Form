<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FormQuestionVisibility;
use App\Models\User;

final class FormQuestionVisibilityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FormQuestionVisibility');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('view FormQuestionVisibility');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FormQuestionVisibility');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('update FormQuestionVisibility');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('delete FormQuestionVisibility');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any FormQuestionVisibility');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('restore FormQuestionVisibility');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any FormQuestionVisibility');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('replicate FormQuestionVisibility');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder FormQuestionVisibility');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FormQuestionVisibility $formquestionvisibility): bool
    {
        return $user->checkPermissionTo('force-delete FormQuestionVisibility');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any FormQuestionVisibility');
    }
}
