<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FormQuestion;
use App\Models\User;

final class FormQuestionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FormQuestion');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('view FormQuestion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FormQuestion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('update FormQuestion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('delete FormQuestion');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any FormQuestion');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('restore FormQuestion');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any FormQuestion');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('replicate FormQuestion');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder FormQuestion');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FormQuestion $formquestion): bool
    {
        return $user->checkPermissionTo('force-delete FormQuestion');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any FormQuestion');
    }
}
