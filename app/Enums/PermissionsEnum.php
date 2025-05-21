<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case VIEW = 'view';
    case VIEW_ANY = 'view-any';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case DELETE_ANY = 'delete-any';
    case REPLICATE = 'replicate';
    case RESTORE = 'restore';
    case RESTORE_ANY = 'restore-any';
    case REORDER = 'reorder';
    case FORCE_DELETE = 'force-delete';
    case FORCE_DELETE_ANY = 'force-delete-any';
   


    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::VIEW => 'View',
            static::VIEW_ANY => 'View Any',
            static::CREATE => 'Create',
            static::UPDATE => 'Update',
            static::DELETE => 'Delete',
            static::DELETE_ANY => 'Delete Any',
            static::REPLICATE => 'Replicate',
            static::RESTORE => 'Restore',
            static::RESTORE_ANY => 'Restore Any',
            static::REORDER => 'Reorder',
            static::FORCE_DELETE => 'Force Delete',
            static::FORCE_DELETE_ANY => 'Force Delete Any',
        };
    }
}
